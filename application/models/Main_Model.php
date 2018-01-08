<?php
/**
 * Created by PhpStorm.
 * User: riddick
 * Date: 28.12.2017
 * Time: 17:28
 */
class Main_Model extends CI_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('captcha');
        $this->load->helper('string');
    }
    public function SetUpdateUrun($Urun,$Id){
        $this->db->where("ID",$Id);
        $result = $this->db->update("Urunler",$Urun);
        return $result;
    }

    /*Recursive Ürün Çağırma */
    public function GetUrunList($Id)
    {
        $uruns = $this->db->query("SELECT U.ID,U.Kategori_ID,K.KategoriAdi,U.UrunAdi,U.Kodu,U.SatisFiyat,U.Birim,U.Resim, " .
            " CASE WHEN DATEDIFF(CURDATE(),U.Tarih)<7 THEN 1 ELSE 0 END AS Yeni " .
            " FROM urunler U INNER JOIN kategoriler K ON U.Kategori_ID=K.KategoriID Where U.Kategori_ID=$Id ")->result();

        $this->db->select("KategoriID")->where("Aktif", "1")->where("Ust_ID", $Id);
        $childs = $this->db->get('Kategoriler')->result();
        if ($childs) {
            foreach ($childs as $child) {
                $alturuns = $this->GetUrunList($child->KategoriID);
                foreach ($alturuns as $alturun) {
                    array_push($uruns, $alturun);
                }
            }
        }
        return $uruns;
    }
    Public function GetUrunDetay($Id)
    {
        $this->db->where("ID", $Id);
        $result = $this->db->get("Urunler");
        if ($result->num_rows() > 0)
            return $result->first_row();
        else
            return null;
    }
    Public function GetUrunResimList($UrunId)
    {
        $query = $this->db->query("SELECT * FROM urunresimler WHERE UrunID=$UrunId ORDER BY ID ASC");
        return $query->result();
    }

    /* Menü Listeleme İşlemleri*/
    public function GetKategoriler($Id){

        $this->db->select("KategoriID,KategoriAdi")->where("Aktif","1")->where("Ust_ID",$Id);
        $parent=$this->db->get('Kategoriler');


        $categories = $parent->result();
        foreach($categories as $cat){
            $cat->sub = $this->GetKategoriler($cat->KategoriID);
        }
        return $categories;
    }
    public function GetAyarDetay(){
        $query = $this->db->query("SELECT  * FROM Ayarlar WHERE Aktif = 1  LIMIT 1");
        return $query->row(0);
    }
    public function GetCaptcha() {
        $values = array(
            'img_path' => './Uploads/images/',
            'img_url' => base_url() .'Uploads/images/',
            'font_path' => './system/fonts/corbel.ttf',
            'img_width' => 150,
            'img_height' => 40,
            'font_size' => 20,
            'word' => '',
            'word_length' => 5,
            'expiration' => 3600,
            'colors' => array(
                'background' => array (0,0,0),
                'border' => array (255,255,255),
                'text' => array (255,255,255),
                'grid' => array (255,0,0),

            )
        );
        $data = create_captcha($values);
        $this->session->unset_userdata('Captcha');
        $this->session->set_userdata('Captcha',$data['word']);
        return $data;
    }
    /* Yorum İşlemleri */
    public function SetInsertYorum($Yorum) {
        $result = $this->db->insert("yorumlar",$Yorum);
        return $result;
    }
    public function GetYorumPuan($Id) {
        $query = $this->db->query("SELECT IFNULL(ROUND(SUM(PUAN)/COUNT(*),2),0) Puans FROM yorumlar WHERE UrunID=$Id");
        return $query->row(0)->Puans;
    }
}