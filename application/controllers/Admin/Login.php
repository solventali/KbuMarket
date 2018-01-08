<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends  CI_Controller
{
    function __construct()
    {
        parent::__construct();
    //    $this->load->model('User_Model');
    }

    public function index()
    {
        $this->load->view('Admin\login');

     //   $this->load-view("Admin\login");
    }
    public function LoginControl(){
         $Email = $this->security->xss_clean($this->input->post("txtEmail"));
         $Password = $this->security->xss_clean($this->input->post("txtPassword"));

        $this->db->where('Email', $Email);
        $this->db->where('Sifre', $Password);
        $this->db->where('Aktif', "1");
        $Sonuc = $this->db->get("Uyeler");
        if ($Sonuc->num_rows()>0) {
            $UyeDVO = $Sonuc->result();
            if ($UyeDVO) {
                $Ses_Data = array(
                    "UyeID" => $UyeDVO[0]->UyeID,
                    "AdSoyad" => $UyeDVO[0]->AdSoyad,
                    "Email" => $UyeDVO[0]->Email,
                    "Yetki" => $UyeDVO[0]->Yetki,
                    "logged_in" => TRUE
                );
                $this->session->set_userdata($Ses_Data);
                redirect(base_url() . "Admin\Home");
            } else {
                $this->session->set_flashdata("Message", "Hatalı Kullanıcı Adı veya Şifre Girdiniz!!!");
                redirect(base_url() . "Admin\Login");
            }
        }
        else {
            $this->session->set_flashdata("Message", "Hatalı Kullanıcı Adı veya Şifre Girdiniz!!!");
            redirect(base_url() . "Admin\Login");
        }
    }
    public function LogOut() {
        $this->session->unset_userdata('Logged_In');
        $this->load->view('Admin/Login','Refresh');
    }

}
?>