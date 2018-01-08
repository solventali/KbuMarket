<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Yorumlar extends  CI_Controller
{
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
        $this->load->model('Yorum_Model');
        $this->load->library('user_agent');
    }
    public function Index() {
        $data["Yorumlar"]=$this->Yorum_Model->GetYorumList();
        $this->load->view("Admin\Yorumlar\Yorum_list",$data);
    }
    public function Duzenle($Id) {
        $data["Yorum"] = $this->Yorum_Model->GetYorumDetay($Id);
        $this->load->view("Admin\Yorumlar\Yorum_Duzenle",$data);
    }
    public function Guncelle(){
        $YorumID = $this->security->xss_clean($this->input->post("YorumID"));
        $YorumNeden = $this->security->xss_clean($this->input->post("YorumNeden"));
        $YorumNeden = date('d.m.Y H:i:s')." - ".$YorumNeden;
        $Durum = $this->security->xss_clean($this->input->post("Durum"));
        $Sonuc = $this->Yorum_Model->YorumGuncelle($YorumID,$YorumNeden,$Durum);
        if ($Sonuc==1){
            $this->session->set_flashdata("Message", "Yorum Onaylama İşlemi Başarıyla Yapıldı !");
            $this->session->set_flashdata("Kod", "0");
            redirect(base_url("Admin\Yorumlar") );
        }
        else{
            $this->session->set_flashdata("Message", "Yorum Onaylama İşlemi Yapılamadı !!!");
            $this->session->set_flashdata("Kod", "3");
            redirect($this->agent->referrer());
        }
    }
    public function Sil($Id){
        $Sonuc = $this->Yorum_Model->SetDeleteYorum($Id);
        if ($Sonuc==1){
            $this->session->set_flashdata("Message", "Yorum Silme İşlemi Başarıyla Yapıldı !");
            $this->session->set_flashdata("Kod", "0");
            redirect($this->agent->referrer());
        }
        else{
            $this->session->set_flashdata("Message", "Yorum Silme İşlemi Yapılamadı !");
            $this->session->set_flashdata("Kod", "3");
            redirect($this->agent->referrer());
        }
    }
}