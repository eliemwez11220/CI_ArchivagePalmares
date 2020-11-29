<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Admin extends CI_Controller
{

    public function __construct()
    {
        parent:: __construct();
        // verifie of login
        $this->is_logged();
        $this->load->model('Get_model');
        $this->load->model('Passports_model'); 
        $this->load->model('School_model');

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
     *@ List of agents and admin
     */
    public function Agent()
    {

        $data['title'] = 'Gestion des utilisateurs';
        $data['managers'] = $this->Get_model->get('tb_school_assets', 'date_connected')->result();

        $data['view'] = 'admin/agent/index';
        $this->load->view('layouts/main',$data);
    }

    /**
     *@ Add an agent
     */
    public function creerCompteAgent()
    {
        //recupere infos users existants
        $data['users'] = $this->Get_model->get('tb_school_assets', 'date_connected')->result();


        $this->form_validation->set_rules('asset_name', 'asset_name', 'required', array(
            'required' => 'Le nom complet est obligatoire',
        ));
        $this->form_validation->set_rules('groupe', 'groupe', 'required', array(
            'required' => 'La fonction est obligatoire',
        ));

        $this->form_validation->set_rules('asset_email', 'asset_email', 'required', array(
            'required' => 'L\'email est obligatoire',
        ));

        $this->form_validation->set_rules('asset_password', 'asset_password', 'required', array(
            'required' => 'Le mot de passe est obligatoire',
        ));

        # verifie if datas are corrects and redirect
        if ($this->form_validation->run() && $this->input->post('asset_type') != "" &&
            $this->input->post('asset_departement') != "" && $this->input->post('asset_email') != "") {

            $user_name = trim(strtolower($this->input->post('asset_name')));
            

            $user_mail = trim(strtolower($this->input->post('asset_email')));
            $user_password_default = $this->input->post('asset_password');

             $username = strstr($user_mail, '@', true);

            $user_existant = $this->Get_model->user_existant($user_name);

            //Infos utilisateurs existant
            $username_db = '';
            $usermail_db = '';
            if (!empty($user_existant)) {

                $userdata = array(
                    'asset_name' => $user_existant->asset_name,
                    'asset_username' => $user_existant->asset_username,
                    'asset_email' => $user_existant->asset_email,
                    'asset_password' => $user_existant->asset_password
                );
                $username_db = $user_existant->asset_username;
                $usermail_db = $user_existant->asset_email;
            }
            //|| ($user_existant->asset_email == $user_mail)
            if (($username_db == $user_name) || ($usermail_db == $user_mail)) {
                $this->get_msg("L'utilisateur $user_name ayant l'adresse e-mail $user_mail existe déjà.");
                // redirection
                return redirect(base_url() . 'admin/agent');
            } else {
                //ajout des elements à l'algorithme de cryptage.
                $options = array(
                    'cost' => 12,
                );
                //Mise en tableau des informations du compte a créé
                $data = array(
                    'asset_name' => $user_name,
                    'asset_username' => $username,
                    'asset_password' => password_hash($this->input->post('asset_password'), PASSWORD_BCRYPT, $options),
                    'departement' => $this->input->post('asset_departement'),
                    'asset_email' => $user_mail,
                    'asset_type' => $this->input->post('asset_type'),
                    'fonction' => $this->input->post('groupe'),
                    'status' => 1,
                );
                // insert datas in database
                $this->School_model->set_insert('tb_school_assets',$data);
                $this->get_msg("Le compte utilisateur de $user_name a été créé avec succès", 'success');
                //envoi de la notification à l'utilisateur du compte créé
                // redirection
                return redirect(base_url() . 'admin/agent');
            }

        } else {
            $this->get_msg('Erreur de création du compte utilisateur en raison système');
            $this->session->set_flashdata('type', 'agent');
            $this->Add_form();
        }
    }


    /**
     * Edit Agent Form
     */
    public function update_agent()
    {
        //$data['agents_effectifs'] = $this->Get_model->get_effectif();

        $this->form_validation->set_rules('asset_name', 'asset_name', 'required', array(
            'required' => 'Le nom complet est obligatoire',
        ));
        $this->form_validation->set_rules('asset_username', 'asset_username', 'required', array(
            'required' => 'Le nom utilisateur est obligatoire',
        ));

        $this->form_validation->set_rules('asset_email', 'asset_email', 'required', array(
            'required' => 'L\'email est obligatoire',
        ));

        # verifie if datas are corrects and redirect
        if ($this->form_validation->run() && $this->input->post('asset_type') != "" &&
            $this->input->post('asset_departement') != "" && $this->input->post('asset_email') != "") {
            $fullname = $this->input->post('asset_name');
            $data = array(
                'asset_name' => $this->input->post('asset_name'),
                'asset_username' => $this->input->post('asset_username'),
                'departement' => $this->input->post('asset_departement'),
                'asset_email' => $this->input->post('asset_email'),
                'asset_type' => $this->input->post('asset_type'),
                'fonction' => $this->input->post('groupe'),
                'status' => 1,
            );

            // update
            $id = $this->uri->segment(4);
            if ($this->School_model->set_update('tb_school_assets', $data, array('id_asset' => $id))) {
                $this->get_msg("Modification du compte utilisateur de $fullname effectuée avec succès", "success");
                // redirection
                return redirect(base_url() . 'admin/agent');
            } else {
                $this->get_msg("Erreur de modification du compte utilisateur");
                $this->session->set_flashdata('type', 'agent');
                $this->Update_form();
            }

        } else {
            //this->get_msg("Erreur de modification du compte utilisateur");
            $this->session->set_flashdata('type', 'agent');
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
        $data['view'] = 'admin/classe/index';
        $this->load->view('layouts/main', $data);
    }

    /**
     *@ Add an agent
     */
    public function add_classe()
    {
        # recuperation of username
        $this->form_validation->set_rules('classe_nom', 'classe_nom', 'required', array(
            'required' => 'Le nom de la classe est obligatoire',
        ));

        $this->form_validation->set_rules('departement_sid', 'departement_sid', 'required', array(
            'required' => 'departement obligatoire',
        ));

        $this->form_validation->set_rules('classe_effectif_eleves', 'classe_effectif_eleves', 'required', array(
            'required' => 'Effectif de la classe obligatoire',
        ));

        # verifie if datas are corrects and redirect
        if ($this->form_validation->run()) {
            // stock datas in array
            $classe_nom = trim(strtoupper($this->input->post('classe_nom')));
            $dep_existant = $this->Get_model->get_classe($classe_nom);
            $departdata = array(
                'nom_promo' => $dep_existant->nom_classe,
                'effectif_etudiant' => $dep_existant->effectif,
                'promo_id' => $dep_existant->promo_id
            );
            if (isset($departdata)) {
                if ($classe_nom != $dep_existant->nom_classe) {
                    $data = array(
                        'nom_promo' => $classe_nom,
                        'effectif_etudiant' => $this->input->post('classe_effectif_eleves'),
                        'departement_sid' => $this->input->post('departement_sid'),
                    );
                    // insert datas in database
                    $this->Insert_model->insert_data($data, 'tb_school_promotions');
                    $this->get_msg("Enregistrement de $classe_nom effectué avec succès", "success");
                    // redirection
                    return redirect(base_url() . 'admin/classe');
                } else {
                    $this->get_msg("La promotion $classe_nom existe déjà. Vous ne pouvez pas l'enregistrer en nouveau.");
                    $this->session->set_flashdata('type', 'classe');
                    $this->Add_form();
                }
            }
        } else {
            $this->get_msg("Erreur d'ajout d'une nouvelle promotion. Enregistrement non effectué");
            $this->session->set_flashdata('type', 'classe');
            $this->Add_form();
        }
    }

    /**
     *@ update classe
     */
    public function update_classe()
    {
        # recuperation of username
        $this->form_validation->set_rules('classe_nom', 'classe_nom', 'required', array(
            'required' => 'Le nom de la classe est obligatoire',
        ));

        $this->form_validation->set_rules('titulaire_sid', 'titulaire_sid', 'required', array(
            'required' => 'Le cycle de la classe est obligatoire',
        ));

        $this->form_validation->set_rules('classe_effectif_eleves', 'classe_effectif_eleves', 'required', array(
            'required' => 'Effectif de la classe obligatoire',
        ));

        # verifie if datas are corrects and redirect
        if ($this->form_validation->run()) {
            // stock datas in array

            $data = array(
                'nom_promo' => $this->input->post('classe_nom'),
                'effectif' => $this->input->post('classe_effectif_eleves'),
                'department_sid' => $this->input->post('titulaire_sid'),
            );
            // update
            $id = $this->uri->segment(4);
            if ($this->Update_model->set_update('tb_school_promotions', $data, array('id_classe' => $id))) {
                $this->get_msg("Modification effectuée avec succès", "success");
                // redirection
                return redirect(base_url() . 'admin/classe');
            } else {
                $this->get_msg("Erreur de modification");
                $this->session->set_flashdata('type', 'classe');
                $this->Update_form();
            }
        } else {
            //$this->get_msg("Erreur de modification du département. Mise à jour non effectuée");
            $this->session->set_flashdata('type', 'classe');
            $this->Update_form();
        }
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

        $data['view'] = 'admin/option/index';
        $this->load->view('layouts/main', $data);
    }

    /**
     *@ Add an agence
     */
    public function add_option()
    {
       

        $this->form_validation->set_rules('nom_option', 'nom_option', 'required', array(
            'required' => 'Le nom option est obligatoire',
        ));
        $this->form_validation->set_rules('section_sid', 'section_sid', 'required', array(
            'required' => 'La section est obligatoire',
        ));

        # verifie if datas are corrects and redirect
        if ($this->form_validation->run()) {
            // stock datas in array
            $nom_option = trim(strtoupper($this->input->post('nom_option')));
            $option_existante = $this->Get_model->get_option_existant($nom_option);
            $optiondata = array(
                'nom_option' => $option_existante->nom_option
            );
            if (isset($optiondata)) {
                if ($nom_option != $option_existante->agence_nom) {
                    $data = array(
                        'nom_option' => $this->input->post('nom_option'),
                        'section_sid' => $this->input->post('section_sid'),
                    );
                    // insert datas in database
                    $this->Insert_model->insert_data($data, 'tb_school_options');
                    $this->get_msg("Ajout d'une nouvelle option effectuée avec succès", "success");
                    // redirection
                    return redirect(base_url() . 'admin/option');
                } else {
                    $this->get_msg("Désolé ! L'option $nom_option existe déjà");
                    $this->session->set_flashdata('type', 'option');
                    $this->Add_form();
                }
            }

        } else {
            //$this->get_msg("Erreur d'ajout de la nouvelle agence. Enregistrement non effectué");
            $this->session->set_flashdata('type', 'option');
            $this->Add_form();
        }
    }

    /**
     * Edit Agence Form
     */

    public function update_option()
    {
        $data['sections'] = $this->Get_model->get('tb_school_sections', 'nom_section')->result();
        #=====================add new option========================

        $this->form_validation->set_rules('nom_option', 'nom_option', 'required', array(
            'required' => 'Le nom option est obligatoire',
        ));
        $this->form_validation->set_rules('section_sid', 'section_sid', 'required', array(
            'required' => 'La section est obligatoire',
        ));

        # verifie if datas are corrects and redirect
        if ($this->form_validation->run()) {
            // stock datas in array

            $data = array(
                'nom_option' => $this->input->post('nom_option'),
                'section_sid' => $this->input->post('section_sid'),
            );

            // insert datas in database
            $id = $this->uri->segment(4);
            if ($this->Update_model->set_update('tb_school_options', $data, array('id_option' => $id))) {
                $this->get_msg("Modification option effectuée avec succès", "success");
                // redirection
                return redirect(base_url() . 'admin/option');
            } else {
                $this->get_msg("Erreur de modification de l'option indiquée");
                $this->session->set_flashdata('type', 'option');
                $this->Update_form();
            }
        } else {
            $this->get_msg("Erreur de modification. Mise à jour non effectuée de l'option indiquée");
            $this->session->set_flashdata('type', 'option');
            $this->Update_form();
        }
    }

    /**
     * Edit Agent Form
     */

    public function reset_agent_password()
    {
        //id user
        $id_user = $this->input->get('id_asset');
        //algo cryptage
        $options = array(
            'cost' => 12,
        );
        $asset_password = password_hash("123456", PASSWORD_BCRYPT, $options);
        $data_user = compact('asset_password');
        if ($this->Passports_model->set_update('tb_school_assets', $data_user, array('id_asset' => $id_user))) {

            //redirect  with message notifie
            $this->get_msg("Réinitialisation effectuée du mot de passe utilisateur", "success");
            return redirect(base_url() . 'admin/agent');
        } else {
           return redirect(base_url() . 'admin/agent');
        }
    }

    # bloquer agent - desactivation d'un compte utilisateur
    public function bloquer_agent()
    {
        //id user
        $id_user = $this->input->get('id_asset');
        $status = 0;
        $data_user = compact('status');
        if ($this->Passports_model->set_update('tb_school_assets', $data_user, array('id_asset' => $id_user))) {

            //redirect  with message notifie
            $this->get_msg("Agent bloqué - compte utilisateur désactivé avec succès", "success");
            return redirect(base_url() . 'admin/agent');
        } else {
           return redirect(base_url() . 'admin/agent');
        }
    }

    # débloquer agent - activation d'un compte utilisateur
    public function debloquer_agent()
    {
        //id user
        $id_user = $this->input->get('id_asset');
        $status = 1;
        $data_user = compact('status');
        if ($this->Passports_model->set_update('tb_school_assets', $data_user, array('id_asset' => $id_user))) {

            //redirect  with message notifie
            $this->get_msg("Agent débloqué - compte utilisateur activé avec succès", "success");
            return redirect(base_url() . 'admin/agent');
        } else {
            return redirect(base_url() . 'admin/agent');
        }
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
        $id = $this->uri->segment(4);
        //infos sessions utilisateurs for edit
        $data['agents'] = $this->Get_model->get_info_by_table_by_id($id, 'tb_school_assets', 'id_asset');
        

        $data['classes'] = $this->Get_model->get('tb_school_promotions', 'nom_promo')->result();
        $data['eleves'] = $this->Get_model->get('tb_school_etudiants', 'matricule')->result();
        #=================forms information======================
        $type = $this->uri->segment(3) ?? $this->session->type;
        $data['view'] = "admin/$type/add";
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
        $data['enseignants'] = $this->Get_model->get('tb_school_enseignants', 'enseignant_id')->result();
        $data['classes'] = $this->Get_model->get('tb_school_promotions', 'nom_promo')->result();
        $data['eleves'] = $this->Get_model->get('tb_school_etudiants', 'matricule')->result();

       

        $data['view'] = "admin/$type/update";
        $this->load->view('layouts/main', $data);
    }

   

    #===================================deconnexon - fermeture de session===========================================
    public function logout()
    {
        $this->session->sess_destroy();
        return redirect(base_url());
    }
    
}
