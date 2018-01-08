<?php
include_once (dirname(__FILE__) . "/Main_Model.php");
class Front_Model extends Main_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /*Ürün Listeleme İşlemleri*/
    public function EnYeniUrunler(){
        $query = $this->db->query("SELECT ID,UrunAdi,Kodu,SatisFiyat,Birim,Resim,CASE WHEN DATEDIFF(CURDATE(),Tarih)<7 THEN 1 ELSE 0 END AS Yeni ".
            " FROM urunler ORDER BY ID DESC LIMIT 10");
        return $query->result();
    }


    /*Sepet ekleme ve iptal işlemleri */
    public function SepetCount($Id){
        $query = $this->db->query("SELECT COUNT(*) AS Sayi FROM Sepet WHERE MusteriID=$Id ");
        return $query->row(0)->Sayi;
    }
    public function SetUrunInsertSepet($Sepet){
        $result = $this->db->insert("Sepet",$Sepet);
        return $result;
    }
    public function GetSepetList($CustomerID){
        $query = $this->db->query("SELECT S.SepetID,S.UrunID,U.Kodu,U.UrunAdi,S.Beden,S.Renk,S.Miktar,U.SatisFiyat,U.Birim,U.Resim ".
                " FROM SEPET S INNER JOIN urunler U ON S.UrunID=U.ID WHERE S.MusteriID=$CustomerID ORDER BY S.SepetID ASC");
        return $query->result();
    }
    public function GetSepetUrunDetay($Id){
        $this->db->where("SepetID",$Id);
        $result= $this->db->get("Sepet");
        if ($result->num_rows()>0)
            return $result->first_row();
        else
            return null;
    }
    public function SepetUrunSil($Id){
        $this->db->where("SepetID",$Id);
        $result = $this->db->delete("Sepet");
        return $result;
    }
    public function SepetTemizle($Id){
        $this->db->where("MusteriID",$Id);
        $result = $this->db->delete("Sepet");
        return $result;
    }
    public function SepetTutar($Id){
        $query = $this->db->query("SELECT SUM(S.Miktar*U.SatisFiyat) AS Tutar FROM Sepet S INNER JOIN urunler U ".
            " ON S.UrunID=U.ID WHERE MusteriID=$Id ");
        return $query->row(0)->Tutar;
    }

    /*Sipariş - ÖDeme İşlemleri*/
    public function SiparisOdeme($Siparis){
        $result = $this->db->insert("siparisler",$Siparis);
        if ($result)
            return $this->db->insert_id();
        else
            return 0;
    }
    public function SiparisUrunInsert($Sd) {
        $result = $this->db->insert("siparis_detay",$Sd);
        return $result;
    }
    public function GetSiparisList($CustomerID) {
        $query = $this->db->query("SELECT S.SiparisID,M.AdSoyad,S.Tarih,S.OdemeTuru,S.OdemeDurumu,S.SiparisDurumu,S.FaturaTelefon ".
            " FROM siparisler S INNER JOIN musteriler M ON S.MusteriID=M.ID WHERE S.MusteriID=$CustomerID ORDER BY S.SiparisDurumu ASC");
        return $query->result();
    }
    public function GetSiparisDetay($Id) {
        $this->db->where("SiparisID",$Id);
        $result= $this->db->get("Siparisler");
        if ($result->num_rows()>0)
            return $result->first_row();
        else
            return null;
    }
    public function GetSiparisUrunList($SiparisID){
        $query = $this->db->query("SELECT S.RecID,S.UrunID,S.Renk,S.Beden,U.Kodu,U.UrunAdi,S.Miktar,SatisFiyat,S.Tutar,U.Resim ".
            " FROM siparis_detay S INNER JOIN urunler U ON S.UrunID=U.ID WHERE S.SiparisID=$SiparisID");
        return $query->result();
    }

    /*Müşteri Giriş İşlemi*/
    public function CustomerLogin($Email,$Password){
        $this->db->where('Email', $Email)->where('Sifre', $Password)->where('Durum', "1");
        $Sonuc = $this->db->get("Musteriler");
        if ($Sonuc->num_rows()>0)
            return $Sonuc->first_row();
        else
            return null;
    }
    public function MusteriKayit($Customer) {
        $result = $this->db->insert("musteriler",$Customer);
        return $result;
    }
    public function SifreHatirlat($Email) {
        $query = $this->db->query("SELECT M.ID,M.AdSoyad,M.Email,M.Sifre FROM musteriler M WHERE M.Durum=1 AND M.Email='$Email'");
        return $query->row(0);
    }
    public function SifreKontrol($Key,$CustomerID) {
        $this->db->set('SifreKontrol', $Key);
        $this->db->where('ID', $CustomerID);
        $result = $this->db->update('musteriler');
        return $result;
    }
    public function KeyMusteriDetay($Key) {
        $this->db->where("SifreKontrol",$Key);
        $result= $this->db->get("musteriler");
        if ($result->num_rows()>0)
            return $result->first_row();
        else
            return null;
    }
    public function YeniSifreOnay($Customer) {
        $this->db->where("ID",$Customer->ID);
        $result = $this->db->update("musteriler",$Customer);
        return $result;
    }
    public function GetMusteriDetay($Id) {
        $this->db->where("ID",$Id);
        $result= $this->db->get("musteriler");
        if ($result->num_rows()>0)
            return $result->first_row();
        else
            return null;
    }
    public function MusteriGuncelle($Customer,$Id) {
        $this->db->where("ID",$Id);
        $result = $this->db->update("musteriler",$Customer);
        return $result;
    }
    public function ProfilResimGuncelle($Resim,$CustomerID) {
        $this->db->set('Resim', $Resim);
        $this->db->where('ID', $CustomerID);
        $result = $this->db->update('musteriler');
        return $result;
    }

}