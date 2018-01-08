<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Category extends  CI_Controller{
    function  __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in'))
            redirect(base_url()."Admin\Login");
    }
    public function index()
    {
  //      $viewData = new stdClass();
  ///      $viewData->categories = $this->db->get("Kategori")->result();
       $this->load->view('Admin\category');
    }

    /* Kategori Listeleme İşlemleri */
    Public function CategoryList()
    {
        $result= $this->db->get("Categorys")->result();
        echo json_encode($result);
    }
    public function  GetCategoryDetail(){
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $city = $request->Id;
        $result= $this->db->where(array("Id"=>$city))->get("Categorys")->result();
         echo json_encode($result);
    }
    Public function ShowcasesList()
    {
        $result= $this->db->get("Showcases")->result();
        echo json_encode($result);
    }
    public function  Deneme(){

        $this->load->model('Category_Model');
        $deneme = $this->input->post("deneme");
        $ShowCases = $this->Category_Model->ShowcasesList1();
//        print_r($deneme);die();
        //echo $deneme;
        echo $deneme;//json_encode($ShowCases);
    }


}

?>