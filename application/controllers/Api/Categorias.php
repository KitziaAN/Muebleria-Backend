<?php

require APPPATH . 'libraries/REST_Controller.php';

class Categorias extends REST_Controller{

    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

    public function index_get($codigo=0){
        // En caso de recuperar un categoria especifica
        if (!empty($id)) {
            $data = $this->db->get_where("categorias", ['codigo_categoria'=>$codigo])->row_array();
        }
        // recuperar todas las categorias
        else{
            $data = $this->db->get("categorias")->result();
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function index_post(){
        $input = $this->input->post();
        $this->db->insert("categorias", $input);
        $this->response(['Categoria agregada'], REST_Controller::HTTP_OK);
    }

    public function index_put($codigo){
        $input = $this->put();
        $this->db->update("categorias", $input, array("codigo_categoria" => $codigo));
        $this->response(['Categoria actualizada'], REST_Controller::HTTP_OK);
    }

    public function index_delete($codigo){
        $this->db->delete("categorias", array("codigo_categoria" => $codigo));
        $this->response(['Categoria eliminada'], REST_Controller::HTTP_OK);
    }

}