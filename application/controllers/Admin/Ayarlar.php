<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ayarlar extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url() . "Admin\Login");
        }
        else {
            if ($this->session->userdata('Yetki')!=2) {
                $this->session->set_flashdata("Message", "Bu Bölüme Girmeye Yetkili Değilsiniz!!!");
                redirect(base_url() . "Admin\Home");
            }
        }
        $this->load->model('Ayar_Model');
    }
    public  function  Index()
    {
        $data["Ayarlar"]=$this->Ayar_Model->GetAyarList();
        $this->load->view("Admin\Ayarlar\Ayar_list",$data);

    }
    public function  YeniAyar (){
        $this->load->view("Admin\Ayarlar\Ayar_Yeni");
    }
    public function  Kaydet(){
        $Ayar = array(
            'Adi' => $this->security->xss_clean($this->input->post("Adi")),
            'Aciklama' => $this->security->xss_clean($this->input->post("Aciklama")),
            'Keywords' => $this->security->xss_clean($this->input->post("Keywords")),
            'TamAdi' => $this->security->xss_clean($this->input->post("TamAdi")),
            'Telefon' => $this->security->xss_clean($this->input->post("Telefon")),
            'Email' => $this->security->xss_clean($this->input->post("Email")),
            'VergiNo' => $this->security->xss_clean($this->input->post("VergiNo")),
            'Adres' => $this->security->xss_clean($this->input->post("Adres")),
            'Sehir' => $this->security->xss_clean($this->input->post("Sehir")),
            'SmtpServer' => $this->security->xss_clean($this->input->post("SmtpServer")),
            'SmtpEmail' => $this->security->xss_clean($this->input->post("SmtpEmail")),
            'SmtpSifre' => $this->security->xss_clean($this->input->post("SmtpSifre")),
            'SmtpPort' => $this->security->xss_clean($this->input->post("SmtpPort")),
            'Facebook' => $this->security->xss_clean($this->input->post("Facebook")),
            'Twitter' => $this->security->xss_clean($this->input->post("Twitter")),
            'Aktif' => $this->security->xss_clean($this->input->post("Aktif")) == "1" ? "1":"0"
        );
        $Sonuc = $this->Ayar_Model->SetInsertAyar($Ayar);
        if ($Sonuc==1){
            $this->session->set_flashdata("Message", "Yeni Ayar Kaydetme İşlemi Başarıyla Yapıldı !");
            $this->session->set_flashdata("Kod", "0");
            redirect(base_url("Admin\Ayarlar") );
        }
        else{
            $this->session->set_flashdata("Message", "Yeni Ayar Kaydetme İşlemi Yapılamadı !!!");
            $this->session->set_flashdata("Kod", "3");
            redirect(base_url("Admin\Ayarlar") );
        }
    }
    public function Duzenle($Id){
        $data["Ayar"] = $this->Ayar_Model->GetAyarDetay($Id);
        $this->load->view("Admin\Ayarlar\Ayar_duzenle",$data);
    }
    public function Guncelle(){
        $Id = $this->security->xss_clean($this->input->post("ID"));
        $Ayar = array(
            'Adi' => $this->security->xss_clean($this->input->post("Adi")),
            'Aciklama' => $this->security->xss_clean($this->input->post("Aciklama")),
            'Keywords' => $this->security->xss_clean($this->input->post("Keywords")),
            'TamAdi' => $this->security->xss_clean($this->input->post("TamAdi")),
            'Telefon' => $this->security->xss_clean($this->input->post("Telefon")),
            'Email' => $this->security->xss_clean($this->input->post("Email")),
            'VergiNo' => $this->security->xss_clean($this->input->post("VergiNo")),
            'Adres' => $this->security->xss_clean($this->input->post("Adres")),
            'Sehir' => $this->security->xss_clean($this->input->post("Sehir")),
            'SmtpServer' => $this->security->xss_clean($this->input->post("SmtpServer")),
            'SmtpEmail' => $this->security->xss_clean($this->input->post("SmtpEmail")),
            'SmtpSifre' => $this->security->xss_clean($this->input->post("SmtpSifre")),
            'SmtpPort' => $this->security->xss_clean($this->input->post("SmtpPort")),
            'Facebook' => $this->security->xss_clean($this->input->post("Facebook")),
            'Twitter' => $this->security->xss_clean($this->input->post("Twitter")),
            'Aktif' => $this->security->xss_clean($this->input->post("Aktif")) == "1" ? "1":"0"
        );
        $Sonuc = $this->Ayar_Model->SetUpdateAyar($Ayar,$Id);
        if ($Sonuc == 1){
            $this->session->set_flashdata("Message", "Ayar Güncelleme İşlemi Başarıyla Yapıldı !");
            $this->session->set_flashdata("Kod", "0");
            redirect(base_url("Admin\Ayarlar") );
        }
        else{
            $this->session->set_flashdata("Message", "Ayar Güncelleme İşlemi Yapılamadı !!!");
            $this->session->set_flashdata("Kod", "3");
            redirect(base_url("Admin\Ayarlar") );
        }
    }
    public function Sil($Id){
        $Sonuc = $this->Ayar_Model->SetDeleteAyar($Id);
        if ($Sonuc==1){
            $this->session->set_flashdata("Message", "Ayar Silme İşlemi Başarıyla Yapıldı !");
            $this->session->set_flashdata("Kod", "0");
            redirect(base_url("Admin\Ayarlar") );
        }
        else{
            $this->session->set_flashdata("Message", "Ayar Silme İşlemi Yapılamadı !");
            $this->session->set_flashdata("Kod", "3");
            redirect(base_url("Admin\Ayarlar") );
        }
    }
}
?>