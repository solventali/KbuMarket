<?php
include_once (dirname(__FILE__) . "/Main_Model.php");
class Yorum_Model extends Main_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    /*İşlem Yapılacak Yorumların Listelenmesi */
    public function GetYorumList() {
        $query = $this->db->query("SELECT Y.Tarih,Y.YorumID,Y.Baslik,Y.Durum,Y.Puan,U.Kodu,U.UrunAdi,M.AdSoyad FROM yorumlar Y ".
            "INNER JOIN urunler U ON Y.UrunID=U.ID INNER JOIN musteriler M ON Y.CustomerID=M.ID");
        return $query->Result();
    }
    /* İşlem Yapılacak Yorum Detayı */
    public function GetYorumDetay($Id) {
        $query = $this->db->query("SELECT Y.*,U.Kodu,U.UrunAdi,M.AdSoyad,Y.YorumNeden FROM yorumlar Y ".
            "INNER JOIN urunler U ON Y.UrunID=U.ID INNER JOIN musteriler M ON Y.CustomerID=M.ID WHERE Y.YorumID=$Id");
        return $query->row(0);
    }
    public function YorumGuncelle($YorumID,$YorumNeden,$Durum) {
        $this->db->set('YorumNeden', $YorumNeden);
        $this->db->set('Durum', $Durum);
        $this->db->where('YorumID', $YorumID);
        $result = $this->db->update('Yorumlar');
        return $result;
    }
    /*Kayıtlı Üye Silme İşlemi*/
    public  function SetDeleteYorum($Id){
        $this->db->where("YorumID",$Id);
        $result = $this->db->delete("Yorumlar");
        return $result;
    }

}