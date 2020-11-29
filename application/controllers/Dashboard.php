<?php

class Dashboard extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        
            $this->load->model('School_model');

        $this->is_authenticate();         //Verifier si un admin est connecter puis changer son status online
    }

    private function is_authenticate()
    {
        $current_datetime = date('Y-m-d H:i:s');

        if (!$this->session->logged_in) {
            // code...
            redirect(base_url());
        } 
    }


    function index()
    {
        $data['title'] ="Tableau de bord";
        $data['view'] = 'layouts/dashboard';
        $this->load->view('layouts/main',$data);

    }
    public function logOut()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }
}
