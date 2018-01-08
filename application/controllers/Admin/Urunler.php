<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Urunler extends  CI_Controller{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url() . "Admin\Login");
        }
       $this->load->model('Urun_Model');
    }
    public  function  Index()
    {
        $Id=$this->session->userdata('UyeID');
        $data["Urunler"]=$this->Urun_Model->GetUrunList($Id);
        $this->load->view("Admin\Urunler\Urun_list",$data);
    }
    public function YeniUrun(){
        $Data["Kategoriler"]=$this->Urun_Model->GetUrunKategoriList();
        $this->load->view("Admin\Urunler\Urun_yeni",$Data);
    }
    public function Kaydet(){
        if ($this->session->userdata('UyeID')!=null) {
            $Urun = array(
                'Uye_ID' => $this->session->userdata('UyeID'),
                'UrunAdi' => $this->security->xss_clean($this->input->post("UrunAdi")),
                'Aciklama' => $this->security->xss_clean($this->input->post("Aciklama")),
                'Keywords' => $this->security->xss_clean($this->input->post("Keywords")),
                'Kodu' => $this->security->xss_clean($this->input->post("Kodu")),
                'Kategori_ID' => $this->security->xss_clean($this->input->post("KategoriAdi")),
                'Detay' => $this->security->xss_clean($this->input->post("Detay")),
                'AlisFiyat' => $this->security->xss_clean($this->input->post("AlisFiyat")),
                'SatisFiyat' => $this->security->xss_clean($this->input->post("SatisFiyat")),
                'Birim' => $this->security->xss_clean($this->input->post("Birim")),
                'Miktar' => $this->security->xss_clean($this->input->post("Miktar")),
                'Beden' => $this->security->xss_clean($this->input->post("Beden")) == "1" ? "1" : "0",
                'Renk' => $this->security->xss_clean($this->input->post("Renk")) == "1" ? "1" : "0",
                'Durum' => $this->security->xss_clean($this->input->post("Durum")) == "1" ? "1" : "0",
                'Tarih' => date('y-m-d'),
                'Miad' => date('Y-m-d', strtotime($this->security->xss_clean($this->input->post("Miad"))))
            );
            $Sonuc = $this->Urun_Model->SetInsertUrun($Urun);
            if ($Sonuc==1){
                $this->session->set_flashdata("Message", "Yeni Ürün Kaydetme İşlemi Başarıyla Yapıldı !");
                $this->session->set_flashdata("Kod", "0");
                redirect(base_url("Admin\Urunler") );
            }
            else{
                $this->session->set_flashdata("Message", "Yeni Ürün Kaydetme İşlemi Yapılamadı !!!");
                $this->session->set_flashdata("Kod", "3");
                redirect(base_url("Admin\Urunler") );
            }
        }
        else{
            $this->session->set_flashdata("Message", "Üye Girişi Yapılmamış Yeniden Giriş Yapılmalı !!!");
            $this->session->set_flashdata("Kod", "3");
            redirect(base_url("Admin\Urunler") );
        }
    }
    public function Duzenle($Id){
        $data["Urun"] = $this->Urun_Model->GetUrunDetay($Id);
        $data["Kategoriler"]=$this->Urun_Model->GetUrunKategoriList();
        $this->load->view("Admin\Urunler\Urun_duzenle",$data);
    }
    public function Guncelle(){
        $Id = $this->security->xss_clean($this->input->post("ID"));
        $Urun = array(
            'Uye_ID' => $this->session->userdata('UyeID'),
            'UrunAdi' => $this->security->xss_clean($this->input->post("UrunAdi")),
            'Aciklama' => $this->security->xss_clean($this->input->post("Aciklama")),
            'Keywords' => $this->security->xss_clean($this->input->post("Keywords")),
            'Kodu' => $this->security->xss_clean($this->input->post("Kodu")),
            'Kategori_ID' => $this->security->xss_clean($this->input->post("KategoriAdi")),
            'Detay' => $this->security->xss_clean($this->input->post("Detay")),
            'AlisFiyat' => $this->security->xss_clean($this->input->post("AlisFiyat")),
            'SatisFiyat' => $this->security->xss_clean($this->input->post("SatisFiyat")),
            'Birim' => $this->security->xss_clean($this->input->post("Birim")),
            'Miktar' => $this->security->xss_clean($this->input->post("Miktar")),
            'Beden' => $this->security->xss_clean($this->input->post("Beden")) == "1" ? "1" : "0",
            'Renk' => $this->security->xss_clean($this->input->post("Renk")) == "1" ? "1" : "0",
            'Durum' => $this->security->xss_clean($this->input->post("Durum")) == "1" ? "1" : "0",
            'Tarih' => date('y-m-d'),
            'Miad' => date('Y-m-d', strtotime($this->security->xss_clean($this->input->post("Miad"))))
        );
        $Sonuc = $this->Urun_Model->SetUpdateUrun($Urun,$Id);
        if ($Sonuc==1){
            $this->session->set_flashdata("Message", "Ürün Güncelleme İşlemi Başarıyla Yapıldı !");
            $this->session->set_flashdata("Kod", "0");
            redirect(base_url("Admin\Urunler") );
        }
        else{
            $this->session->set_flashdata("Message", "Ürün Güncelleme İşlemi Yapılamadı !!!");
            $this->session->set_flashdata("Kod", "3");
            redirect(base_url("Admin\Urunler") );
        }

    }
    public function Sil($Id){
        $Sonuc = $this->Urun_Model->SetDeleteUrun($Id);
        if ($Sonuc==1){
            $this->session->set_flashdata("Message", "Ürün Silme İşlemi Başarıyla Yapıldı !");
            $this->session->set_flashdata("Kod", "0");
            redirect(base_url("Admin\Urunler") );
        }
        else{
            $this->session->set_flashdata("Message", "Ürün Silme İşlemi Yapılamadı !");
            $this->session->set_flashdata("Kod", "3");
            redirect(base_url("Admin\Urunler") );
        }
    }
    public function ResimEkle($Id){
        $data["Urun"] = $this->Urun_Model->GetUrunResimDetay($Id);
        $this->load->view("Admin\Urunler\Resim_ekle",$data);
    }
    public function ResimYukle($Id){
        $new_name = $Id."_".date("ymd")."_".time();
        $config['upload_path'] = './Uploads/Urun_Resim/';
        $config['allowed_types'] = 'gif|jpg|png|bmp';
        $config['file_name'] = $new_name;
        $config['max_size'] = '500';
        $config['max_width']  = '700';
        $config['max_height']  = '700';
        $this->load->library('upload', $config);
        if(!is_dir($config['upload_path'])){
            mkdir($config['upload_path'], 0755, TRUE);
        }
        if (!$this->upload->do_upload("Resim")){ //Upload file
            $error=$this->upload->display_errors();
            $this->session->set_flashdata("Message", "Yükleme Hatası : ".$error);
            $this->session->set_flashdata("Kod", "3");
            $data["Urun"] = $this->Urun_Model->GetUrunResimDetay($Id);
            $this->load->view("Admin\Urunler\Resim_ekle",$data);
        }
        else
        {
            $upload_data = $this->upload->data();
            $Urun = array(
                'Resim' => $upload_data["file_name"],
            );
            $Sonuc = $this->Urun_Model->SetUpdateUrun($Urun,$Id);
            if ($Sonuc==1){
                $this->session->set_flashdata("Message", "Ürün Resim Ekleme İşlemi Başarıyla Yapıldı !");
                $this->session->set_flashdata("Kod", "0");
            }
            else{
                $this->session->set_flashdata("Message", "Ürün Resim Ekleme yapıldı ama Veritabanına Kayıt Yapılamadı !!!");
                $this->session->set_flashdata("Kod", "1");
            }
            $data["Urun"] = $this->Urun_Model->GetUrunResimDetay($Id);
            $this->load->view("Admin\Urunler\Resim_ekle",$data);
        }
    }
    public function GaleriEkle($Id){
        $data["Urun"] = $this->Urun_Model->GetUrunResimDetay($Id);
        $data["UResimler"]=$this->Urun_Model-> GetGaleriResimList($Id);
        $this->load->view("Admin\Urunler\Galeri_ekle",$data);
    }
    public function GaleriYukle($Id){
        $new_name = $Id."_".date("ymd")."_".time();
        $config['upload_path'] = './Uploads/Galeri_Resim/';
        $config['allowed_types'] = 'gif|jpg|png|bmp';
        $config['file_name'] = $new_name;
        $config['max_size'] = '1000';
        $config['max_width']  = '1000';
        $config['max_height']  = '1000';
        $this->load->library('upload', $config);
        if(!is_dir($config['upload_path'])){
            mkdir($config['upload_path'], 0755, TRUE);
        }
        if (!$this->upload->do_upload("Resim")){ //Upload file
            $error=$this->upload->display_errors();
            $this->session->set_flashdata("Message", "Yükleme Hatası : ".$error);
            $this->session->set_flashdata("Kod", "3");
        }
        else
        {
            $upload_data = $this->upload->data();
            $UResim= array(
                'UrunID' => $Id,
                'Resim' =>  $upload_data["file_name"]
            );
            $Sonuc = $this->Urun_Model->SetInsertUrunGaleriResim($UResim);
            if ($Sonuc==1){
                $this->session->set_flashdata("Message", "Ürün Galeri Resim Ekleme İşlemi Başarıyla Yapıldı !");
                $this->session->set_flashdata("Kod", "0");
            }
            else{
                $this->session->set_flashdata("Message", "Ürün Galeri Resim Ekleme yapıldı ama Veritabanına kaydedilemedi İşlemi Yapılamadı !!!");
                $this->session->set_flashdata("Kod", "3");
            }
        }
        $data["Urun"] = $this->Urun_Model->GetUrunResimDetay($Id);
        $data["UResimler"]=$this->Urun_Model-> GetGaleriResimList($Id);
        $this->load->view("Admin\Urunler\Galeri_ekle",$data);
    }
    public function GaleriSil($Id){
        $ResimD= $this->Urun_Model->GetGaleriResimDetay($Id);

        $Sonuc = $this->Urun_Model->SetDeleteUrunGaleriResim($ResimD->ID);
        if ($Sonuc==1){
            $this->session->set_flashdata("Message", "Ürün Galeri Resim Veritabanından Silindi!!!");
            $this->session->set_flashdata("Kod", "0");
        }
        else{
            $this->session->set_flashdata("Message", "Ürün Galeri Resim Silme İşlemi Yapılamadı !");
            $this->session->set_flashdata("Kod", "3");
        }
        $data["Urun"] = $this->Urun_Model->GetUrunResimDetay($ResimD->UrunID);
        $data["UResimler"]=$this->Urun_Model-> GetGaleriResimList($ResimD->UrunID);
        $this->load->view("Admin\Urunler\Galeri_ekle",$data);
    }
}
?>