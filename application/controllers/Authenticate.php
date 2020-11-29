<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Authenticate extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Secure_model');
    }

    public function index()
    {
        if ($this->session->logged_in === TRUE) {
            redirect('dashboard/index');
        } else {
            $data['title'] = "Login";
            $this->load->view('session/login_users', $data);
        }
    }

    public function login()
    {
        # recuperation of username
        $this->form_validation->set_rules('username', 'Username', 'required', array(
            'required' => 'Username is required',
        ));

        # recuperation of password
        $this->form_validation->set_rules('password', 'Password', 'required', array(
            'required' => 'Password is required',
        ));
        # verifie if datas are corrects and redirect
        if ($this->form_validation->run()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            if ($this->Secure_model->login_data($username, $password)) {

                $infos_agent = $this->Secure_model->login_data($username, $password);

                if ($infos_agent) {
                    $userdata = array(
                        'id' => $infos_agent->id_asset,
                        'fullname' => $infos_agent->asset_name,
                        'username' => $infos_agent->asset_username,
                        'password' => $infos_agent->asset_password,
                        'email' => $infos_agent->asset_email,
                        'role' => $infos_agent->asset_type,
                        'fonction' => $infos_agent->fonction,
                        'status' => $infos_agent->status,
                        'logged_in' => TRUE
                    );
                    //verification du statut de l'agent
                    if ($infos_agent->status == 1) {
                        //stock data in session
                        $this->session->set_userdata($userdata);                    #//session  //redirect to control panel for admin
                        redirect(base_url() . 'dashboard/index');
                    } else {
                        # Redirect to login page and show the message error
                        $this->setError("Votre compte est déjà bloqué. Veuillez conctacter un webmaster ou un administrateur système");
                    }
                } else {
                    // redirect if username or password is not true
                    $this->setError("Compte utilisateur non existant dans le système.");
                }
            } else {
                // redirect if username or password is not true
                $this->setError("Mot de passe ou nom utilisateur incorrect.");
            }

        } else {
            // redirect if username or password is not true
            $this->setError("Vous devez disposer un compte utilisateur pour accéder à cette application.
                         Veuillez conctacter l'administrateur système pour plus de détails.");
        }
    }

    public function setError($rror)
    {
        $data['title'] = "Error login";
        $data['page_error'] = $rror;
        $this->load->view('session/login_users', $data);
    }
}