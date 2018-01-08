<?php
class Kategori_Model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }
    Public function GetKategoriList()
    {
        $this->db->select("K.*,UK.KategoriAdi UstAdi");
        $this->db->from('Kategoriler K');
        $this->db->join('Kategoriler UK','UK.KategoriID=K.Ust_ID','left');
        $result = $this->db->get();
        if ($result->num_rows()>0)
            return $result->result();
    }
    public function GetUstKategori(){
        $this->db->select("KategoriID,KategoriAdi");
        $this->db->where("Aktif","1");
        $result=$this->db->get('Kategoriler');
        if ($result->num_rows()>0)
            return $result->result();
    }
    public function GetReyonList(){
        $this->db->select("ReyonID,ReyonAdi")->where("Aktif","1");
        $result=$this->db->get('Reyonlar');
        if ($result->num_rows()>0)
            return $result->result();
    }
    public  function  GetKategoriDetay($Id){
        $this->db->where("KategoriID",$Id);
        $result= $this->db->get("Kategoriler");
        if ($result->num_rows()>0)
            return $result->first_row();
        else
            return null;
    }
    public function SetInsertKategori($Kategori){
        $result = $this->db->insert("Kategoriler",$Kategori);
        return $result;
    }
    public function SetUpdateKategori($Kategori,$Id){
        $this->db->where("KategoriID",$Id);
        $result = $this->db->update("Kategoriler",$Kategori);
        return $result;
    }
    public  function SetDeleteKategori($Id){
        $this->db->where("KategoriID",$Id);
        $result = $this->db->delete("Kategoriler");
        return $result;
    }
}
?>