<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Uyeler extends  CI_Controller{
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
        $this->load->model('Uye_Model');
    }
    public  function  Index()
    {
        $data["Uyeler"]=$this->Uye_Model->GetUyeList();
        $this->load->view("Admin\Uyeler\uye_list",$data);
    }
    public  function  Duzenle ($Id){
        $data["Uye"] = $this->Uye_Model->GetUyeDetay($Id);
        $this->load->view("Admin\Uyeler\uye_duzenle",$data);
    }
    public function  Guncelle(){
        $UyeID = $this->security->xss_clean($this->input->post("UyeID"));
        $Uyeler = array(
            'AdSoyad' => $this->security->xss_clean($this->input->post("AdSoyad")),
            'Email' => $this->security->xss_clean($this->input->post("Email")),
            'Sifre' => $this->security->xss_clean($this->input->post("Sifre")),
            'DgmTarih' => date('Y-m-d',strtotime($this->security->xss_clean($this->input->post("DgmTarih")))),
            'Yetki' => $this->security->xss_clean($this->input->post("Yetki")),
            'Aktif' => $this->security->xss_clean($this->input->post("Aktif")) == "1" ? "1":"0",
            'Telefon' => $this->security->xss_clean($this->input->post("Telefon"))
        );
        $Sonuc = $this->Uye_Model->SetUpdateUyeler($Uyeler,$UyeID);
        if ($Sonuc==1){
            $this->session->set_flashdata("Message", "Üye Güncelleme İşlemi Başarıyla Yapıldı !");
            $this->session->set_flashdata("Kod", "0");
            redirect(base_url("Admin\Uyeler") );
        }
        else{
            $this->session->set_flashdata("Message", "Üye Güncelleme İşlemi Yapılamadı !");
            $this->session->set_flashdata("Kod", "3");
            redirect(base_url("Admin\Uyeler") );
        }
    }
    public  function  YeniUye(){
        $this->load->view("Admin\Uyeler\uye_yeni");
    }
    public function  Kaydet(){
        $Uyeler = array(
            'AdSoyad' => $this->security->xss_clean($this->input->post("AdSoyad")),
            'Email' => $this->security->xss_clean($this->input->post("Email")),
            'Sifre' => $this->security->xss_clean($this->input->post("Sifre")),
            'DgmTarih' => date('Y-m-d',strtotime($this->security->xss_clean($this->input->post("DgmTarih")))),
            'Yetki' => $this->security->xss_clean($this->input->post("Yetki")),
            'Aktif' => $this->security->xss_clean($this->input->post("Aktif")) == "1" ? "1":"0",
            'Telefon' => $this->security->xss_clean($this->input->post("Telefon"))
        );
        $Sonuc = $this->Uye_Model->SetInsertUye($Uyeler);
        if ($Sonuc==1){
            $this->session->set_flashdata("Message", "Yeni Üye Kaydetme İşlemi Başarıyla Yapıldı !");
            $this->session->set_flashdata("Kod", "0");
            redirect(base_url("Admin\Uyeler") );
        }
        else{
            $this->session->set_flashdata("Message", "Yeni Üye Kaydetme İşlemi Yapılamadı !");
            $this->session->set_flashdata("Kod", "3");
            redirect(base_url("Admin\Uyeler") );
        }
    }
    public  function  Sil ($Id){
        $Sonuc = $this->Uye_Model->SetDeleteUyeler($Id);
        if ($Sonuc==1){
            $this->session->set_flashdata("Message", "Üye Silme İşlemi Başarıyla Yapıldı !");
            $this->session->set_flashdata("Kod", "0");
            redirect(base_url("Admin\Uyeler") );
        }
        else{
            $this->session->set_flashdata("Message", "Üye Silme İşlemi Yapılamadı !");
            $this->session->set_flashdata("Kod", "3");
            redirect(base_url("Admin\Uyeler") );
        }
    }
}
?>