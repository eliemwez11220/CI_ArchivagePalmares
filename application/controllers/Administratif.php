<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Administratif extends CI_Controller
{

    public function __construct()
    {
        parent:: __construct();
        // verifie of login
        $this->is_logged();

        $this->load->model('Get_model');
        $this->load->model('Insert_model');
        $this->load->model('Update_model');
        $this->load->model('School_model');

        $this->_annee_actuel = date('Y');
        $this->_annee_sco_act = $this->_annee_actuel . '-' . ($this->_annee_actuel + 1);
    }

    /**
     *@ Check is admin is logged
     */
    private function is_logged()
    {
        if (!$this->session->logged_in) {
            // code...
            redirect(base_url());
        } 
    }

    
    /**
     *@ Show user form
     */
    public function eleve()
    {
        #get full year
        $annee_actuel = date('Y');
        $annee_sco_act = $annee_actuel . '-' . ($annee_actuel + 1);

        $annee_sco_passee = $annee_actuel-1 . '-' . ($annee_actuel);
        #==============all department===============

        $annee_scolaire = ($this->input->post('annee_scolaire'));
        $data['select'] = $annee_scolaire;
        if (isset($annee_scolaire)) {
            $data['eleves'] = $this->db->get_where('tb_school_etudiants', array('annee_scolaire' => $annee_scolaire))->result();
        } else {
            $data['eleves'] = $this->db->get_where('tb_school_etudiants', array('annee_scolaire' => $annee_sco_passee))->result();
        }
        $data['periodes'] = $this->Get_model->get('tb_school_periodes', 'date_created')->result();
        //$this->dd($data['eleves']);
        $data['view'] = 'administratif/eleve/index';
        $this->load->view('layouts/main', $data);
    }
#==================================================================================
#-----------------------------------Inscription eleve------------------------------
#======================================================================================
    function add_eleve()
    {
        //Form valdation constraint
        #get fullname student
        $this->form_validation->set_rules('nom_complet', 'nom_complet', 'required', array(
            'required' => 'Le nom complet est obligatoire',
        ));
        #get father name student
        $this->form_validation->set_rules('nom_pere', 'nom_pere', 'required', array(
            'required' => 'Le nom du père est obligatoire',
        ));
        #get mother name student
        $this->form_validation->set_rules('nom_mere', 'nom_mere', 'required', array(
            'required' => 'Le nom de la mère est obligatoire',
        ));
        #get gendar student
        $this->form_validation->set_rules('genre', 'genre', 'required', array(
            'required' => 'Le sexe est obligatoire',
        ));#get gendar student
        $this->form_validation->set_rules('email', 'email', 'required', array(
            'required' => 'Adresse e-mail obligatoire',
        ));
        $this->form_validation->set_rules('cycle', 'cycle', 'required', array(
            'required' => 'Le cycle obligatoire',
        ));
        $this->form_validation->set_rules('nom_classe', 'nom_classe', 'required', array(
            'required' => 'La classe est obligatoire',
        ));
        $this->form_validation->set_rules('date_naissance', 'date_naissance', 'required', array(
            'required' => 'La date de naissance est obligatoire',
        ));
        $this->form_validation->set_rules('lieu_naissance', 'lieu_naissance', 'required', array(
            'required' => 'Le lieu de naissance est obligatoire',
        ));
        $this->form_validation->set_rules('adresse_eleve', 'adresse_eleve', 'required', array(
            'required' => 'Adresse de residence obligatoire',
        ));
        $this->form_validation->set_rules('contact_eleve', 'contact_eleve', 'required', array(
            'required' => 'Numéro téléphone obligatoire',
        ));
        if ($this->form_validation->run()) {

            $nom_complet = trim($this->input->post('nom_complet'));
            $email = trim($this->input->post('email'));
            $genre = trim($this->input->post('genre'));
            $nom_pere = trim($this->input->post('nom_pere'));
            $nom_mere = ($this->input->post('nom_mere'));
            $nom_tuteur = ($this->input->post('nom_tuteur'));
            $cycle = ($this->input->post('cycle') == "EB") ? "secondaire" : trim(($this->input->post('cycle')));
            $nom_classe = trim($this->input->post('nom_classe'));
            $nom_option = ucfirst($this->input->post('cycle') == "secondaire") ? ucfirst(trim($this->input->post('nom_option'))) : NULL;
            #get full year
            $annee_actuel = date('Y');
            $annee_scolaire = $annee_actuel . '-' . ($annee_actuel + 1);
            $date_demande = date('Y-m-d');
            $date_inscription = date('Y-m-d');
            

            $date_naissance = trim($this->input->post('date_naissance'));
            $lieu_naissance = trim($this->input->post('lieu_naissance'));
            $contact_eleve = trim($this->input->post('contact_eleve'));
            $adresse_eleve = trim($this->input->post('adresse_eleve'));
            $etat_inscription = "en attente";

            $data_eleve = compact('nom_complet', 'email', 'genre', 'date_naissance', 'lieu_naissance',
                'adresse_eleve', 'contact_eleve', 'nom_pere', 'nom_mere', 'nom_tuteur');

            if ($this->School_management->set_insert('tb_school_eleves', $data_eleve)) {
                $id_eleve = $this->School_management->get_unique('tb_school_eleves', ['email' => $email])->id;

                if ($id_eleve < 10) {
                    $matricule_eleve = "EL-" . $annee_scolaire . "-00" . $id_eleve;
                } elseif ($id_eleve >= 10 AND $id_eleve < 100) {
                    $matricule_eleve = "EL-" . $annee_scolaire . "-0" . $id_eleve;
                } else {
                    $matricule_eleve = "EL-" . $annee_scolaire . "-" . $id_eleve;
                }
                if ($this->School_management->set_update('tb_school_eleves', compact('matricule_eleve'), ['email' => $email])) {

                    $data_inscription = compact('date_inscription', 'matricule_eleve', 'annee_scolaire', 'nom_classe',
                        'nom_option', 'nom_section', 'cycle', 'date_demande', 'etat_inscription');
                    $this->School_management->set_insert('tb_school_inscriptions', $data_inscription);
                }
            } else {
                $this->get_msg("Impossible d'inscrire l'élève. $nom_complet");
                $this->session->set_flashdata('type', 'eleve');
                $this->Add_form();
            }
            $this->get_msg("L'élève $nom_complet a été inscrit avec succès!", 'success');
            return redirect(base_url() . 'administratif/eleve');
        } else {
            $this->session->set_flashdata('type', 'eleve');
            $this->Add_form();
        }
    }
#==================================================================================
#-----------------------------------update eleve------------------------------
#======================================================================================


    /**
     * Edit Agent Form
     */
    public function update_eleve()
    {
        //Form valdation constraint
        #get fullname student
        $this->form_validation->set_rules('nom_complet', 'nom_complet', 'required', array(
            'required' => 'Le nom complet est obligatoire',
        ));
        #get father name student
        $this->form_validation->set_rules('nom_pere', 'nom_pere', 'required', array(
            'required' => 'Le nom du père est obligatoire',
        ));
        #get mother name student
        $this->form_validation->set_rules('nom_mere', 'nom_mere', 'required', array(
            'required' => 'Le nom de la mère est obligatoire',
        ));
        #get gendar student
        $this->form_validation->set_rules('genre', 'genre', 'required', array(
            'required' => 'Le sexe est obligatoire',
        ));#get gendar student
        $this->form_validation->set_rules('email', 'email', 'required', array(
            'required' => 'Adresse e-mail obligatoire',
        ));

        $this->form_validation->set_rules('date_naissance', 'date_naissance', 'required', array(
            'required' => 'La date de naissance est obligatoire',
        ));
        $this->form_validation->set_rules('lieu_naissance', 'lieu_naissance', 'required', array(
            'required' => 'Le lieu de naissance est obligatoire',
        ));
        $this->form_validation->set_rules('adresse_eleve', 'adresse_eleve', 'required', array(
            'required' => 'Adresse de residence obligatoire',
        ));
        $this->form_validation->set_rules('contact_eleve', 'contact_eleve', 'required', array(
            'required' => 'Numéro téléphone obligatoire',
        )); $this->form_validation->set_rules('statut_eleve', 'statut_eleve', 'required', array(
            'required' => 'Stattut access obligatoire',
        ));

        # verifie if datas are corrects and redirect
        if ($this->form_validation->run()) {

            $nom_complet = trim($this->input->post('nom_complet'));
            $email = trim($this->input->post('email'));
            $genre = trim($this->input->post('genre'));
            $nom_pere = trim($this->input->post('nom_pere'));
            $nom_mere = ($this->input->post('nom_mere'));
            $nom_tuteur = ($this->input->post('nom_tuteur'));
            $date_naissance = trim($this->input->post('date_naissance'));
            $lieu_naissance = trim($this->input->post('lieu_naissance'));
            $contact_eleve = trim($this->input->post('contact_eleve'));
            $adresse_eleve = trim($this->input->post('adresse_eleve'));//
            $statut_eleve = trim($this->input->post('statut_eleve'));//
            $data_eleve = compact('nom_complet', 'email', 'genre', 'date_naissance', 'lieu_naissance',
                'adresse_eleve', 'contact_eleve', 'nom_pere', 'nom_mere', 'nom_tuteur','statut_eleve');

            // update
            $id = $this->uri->segment(4);
            if ($this->Update_model->set_update('tb_school_eleves', $data_eleve, array('id_eleve' => $id))) {
                $this->get_msg("Modification des infos de l'élève $nom_complet effectuée avec succès", "success");
                // redirection
                return redirect(base_url() . 'administratif/eleve');
            } else {
                //$this->get_msg("Erreur de modification du compte utilisateur");
                $this->session->set_flashdata('type', 'eleve');
                $this->Update_form();
            }

        } else {
            //this->get_msg("Erreur de modification du compte utilisateur");
            $this->session->set_flashdata('type', 'eleve');
            $this->Update_form();
        }
    }
    ########################################   *   ########################################
    #
    #                            # CLASSES SCOLAIRES FUNCTIONS
    #
    ########################################   *   ########################################

    /**
     *@ Show user form
     */
    public function classe()
    {
        #==============all department===============
        $data['classes'] = $this->Get_model->get('tb_school_promotions', 'nom_promo')->result();
        $data['view'] = 'administratif/classe/index';
        $this->load->view('administratif/main', $data);
    }

    ########################################   *   ########################################
    #
    #								# SECTIONS FUNCTIONS
    #
    ########################################   *   ########################################

    /**
     *@ S
     */
    public function viewResultat()
    {

        $annee_actuel = date('Y');
        $annee_sco_act = $annee_actuel . '-' . ($annee_actuel + 1);
         $annee_sco_passee = $annee_actuel-1 . '-' . ($annee_actuel);
        #==============all department===============
        #==============all department===============

        $annee_scolaire = ($this->input->post('annee_scolaire'));
        $data['select'] = $annee_scolaire;
        if (isset($annee_scolaire)) {
            $data['resultats'] = $this->db->get_where('tb_school_resultats', array('annee_scolaire' => $annee_scolaire))->result();
            //$data['eleves'] = $this->Get_model->get('view_eleves_inscrits ', 'nom_complet')->result();
            $data['periodes'] = $this->Get_model->get('tb_school_periodes', 'date_created')->result();
        } else {
            $data['resultats'] = $this->db->get_where('tb_school_resultats', array('annee_scolaire' => $annee_sco_passee))->result();
            //$data['eleves'] = $this->Get_model->get('view_eleves_inscrits ', 'nom_complet')->result();
            $data['periodes'] = $this->Get_model->get('tb_school_periodes', 'date_created')->result();
        }

        #================all sections ======================
       // $data['resultats'] = $this->Get_model->get('tb_school_resultats', 'annee_scolaire')->result();
        $data['view'] = 'administratif/resultats/index';
        $this->load->view('layouts/main', $data);
    } 

    public function viewCotation()
    {

        $annee_actuel = date('Y');
        $annee_sco_act = $annee_actuel . '-' . ($annee_actuel + 1);
         $annee_sco_passee = $annee_actuel-1 . '-' . ($annee_actuel);
        #==============all department===============

        $annee_scolaire = ($this->input->post('annee_scolaire'));
        $data['select'] = $annee_scolaire;
        if (isset($annee_scolaire)) {
            $data['cotations'] = $this->db->get_where('tb_school_cotations', array('annee_scolaire' => $annee_scolaire))->result();
            //$data['eleves'] = $this->Get_model->get('view_eleves_inscrits ', 'nom_complet')->result();
            $data['periodes'] = $this->Get_model->get('tb_school_periodes', 'date_created')->result();
        } else {
            $data['cotations'] = $this->db->get_where('tb_school_cotations', array('annee_scolaire' => $annee_sco_passee))->result();
            //$data['eleves'] = $this->Get_model->get('view_eleves_inscrits ', 'nom_complet')->result();
            $data['periodes'] = $this->Get_model->get('tb_school_periodes', 'date_created')->result();
        }

        #================all sections ======================
       // $data['resultats'] = $this->Get_model->get('tb_school_resultats', 'annee_scolaire')->result();
        $data['view'] = 'enseignant/cotation_eleves';
        $this->load->view('layouts/main', $data);
    }

    ########################################   *   ########################################
    #
    #							  # OPTIONS FUNCTIONS
    #
    ########################################   *   ########################################

    /**
     *@ Show user form
     */
    public function option()
    {
        #=================all agency =================
        $data['options'] = $this->Get_model->get('tb_school_options', 'nom_option')->result();

        $data['view'] = 'administratif/option/index';
        $this->load->view('layouts/main', $data);
    }

    ########################################   *   ########################################
    #
    #					     	# GENERIC FUNCTIONS
    #
    ########################################   *   ########################################

    /**
     *@ Add data
     */
    public function Add_form()
    {
        $data['options'] = $this->Get_model->get('tb_school_options', 'nom_option')->result();

        
        #=================forms information======================
        $type = $this->uri->segment(3) ?? $this->session->type;
        $data['view'] = "administratif/$type/add";
        $this->load->view('layouts/main', $data);
    }

    /**
     *@ Update data
     */
    public function Update_form()
    {
        #=======================forms update data====================
        $id = $this->uri->segment(4);
        $type = $this->uri->segment(3) ?? $this->session->type;
        //infos sessions utilisateurs for edit
        $data['agents'] = $this->Get_model->get_info_by_table_by_id($id, 'tb_school_assets', 'id_asset');
        $data['options'] = $this->Get_model->get('tb_school_options', 'nom_option')->result();

        //Nouvelles fonctions sur school management
        $data['classe'] = $this->Get_model->get_onces($id, 'promotion');
        $data['option'] = $this->Get_model->get_onces($id, 'option');
        $data['eleve'] = $this->Get_model->get_onces($id, 'etudiant');

        $data['view'] = "administratif/$type/update";
        $this->load->view('layouts/main', $data);
    }

public function importerListingEleves()
    {
        //$this->input->post('uploadFile');
        if ($this->input->post('uploadFilebtn') == "ListeEleves") {

            $path = './resources/files/';
            //require_once APPPATH . "/third_party/PHPExcel.php";
            include_once APPPATH . 'third_party/PHPExcel.php';
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xlsx|xls|csv';
            $config['remove_spaces'] = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('uploadFile')) {
                $error = array('error' => $this->upload->display_errors());
                $this->get_msg($this->upload->display_errors());
                redirect('administratif/eleve');
            } else {
                $data = array('upload_data' => $this->upload->data());
            }

            if (empty($error)) {
                if (!empty($data['upload_data']['file_name'])) {
                    $import_xls_file = $data['upload_data']['file_name'];
                } else {
                    $import_xls_file = 0;
                }
                $inputFileName = $path . $import_xls_file;

                try {

                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);
                    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                    $flag = true;
                    $i = 0;

                    foreach ($allDataInSheet as $value) {
                        if ($flag) {
                            $flag = false;
                            continue;
                        }
                        $inserdata[$i]['matricule'] = $value['A'];
                        $inserdata[$i]['nom_complet'] = $value['B'];
                        $inserdata[$i]['genre'] = $value['C'];
                        $inserdata[$i]['date_naissance'] = $value['D'];
                        $inserdata[$i]['lieu_naissance'] = $value['E'];
                        $inserdata[$i]['adresse'] = $value['F'];
                        $inserdata[$i]['contact'] = $value['G'];
                        $inserdata[$i]['nom_pere'] = $value['H'];
                        $inserdata[$i]['nom_mere'] = $value['I'];
                        $inserdata[$i]['email'] = $value['J'];
                  
                        $inserdata[$i]['statut'] ="online";
                        $inserdata[$i]['promo_sid'] = $value['K'];
                        $inserdata[$i]['annee_scolaire'] = $value['L'];

                        //$inserdata[$i]['date_reception_visa'] = utf8_encode(strftime("%Y-%m-%d", strtotime($value['C'])));
                        $i++;
                    }

                   

                    if ($this->School_model->import_data('tb_school_etudiants', $inserdata)) {

                        $this->get_msg("Importation des donnees des etudiants effectuée avec succès", 'success');
                        return redirect(base_url() . 'administratif/eleve');
                        //$this->index();
                    } else {
                        $this->get_msg("Erreur d'importation des donnees des eleves !");
                        return redirect(base_url() . 'administratif/eleve');
                    }

                } catch (Exception $e) {

                    $this->get_msg('Erreur de lecture du fichier "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                        . '": ' . $e->getMessage());
                    return redirect(base_url() . 'administratif/eleve');
                }
            } else {
                $this->get_msg("Erreur fichier");
                return redirect(base_url() . 'administratif/eleve');
            }
        }else {
                $this->get_msg("Erreur ListeEleves");
                return redirect(base_url() . 'administratif/eleve');
            }
    }

    public function importerListingResultats()
    {
        $this->input->post('uploadFile');
        if ($this->input->post('uploadFilebtn') == "Palmares") {

            $path = './resources/files/';
            //require_once APPPATH . "/third_party/PHPExcel.php";
            include_once APPPATH . 'third_party/PHPExcel.php';
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xlsx|xls|csv';
            $config['remove_spaces'] = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('uploadFile')) {
                $error = array('error' => $this->upload->display_errors());
                $this->get_msg($this->upload->display_errors());
                redirect('administratif/eleve');
            } else {
                $data = array('upload_data' => $this->upload->data());
            }

            if (empty($error)) {
                if (!empty($data['upload_data']['file_name'])) {
                    $import_xls_file = $data['upload_data']['file_name'];
                } else {
                    $import_xls_file = 0;
                }
                $inputFileName = $path . $import_xls_file;

                try {

                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);
                    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                    $flag = true;
                    $i = 0;

                    foreach ($allDataInSheet as $value) {
                        if ($flag) {
                            $flag = false;
                            continue;
                        }
                        $inserdata[$i]['matricule'] = $value['A'];
                        $inserdata[$i]['annee_scolaire'] = $value['B'];
                        $inserdata[$i]['promotion'] = $value['C'];
                        $inserdata[$i]['nom_option'] = $value['D']; 
                        $inserdata[$i]['departement'] = $value['E'];
                        $inserdata[$i]['session'] = $value['F']; 
                        $inserdata[$i]['cote_obtenue'] = $value['G']; 
                        $inserdata[$i]['pourcentage'] = $value['H'];
                        $inserdata[$i]['mention'] = $value['I'];  
                        $inserdata[$i]['date_pub'] = date('Y-m-d H:i:s');
                        //$inserdata[$i]['date_reception_visa'] = utf8_encode(strftime("%Y-%m-%d", strtotime($value['C'])));
                        $i++;
                    }

                    if ($this->School_model->import_data('tb_school_resultats', $inserdata)) {

                        $this->get_msg("Importation des donnees du Palmares effectuée avec succès", 'success');
                        return redirect(base_url() . 'administratif/viewResultat');
                        //$this->index();
                    } else {
                        $this->get_msg("Erreur d'importation des donnees des eleves !");
                        return redirect(base_url() . 'administratif/viewResultat');
                    }

                } catch (Exception $e) {

                    $this->get_msg('Erreur de lecture du fichier "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                        . '": ' . $e->getMessage());
                    return redirect(base_url() . 'administratif/viewResultat');
                }
            } else {
                $this->get_msg($error['error']);
                return redirect(base_url() . 'administratif/viewResultat');
            }
        }
    }



 public function importerListingCotation()
    {
        if ($this->input->post('uploadFilebtn') == "cotations") {

            $path = './resources/files/';
            //require_once APPPATH . "/third_party/PHPExcel.php";
            include_once APPPATH . 'third_party/PHPExcel.php';
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xlsx|xls|csv';
            $config['remove_spaces'] = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('uploadFile')) {
                $error = array('error' => $this->upload->display_errors());
                $this->get_msg($this->upload->display_errors());
                redirect('administratif/eleve');
            } else {
                $data = array('upload_data' => $this->upload->data());
            }

            if (empty($error)) {
                if (!empty($data['upload_data']['file_name'])) {
                    $import_xls_file = $data['upload_data']['file_name'];
                } else {
                    $import_xls_file = 0;
                }
                $inputFileName = $path . $import_xls_file;

                try {

                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);
                    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                    $flag = true;
                    $i = 0;

                    foreach ($allDataInSheet as $value) {
                        if ($flag) {
                            $flag = false;
                            continue;
                        }
                        $inserdata[$i]['eleve_sid'] = $value['A'];
                        $inserdata[$i]['cours_sid'] = $value['B'];
                        $inserdata[$i]['cote_periode1'] = $value['C'];
                        $inserdata[$i]['cote_periode2'] = $value['D'];
                        $inserdata[$i]['cote_examen1'] = $value['E'];  
                        $inserdata[$i]['premier_semestre'] = $value['F'];
                         $inserdata[$i]['cote_periode3'] = $value['G'];
                        $inserdata[$i]['cote_periode4'] = $value['H'];
                        $inserdata[$i]['cote_examen2'] = $value['I'];  
                        $inserdata[$i]['deuxieme_semestre'] = $value['J'];
                        $inserdata[$i]['total_max'] = $value['K']; 
                         $inserdata[$i]['annee_scolaire'] = $value['L'];
                        //$inserdata[$i]['date_reception_visa'] = utf8_encode(strftime("%Y-%m-%d", strtotime($value['C'])));
                        $i++;
                    }

                    if ($this->School_model->import_data('tb_school_cotations', $inserdata)) {

                        $this->get_msg("Importation des donnees des eleves effectuée avec succès", 'success');
                        return redirect(base_url() . 'administratif/viewCotation');
                        //$this->index();
                    } else {
                        $this->get_msg("Erreur d'importation des donnees des eleves !");
                        return redirect(base_url() . 'administratif/viewCotation');
                    }

                } catch (Exception $e) {

                    $this->get_msg('Erreur de lecture du fichier "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                        . '": ' . $e->getMessage());
                    return redirect(base_url() . 'administratif/viewCotation');
                }
            } else {
                $this->get_msg($error['error']);
                return redirect(base_url() . 'administratif/viewCotation');
            }
        }
    }
}
