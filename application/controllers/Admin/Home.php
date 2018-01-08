<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends  CI_Controller{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in'))
            redirect(base_url() . "Admin\Login");
    }
    public function Index(){
        $this->load->view("Admin\ana_sayfa");
    }
}
?>