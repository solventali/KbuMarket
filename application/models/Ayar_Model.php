<?php
class Ayar_Model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }
    public function GetAyarList(){
        $this->db->select("ID,Adi,TamAdi,VergiNo,Email,Aktif");
        $result=$this->db->get('Ayarlar');
        if ($result->num_rows()>0)
            return $result->result();
    }
    public function GetAyarDetay($Id){
        $this->db->where("ID",$Id);
        $result= $this->db->get("Ayarlar");
        if ($result->num_rows()>0)
            return $result->first_row();
        else
            return null;
    }
    public function SetInsertAyar($Ayar){
        $result = $this->db->insert("Ayarlar",$Ayar);
        return $result;
    }
    public function SetUpdateAyar($Ayar,$Id){
        $this->db->where("ID",$Id);
        $result = $this->db->update("Ayarlar",$Ayar);
        return $result;
    }
    public  function SetDeleteAyar($Id){
        $this->db->where("ID",$Id);
        $result = $this->db->delete("Ayarlar");
        return $result;
    }
}