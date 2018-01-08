<?php

class Uye_Model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }
    /*Kayıtlı Üye Listesi Alma*/
    public  function GetUyeList(){
        $result= $this->db->get("Uyeler");
        if ($result->num_rows()>0)
            return $result->result();
        else
            return null;
    }
    /*Kayıtlı Üye Bilgisi Alma*/
    public  function  GetUyeDetay($Id){
        $this->db->where("UyeID",$Id);
        $result= $this->db->get("Uyeler");
        if ($result->num_rows()>0)
            return $result->first_row();
        else
            return null;
    }
    /*Yeni Üye Kayıt İşlemi */
    public function SetInsertUye($Uyeler){
        $result = $this->db->insert("Uyeler",$Uyeler);
        return $result;
    }
    /* Kayıtlı Üye Güncelleme İşlemi*/
    public function SetUpdateUyeler($Uyeler,$Id){
        $this->db->where("UyeID",$Id);
        $result = $this->db->update("Uyeler",$Uyeler);
        return $result;
    }
    /*Kayıtlı Üye Silme İşlemi*/
    public  function SetDeleteUyeler($Id){
        $this->db->where("UyeID",$Id);
        $result = $this->db->delete("Uyeler");
        return $result;
    }

}

?>