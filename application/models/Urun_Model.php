<?php
include_once (dirname(__FILE__) . "/Main_Model.php");
class Urun_Model extends Main_Model {
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }
    Public function GetUrunList($Id)
    {
        $this->db->select("U.*,K.KategoriAdi");
        $this->db->from('Urunler U');
        $this->db->join('Kategoriler K','K.KategoriID=U.Kategori_ID','left');
        $this->db->where("U.Uye_ID",$Id);
        $result = $this->db->get();
        if ($result->num_rows()>0)
            return $result->result();
    }
    public function GetUrunKategoriList(){
        $this->db->select("KategoriID,KategoriAdi");
        $this->db->where("Aktif","1");
        $result=$this->db->get('Kategoriler');
        if ($result->num_rows()>0)
            return $result->result();
    }
    public function SetInsertUrun($Urun){
        $result = $this->db->insert("Urunler",$Urun);
        return $result;
    }
    Public function GetUrunDetay($Id)
    {
        $this->db->where("ID",$Id);
        $result= $this->db->get("Urunler");
        if ($result->num_rows()>0)
            return $result->first_row();
        else
            return null;
    }

    public function SetDeleteUrun($Id){
        $this->db->where("ID",$Id);
        $result = $this->db->delete("Urunler");
        return $result;
    }
    Public function GetUrunResimDetay($Id)
    {
        $result=$this->db->select("ID,Kodu,UrunAdi,Resim")->where("ID",$Id)->get("Urunler");
        if ($result->num_rows()>0)
            return $result->first_row();
    }
    public function SetInsertUrunGaleriResim($UResim){
        $result = $this->db->insert("UrunResimler",$UResim);
        return $result;
    }
    Public function GetGaleriResimList($Id)
    {
        $this->db->from('UrunResimler')->where("UrunID",$Id);
        $result = $this->db->get();
        if ($result->num_rows()>0)
            return $result->result();
    }
    public function SetDeleteUrunGaleriResim($Id){
        $this->db->where("ID",$Id);
        $result = $this->db->delete("UrunResimler");
        return $result;
    }
    public function GetGaleriResimDetay($Id){
        $this->db->where("ID",$Id);
        $result= $this->db->get("UrunResimler");
        if ($result->num_rows()>0)
            return $result->first_row();
        else
            return null;
    }

}
?>
