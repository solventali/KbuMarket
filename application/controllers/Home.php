<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    function  __construct()
    {
        parent::__construct();
        $this->load->model('Front_Model');
        $this->load->library('user_agent');
       // $this->load->library('email');
    }

    public function index()
    {
        $data["Menuler"]=$this->Front_Model->GetKategoriler(0);
        $data["Urunler"]=$this->Front_Model->EnYeniUrunler();
        if ($this->session->userdata('CustomerID'))
            $data["SC"]=  $this->Front_Model->SepetCount($this->session->userdata('CustomerID'));
        else
            $data["SC"]=0;
        $this->load->view('Home\Index',$data);
    }
    public function Login(){
        $Email = $this->security->xss_clean($this->input->post("CustomerEmail"));
        $Password = $this->security->xss_clean($this->input->post("CustomerPassword"));

        $Customer = $this->Front_Model->CustomerLogin($Email,$Password);
        if ($Customer) {
            $Ses_Data = array(
                "CustomerID" => $Customer->ID,
                "AdSoyad" => $Customer->AdSoyad,
                "Email" => $Customer->Email,
                "Resim" => $Customer->Resim,
                "customer_in" => TRUE
            );
            $this->session->set_userdata($Ses_Data);
            $this->session->set_flashdata("Message", "Hesap Girişiniz Başarıyla Yapılmıştır!");
            $this->session->set_flashdata("Kod", "0");
            redirect($this->agent->referrer());
        }
        else {
            $this->session->set_flashdata("Message", "Hatalı Kullanıcı Adı veya Şifre Girdiniz!!!");
            $this->session->set_flashdata("Kod", "3");
            redirect($this->agent->referrer());
        }
    }
    public function LogOut() {
        $this->session->unset_userdata('customer_in');
        $this->session->unset_userdata('AdSoyad');
        $this->session->unset_userdata('Email');
        $this->session->unset_userdata('CustomerID');
        $this->session->set_flashdata("Message", "Çıkış İşlemi Başarıyla Yapılmıştır,!!!");
        $this->session->set_flashdata("Kod", "0");
        redirect(base_url());
    }
    public function Category($Id){
        $data["Menuler"]=$this->Front_Model->GetKategoriler(0);
        $data["Urunler"]=$this->Front_Model->GetUrunList($Id);
        if ($this->session->userdata('CustomerID'))
            $data["SC"]=  $this->Front_Model->SepetCount($this->session->userdata('CustomerID'));
        else
            $data["SC"]=0;
        $this->load->view('Home\Index',$data);
    }
    public function Product($Id){
        $Urun = $this->Front_Model->GetUrunDetay($Id);
        $data["Menuler"]=$this->Front_Model->GetKategoriler(0);
        $data["Urun"]=$Urun;
        if ($this->session->userdata('CustomerID')) {
            $data["SC"] = $this->Front_Model->SepetCount($this->session->userdata('CustomerID'));
            $data["Puans"] = $this->Front_Model->GetYorumPuan($Id);
        }
        else {
            $data["SC"] = 0;
            $data["Puans"] = 0;
        }
        $data["Resimler"]=$this->Front_Model->GetUrunResimList($Urun->ID);
        $this->load->view('Home\Product',$data);
    }
    public function SepetEkle($Id){
        if ($this->session->userdata('customer_in')) {
            if ($this->session->userdata('CustomerID')) {
                $Urun = $this->Front_Model->GetUrunDetay($Id);

                $Sepet = array(
                    'MusteriID' => $this->session->userdata('CustomerID'),
                    'UrunID' => $Id,
                    'Miktar' => $this->security->xss_clean($this->input->post("Miktar")),
                    'Renk' => $Urun->Renk=="1" ? $this->security->xss_clean($this->input->post("Renk")): null,
                    'Beden' => $Urun->Beden=="1" ? $this->security->xss_clean($this->input->post("Beden")): null,
                );
                if ($Sepet["Miktar"]>$Urun->Miktar){
                    $this->session->set_flashdata("Message", "Talep Ettiğiniz Üründen Stoğumuzda ".$Urun->Miktar." Adet ile Sınırlıdır!!!");
                    $this->session->set_flashdata("Kod", "1");
                    redirect($this->agent->referrer());
                }
                /*Ürünün Sepete Eklenmesi*/
                $Sonuc= $this->Front_Model->SetUrunInsertSepet($Sepet);
                if ($Sonuc){
                    $this->session->set_flashdata("Message", "Talep Ettiğiniz Ürün Sepetinize Eklenmiştir!!!");
                    $this->session->set_flashdata("Kod", "0");
                    redirect($this->agent->referrer());
                }
                else {
                    $this->session->set_flashdata("Message", "Talep Ettiğiniz Ürün Sepete Ekleme Aşamasında Bir Sorun Oluştu ".
                        "Lütfen Yetkilelere Bildiriniz !!!");
                    $this->session->set_flashdata("Kod", "3");
                    redirect($this->agent->referrer());
                }
            }
        }
        else
        {
            $this->session->set_flashdata("Message", "Ürünü Sepete Ekleyebilmeniz İçin Giriş Yapmalısınız!!!");
            $this->session->set_flashdata("Kod", "1");
            redirect($this->agent->referrer());
        }
    }
    public function Sepet(){
        if ($this->session->userdata('CustomerID')){
            $data["Menuler"] = $this->Front_Model->GetKategoriler(0);
            if ($this->session->userdata('CustomerID'))
                $data["SC"] = $this->Front_Model->SepetCount($this->session->userdata('CustomerID'));
            else
                $data["SC"] = 0;
            $data["Urunler"] = $this->Front_Model->GetSepetList($this->session->userdata('CustomerID'));
            $this->load->view('Customer\Sepetim', $data);
        } else{
            $this->session->set_flashdata("Message", "Sepetinizi Görüntüleyebilmek için Giriş Yapmalısınız!!!");
            $this->session->set_flashdata("Kod", "1");
            redirect($this->agent->referrer());
        }


    }
    public function SepetSil($Id){
        $Sepet= $this->Front_Model->GetSepetUrunDetay($Id);
        if ($Sepet){


            /*Ürün Sepetten Çıkarılıyor*/
            $Sonuc= $this->Front_Model->SepetUrunSil($Id);
            if ($Sonuc){
                $this->session->set_flashdata("Message", "Seçilen Ürün Sepetten Kaldırılmıştır!!!");
                $this->session->set_flashdata("Kod", "0");
                redirect($this->agent->referrer());
            }
            else {
                $this->session->set_flashdata("Message", "Seçilen Ürün Sepetten Kaldırılırken Sorun Oluştu ".
                    "Lütfen Yetkilelere Bildiriniz !!!");
                $this->session->set_flashdata("Kod", "3");
                redirect($this->agent->referrer());
            }
        }
        else {
            $this->session->set_flashdata("Message", "Seçilen Ürün Sepette Bulunamadı!!!");
            $this->session->set_flashdata("Kod", "3");
            redirect($this->agent->referrer());
        }
    }
    public function SepetTemizle(){
        if ($this->session->userdata('customer_in')) {
            if ($this->session->userdata('CustomerID')) {
                $CustomerID = $this->session->userdata('CustomerID');
                $Sonuc = $this->Front_Model->SepetTemizle($CustomerID);
                if ($Sonuc){
                    $this->session->set_flashdata("Message", "Tüm Ürünler Sepetten Kaldırılmıştır !!!");
                    $this->session->set_flashdata("Kod", "0");
                    redirect($this->agent->referrer());
                }
                else {
                    $this->session->set_flashdata("Message", "Ürünler Sepetten Kaldırılırken Sorun Oluştu ".
                        "Lütfen Yetkilelere Bildiriniz !!!");
                    $this->session->set_flashdata("Kod", "3");
                    redirect($this->agent->referrer());
                }
            }
        }
    }
    public function Odeme() {
        if ($this->session->userdata('CustomerID')){
            $CustomerID=$this->session->userdata('CustomerID');
            $data["Menuler"] = $this->Front_Model->GetKategoriler(0);
            if ($this->session->userdata('CustomerID'))
                $data["SC"] = $this->Front_Model->SepetCount($CustomerID);
            else
                $data["SC"] = 0;
            $data["Tutar"]=$this->Front_Model->SepetTutar($CustomerID);
            $this->load->view('Customer\Odeme', $data);
        } else{
            $this->session->set_flashdata("Message", "Odeme Yapabilmeniz İçin için Giriş Yapmalısınız!!!");
            $this->session->set_flashdata("Kod", "1");
            redirect($this->agent->referrer());
        }

    }
    public function OdemeOnay(){
        if ($this->session->userdata('CustomerID')) {
            $CustomerID= $this->session->userdata('CustomerID');
            $Siparis = array(
                'MusteriID' => $CustomerID,
                'Tarih' => date('Y-m-d H:i:s'),
                'TeslimAdSoyad' => $this->security->xss_clean($this->input->post("TeslimAdSoyad")),
                'TeslimAdres' => $this->security->xss_clean($this->input->post("TeslimAdres")),
                'TeslimIlce' => $this->security->xss_clean($this->input->post("TeslimIlce")),
                'TeslimSehir' => $this->security->xss_clean($this->input->post("TeslimSehir")),
                'TeslimTelefon' => $this->security->xss_clean($this->input->post("TeslimTelefon")),

                'FaturaAdsoyad' => $this->security->xss_clean($this->input->post("FaturaAdsoyad")),
                'FaturaAdres' => $this->security->xss_clean($this->input->post("FaturaAdres")),
                'FaturaIlce' => $this->security->xss_clean($this->input->post("FaturaIlce")),
                'FaturaSehir' => $this->security->xss_clean($this->input->post("FaturaSehir")),
                'FaturaTelefon' => $this->security->xss_clean($this->input->post("FaturaTelefon")),
                'OdemeTuru' =>"Kredi Kartı",
                'OdemeDurumu' =>"Ödendi",
                'SiparisDurumu' =>"Hazırlanıyor",
                'IpAdres' =>$this->input->ip_address(),
                'Tutar' => $this->security->xss_clean($this->input->post("Tutar")),
            );
            /*Oluşturulan Sipariş Veritabanı İŞlemi Yapılıyor */
            $SiparisID = $this->Front_Model->SiparisOdeme($Siparis);
            if ($SiparisID>0) {
                $Sepets = $this->Front_Model->GetSepetList($CustomerID);
                    foreach ($Sepets as $Sepet) {
                        /*Sepetteki Ürünün Detay Bilgisi Veritabanından Alınıyor. ve
                        Sepet Miktarı Stok Miktarı ile karşılaştırılıyor*/
                        $Urun = $this->Front_Model->GetUrunDetay($Sepet->UrunID);
                        if ($Urun->Miktar>=$Sepet->Miktar) {
                            $Sd = array(
                                'MusteriID' => $CustomerID,
                                'SiparisID' => $SiparisID,
                                'UrunID' => $Sepet->UrunID,
                                'Renk' => $Sepet->Renk,
                                'Beden' => $Sepet->Beden,
                                'Miktar' => $Sepet->Miktar,
                                'Fiyat' => $Sepet->SatisFiyat,
                                'Tutar' => $Sepet->Miktar * $Sepet->SatisFiyat
                            );
                            if ($this->Front_Model->SiparisUrunInsert($Sd)) {
                                /*Sepetteki Ürünlerin Stoktan Düşülmesi*/
                                $Urun->Miktar= $Urun->Miktar-$Sepet->Miktar;
                                $UU = $this->Front_Model->SetUpdateUrun($Urun,$Sepet->UrunID);
                                if (!$UU==1){
                                    $this->session->set_flashdata("Message", $Urun->UrunAdi." İsimli Ürün Stoktan Düşülmesi İşleminde ".
                                        " Sorun Oluştu !!! Lütfen Yetkilelere Bildiriniz !!!");
                                    $this->session->set_flashdata("Kod", "3");
                                    redirect($this->agent->referrer());
                                }
                                /*Sepet içi Boşaltılıyor. */
                                $this->Front_Model->SepetTemizle($CustomerID);
                                $this->session->set_flashdata("Message", "Ödeme İşlemi Başarıyla Gerçekleştirildi " .
                                    "Sipariş Durumunuzu Siparişlerim bölümünden Takip Edebilirsiniz");
                                $this->session->set_flashdata("Kod", "0");
                                redirect(base_url("Home")."/Siparisler ");
                            }
                        }
                        /*ürün stoğunda yeterli miktar yoksa*/
                        else
                        {
                            $this->session->set_flashdata("Message", $Urun->UrunAdi." Sepette Yer Alan ".$Urun->UrunAdi." İsimli Ürün ".
                                " Stoğumuzda Talep Ettiğiniz Miktarda bulunmamaktadır. Ürün Miktarı = ".$Urun->Miktar." Bulunmaktadır");
                            $this->session->set_flashdata("Kod", "1");
                            redirect($this->agent->referrer());
                        }
                    }
            } else {
                $this->session->set_flashdata("Message", "Ödeme Sırasında Sorun Oluştu " .
                    "Lütfen Yetkilelere Bildiriniz !!!");
                $this->session->set_flashdata("Kod", "3");
                redirect($this->agent->referrer());
            }
        }
    }
    public function Siparisler(){
        if ($this->session->userdata('CustomerID')){
            $CustomerID = $this->session->userdata('CustomerID');
            $data["Menuler"] = $this->Front_Model->GetKategoriler(0);
            if ($this->session->userdata('CustomerID'))
                $data["SC"] = $this->Front_Model->SepetCount($CustomerID);
            else
                $data["SC"] = 0;
            $data["Siparisler"] = $this->Front_Model->GetSiparisList($CustomerID);


            $this->load->view('Customer\Siparis', $data);
        } else{
            $this->session->set_flashdata("Message", "Siparişlerinizi Görüntüleyebilmek için Giriş Yapmalısınız!!!");
            $this->session->set_flashdata("Kod", "1");
            redirect($this->agent->referrer());
        }
    }
    public function SiparisDetay($Id){
        if ($this->session->userdata('CustomerID')){
            $CustomerID = $this->session->userdata('CustomerID');
            $data["Menuler"] = $this->Front_Model->GetKategoriler(0);
            if ($this->session->userdata('CustomerID'))
                $data["SC"] = $this->Front_Model->SepetCount($CustomerID);
            else
                $data["SC"] = 0;
            $Siparis = $this->Front_Model->GetSiparisDetay($Id);
            $data["Siparis"] = $Siparis;
            $data["Urunler"] = $this->Front_Model->GetSiparisUrunList($Siparis->SiparisID);
            $this->load->view('Customer\SiparisDetay', $data);
        } else{
            $this->session->set_flashdata("Message", "Siparişlerinizi Görüntüleyebilmek için Giriş Yapmalısınız!!!");
            $this->session->set_flashdata("Kod", "1");
            redirect($this->agent->referrer());
        }
    }
    public function SignUp (){
        $Captcha = $this->Front_Model->GetCaptcha();
        $data["Menuler"] = $this->Front_Model->GetKategoriler(0);
        if ($this->session->userdata('CustomerID')) {
            $CustomerID = $this->session->userdata('CustomerID');
            $data["SC"] = $this->Front_Model->SepetCount($CustomerID);
        }
        else
            $data["SC"] = 0;
        $data["Captcha"] = $Captcha["image"];
        $this->load->view('Home\SignUp', $data);
    }
    public function CustomerKaydet(){
        $CaptchaKodu = $this->session->userdata('Captcha');
        $GuvenlikKodu = $this->security->xss_clean($this->input->post("GuvenlikKodu"));

        $Sifre = $this->security->xss_clean($this->input->post("Sifre"));
        $SifreYeniden =  $this->security->xss_clean($this->input->post("SifreYeniden"));
        if ($CaptchaKodu == $GuvenlikKodu) {
            if ($Sifre == $SifreYeniden) {
                $Customer = array(
                    'AdSoyad' => $this->security->xss_clean($this->input->post("AdSoyad")),
                    'Email' => $this->security->xss_clean($this->input->post("Email")),
                    'Sifre' => $this->security->xss_clean($this->input->post("Sifre")),
                    'Telefon' => $this->security->xss_clean($this->input->post("Telefon")),
                    'Adres' => $this->security->xss_clean($this->input->post("Adres")),
                    'Sehir' => $this->security->xss_clean($this->input->post("Sehir")),
                    'DogumTarihi' => $this->security->xss_clean($this->input->post("DogumTarihi")),
                    'Cinsiyet' => $this->security->xss_clean($this->input->post("Cinsiyet")),
                    'Durum' => "1",
                    'Aciklama' => $this->security->xss_clean($this->input->post("Aciklama")),
                );
                $Sonuc = $this->Front_Model->MusteriKayit($Customer);
                if ($Sonuc) {
                    $this->session->set_flashdata("Message", "Hesabınız Başarıyla Oluşturulmuştur !!!");
                    $this->session->set_flashdata("Kod", "0");
                    redirect(base_url());
                } else {
                    $this->session->set_flashdata("Message", "Hesap Oluşturulurken Hata oluştu, Lütfen Yetkililer ile İrtibata Geçiniz");
                    $this->session->set_flashdata("Kod", "3");
                    redirect($this->agent->referrer());
                }
            } else {
                $this->session->set_flashdata("Message", "Girilen Şifreler Birbiriyle Aynı Değil!!!");
                $this->session->set_flashdata("Kod", "3");
                redirect($this->agent->referrer());
            }
        }
        else {
            $this->session->set_flashdata("Message", "Girdiğiniz Güvenlik Kodu Resimdekiyle Aynı Değil!");
            $this->session->set_flashdata("Kod", "3");
            redirect($this->agent->referrer());
        }
    }
    public function Forget(){

       // echo random_string('alnum',20);
        $Captcha = $this->Front_Model->GetCaptcha();
        $data["Menuler"] = $this->Front_Model->GetKategoriler(0);
        if ($this->session->userdata('CustomerID')) {
            $CustomerID = $this->session->userdata('CustomerID');
            $data["SC"] = $this->Front_Model->SepetCount($CustomerID);
        }
        else
            $data["SC"] = 0;
        $data["Captcha"] = $Captcha["image"];
        $this->load->view('Home\Forget', $data);
    }
    public function SifreHatirlat() {
        $CaptchaKodu = $this->session->userdata('Captcha');
        $GuvenlikKodu = $this->security->xss_clean($this->input->post("GuvenlikKodu"));
        if ($CaptchaKodu == $GuvenlikKodu) {
            $Email = $this->security->xss_clean($this->input->post("Email"));
            $Customer = $this->Front_Model->SifreHatirlat($Email);
            if ($Customer) {
                $Ayar = $this->Front_Model->GetAyarDetay();
                $config = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => $Ayar->SmtpServer,
                    'smtp_port' => $Ayar->SmtpPort,
                    'smtp_user' => $Ayar->SmtpEmail,
                    'smtp_pass' => $Ayar->SmtpSifre
                );
                print_r($Customer);
                $Key = random_string('alnum',20);
                $Sonuc = $this->Front_Model->SifreKontrol($Key,$Customer->ID);
                if ($Sonuc) {
                    $this->load->library('email', $config);
                    $this->email->set_newline("\r\n");
                    $this->email->from($Ayar->SmtpEmail, $Ayar->Adi);
                    $this->email->to($Customer->Email);
                    $this->email->subject("Şifre Hatırlatma Maili, Talebiniz Üzerine Gönderilmiştir");
                    $this->email->message(" Adı Soyadı : " . $Customer->AdSoyad . " \r\n" . " E Mail Adresi : " . $Customer->Email . " \r\n" .
                        " Kurtarma Linki : " . " \r\n" . base_url()."Home/RePassword/".$Key);
                    if (!$this->email->send()) {
                        $this->session->set_flashdata("Message", $this->email->print_debugger());
                        $this->session->set_flashdata("Kod", "3");
                        redirect($this->agent->referrer());
                    } else {
                        $this->session->set_flashdata("Message", "Şifreniz Hesabınızla ilişkili Mail Adresine Gönderilmiştir.");
                        $this->session->set_flashdata("Kod", "0");
                        redirect($this->agent->referrer());
                    }
                } else {
                    $this->session->set_flashdata("Message", "Hesabınızla İlgili Şifre Kontrolü Yapılamadı, ".
                        " Lütfen Yetkililer ile Görüşünüz!!!");
                    $this->session->set_flashdata("Kod", "1");
                    redirect($this->agent->referrer());
                }
            } else {
                $this->session->set_flashdata("Message", "Girilen Mail Adresiyle İlişkili Bir Hesap Bulunamadı!!!");
                $this->session->set_flashdata("Kod", "1");
                redirect($this->agent->referrer());
            }
        }
        else {
            $this->session->set_flashdata("Message", "Girdiğiniz Güvenlik Kodu Resimdekiyle Aynı Değil!");
            $this->session->set_flashdata("Kod", "3");
            redirect($this->agent->referrer());
        }
    }
    public function RePassword($Key) {
        $data["Menuler"] = $this->Front_Model->GetKategoriler(0);
        if ($this->session->userdata('CustomerID')) {
            $CustomerID = $this->session->userdata('CustomerID');
            $data["SC"] = $this->Front_Model->SepetCount($CustomerID);
        }
        else
            $data["SC"] = 0;
        $data["Key"] = $Key;
        $this->load->view('Home\ResetPassword', $data);
    }
    public function PasswordOnay() {
        $Sifre = $this->security->xss_clean($this->input->post("Sifre"));
        $SifreYeniden =  $this->security->xss_clean($this->input->post("SifreYeniden"));
        $Key =  $this->security->xss_clean($this->input->post("Key"));
        if ($Sifre == $SifreYeniden) {
            $Customer = $this->Front_Model->KeyMusteriDetay($Key);
            if ($Customer) {
                $Customer->Sifre = $Sifre;
                $Customer->SifreKontrol = "";
                $Sonuc = $this->Front_Model->YeniSifreOnay($Customer);
                if ($Sonuc){
                    $this->session->set_flashdata("Message", "Yeni Şifreniz Başarıyla Oluşturuldu, Giriş Yapabilirsiniz.");
                    $this->session->set_flashdata("Kod", "0");
                    redirect(base_url());
                } else {
                    $this->session->set_flashdata("Message", "Yeni Şifreniz Oluşturulamadı, Lütfen Yetkililer ile İrtibata Geçiniz");
                    $this->session->set_flashdata("Kod", "3");
                    redirect(base_url());
                }
            } else {
                $this->session->set_flashdata("Message", "Hesap Bulunamadı, Lütfen Yetkililer ile İrtibata Geçiniz");
                $this->session->set_flashdata("Kod", "3");
                redirect(base_url());
            }
        } else {
            $this->session->set_flashdata("Message", "Girilen Şifreler Birbiriyle Aynı Değil!!!");
            $this->session->set_flashdata("Kod", "3");
            redirect($this->agent->referrer());
        }
    }
    public function Profile(){
        if ($this->session->userdata('CustomerID')) {
            $data["Menuler"] = $this->Front_Model->GetKategoriler(0);
            if ($this->session->userdata('CustomerID')) {
                $CustomerID = $this->session->userdata('CustomerID');
                $data["SC"] = $this->Front_Model->SepetCount($CustomerID);
                $data["Customer"] = $this->Front_Model->GetMusteriDetay($CustomerID);
            }
            else
                $data["SC"] = 0;
            $this->load->view('Customer\MyProfile', $data);
        }
    }
    public function CustomerGuncelle(){
        if ($this->session->userdata('CustomerID')) {
            $Id = $this->security->xss_clean($this->input->post("ID"));
            $Customer = array(
                'AdSoyad' => $this->security->xss_clean($this->input->post("AdSoyad")),
                'Email' => $this->security->xss_clean($this->input->post("Email")),
                'Sifre' => $this->security->xss_clean($this->input->post("Sifre")),
                'Telefon' => $this->security->xss_clean($this->input->post("Telefon")),
                'Adres' => $this->security->xss_clean($this->input->post("Adres")),
                'Sehir' => $this->security->xss_clean($this->input->post("Sehir")),
                'DogumTarihi' => $this->security->xss_clean($this->input->post("DogumTarihi")),
                'Cinsiyet' => $this->security->xss_clean($this->input->post("Cinsiyet")),
                'Durum' => "1",
                'Aciklama' => $this->security->xss_clean($this->input->post("Aciklama")),
            );
            $Sonuc = $this->Front_Model->MusteriGuncelle($Customer,$Id);
            if ($Sonuc) {
                $this->session->set_flashdata("Message", "Hesabınız Başarıyla Güncellenmiştir !!!");
                $this->session->set_flashdata("Kod", "0");
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata("Message", "Hesabınız Güncellenirken Hata oluştu, Lütfen Yetkililer ile İrtibata Geçiniz");
                $this->session->set_flashdata("Kod", "3");
                redirect($this->agent->referrer());
            }
        }
    }
    public function ProfilResimYukle($Id){
        $new_name = $Id."_".date("ymd")."_".time();
        $config['upload_path'] = './Uploads/Profil_Resim/';
        $config['allowed_types'] = 'gif|jpg|png|bmp';
        $config['file_name'] = $new_name;
        $config['max_size'] = '500';
        $config['max_width']  = '300';
        $config['max_height']  = '300';
        $this->load->library('upload', $config);
        if(!is_dir($config['upload_path'])){
            mkdir($config['upload_path'], 0755, TRUE);
        }
        if (!$this->upload->do_upload("Resim")){ //Upload file
            $error=$this->upload->display_errors();
            $this->session->set_flashdata("Message", "Yükleme Hatası : ".$error);
            $this->session->set_flashdata("Kod", "3");
            redirect($this->agent->referrer());
        }
        else
        {
            $upload_data = $this->upload->data();
            $Resim = $upload_data["file_name"];

            $Sonuc = $this->Front_Model->ProfilResimGuncelle($Resim,$Id);
            if ($Sonuc==1){
                $this->session->set_flashdata("Message", "Profil Resim Yükleme İşlemi Başarıyla Yapıldı !");
                $this->session->set_flashdata("Kod", "0");
                redirect($this->agent->referrer());
            }
            else{
                $this->session->set_flashdata("Message", "Profil Resim Yükleme ama Veritabanına Kayıt Yapılamadı !!!");
                $this->session->set_flashdata("Kod", "1");
                redirect($this->agent->referrer());
            }
        }
    }
    public function YorumYap($Id){
        if ($this->session->userdata('CustomerID')) {
            $Yorum = array(
                'UrunID' => $Id,
                'CustomerID' => $this->session->userdata('CustomerID'),
                'Baslik' => $this->security->xss_clean($this->input->post("Baslik")),
                'Yorum' => $this->security->xss_clean($this->input->post("Yorum")),
                'Puan' => $this->security->xss_clean($this->input->post("Puan")),
                'Durum' => "0",
                'Tarih' => date('Y-m-d H:i:s'),
            );
            $Sonuc = $this->Front_Model->SetInsertYorum($Yorum);
            if ($Sonuc) {
                $this->session->set_flashdata("Message", "Yorumunuz Başarıyla İletilmiştir, Yetkili Onayından Sonra Yayınlanacaktır!!!");
                $this->session->set_flashdata("Kod", "0");
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata("Message", "Yorumunuz İletilemedi, Yetkilelere Bildiriniz!!!");
                $this->session->set_flashdata("Kod", "3");
                redirect($this->agent->referrer());
            }
        }else{
            $this->session->set_flashdata("Message", "Yorum Yapabilmek için Hesabınıza Giriş Yapmalısınız!!!");
            $this->session->set_flashdata("Kod", "1");
            redirect($this->agent->referrer());
        }
    }

}
