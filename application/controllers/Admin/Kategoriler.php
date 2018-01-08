<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kategoriler extends  CI_Controller{
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
        $this->load->model('Kategori_Model');
    }
    public  function  Index()
    {
        $data["Kategoriler"]=$this->Kategori_Model->GetKategoriList();
        $this->load->view("Admin\Kategoriler\Kategori_list",$data);

    }
    public function  YeniKategori(){
        $data["UstKategoriler"]=$this->Kategori_Model->GetUstKategori();
        $this->load->view("Admin\Kategoriler\Kategori_Yeni",$data);
    }
    public function  Kaydet(){
        $Kategori = array(
            'Ust_ID' => $this->security->xss_clean($this->input->post("UstAdi")),
            'KategoriAdi' => $this->security->xss_clean($this->input->post("KategoriAdi")),
            'Aciklama' => $this->security->xss_clean($this->input->post("Aciklama")),
            'Keywords' => $this->security->xss_clean($this->input->post("Keywords")),
            'Aktif' => $this->security->xss_clean($this->input->post("Aktif")) == "1" ? "1":"0"
        );
        $Sonuc = $this->Kategori_Model->SetInsertKategori($Kategori);
        if ($Sonuc==1){
            $this->session->set_flashdata("Message", "Yeni Kategori Kaydetme İşlemi Başarıyla Yapıldı !");
            $this->session->set_flashdata("Kod", "0");
            redirect(base_url("Admin\Kategoriler") );
        }
        else{
            $this->session->set_flashdata("Message", "Yeni Kategori Kaydetme İşlemi Yapılamadı !!!");
            $this->session->set_flashdata("Kod", "3");
            redirect(base_url("Admin\Kategoriler") );
        }
    }
    public function  Duzenle($Id){
        $data["Category"] = $this->Kategori_Model->GetKategoriDetay($Id);
        $data["UstKategoriler"]=$this->Kategori_Model->GetUstKategori();
        $this->load->view("Admin\Kategoriler\Kategori_Duzenle",$data);
    }
    public function Guncelle(){
        $KategoriID = $this->security->xss_clean($this->input->post("KategoriID"));
        $Kategori = array(
            'Ust_ID' => $this->security->xss_clean($this->input->post("UstAdi")),
            'KategoriAdi' => $this->security->xss_clean($this->input->post("KategoriAdi")),
            'Aciklama' => $this->security->xss_clean($this->input->post("Aciklama")),
            'Keywords' => $this->security->xss_clean($this->input->post("Keywords")),
            'Aktif' => $this->security->xss_clean($this->input->post("Aktif")) == "1" ? "1":"0"
        );
        $Sonuc = $this->Kategori_Model->SetUpdateKategori($Kategori,$KategoriID);
        if ($Sonuc==1){
            $this->session->set_flashdata("Message", "Kategori Güncelleme İşlemi Başarıyla Yapıldı !");
            $this->session->set_flashdata("Kod", "0");
            redirect(base_url("Admin\Kategoriler") );
        }
        else{
            $this->session->set_flashdata("Message", "Kategori Güncelleme İşlemi Yapılamadı !!!");
            $this->session->set_flashdata("Kod", "3");
            redirect(base_url("Admin\Kategoriler") );
        }
    }
    public function Sil($Id){
        $Sonuc = $this->Kategori_Model->SetDeleteKategori($Id);
        if ($Sonuc==1){
            $this->session->set_flashdata("Message", "Kategori Silme İşlemi Başarıyla Yapıldı !");
            $this->session->set_flashdata("Kod", "0");
            redirect(base_url("Admin\Kategoriler") );
        }
        else{
            $this->session->set_flashdata("Message", "Kategori Silme İşlemi Yapılamadı !");
            $this->session->set_flashdata("Kod", "3");
            redirect(base_url("Admin\Kategoriler") );
        }
    }
}
?>