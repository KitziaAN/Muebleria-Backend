<?php

require APPPATH . 'libraries/REST_Controller.php';

class Usuarios extends REST_Controller{

    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

    public function index_get($codigo=0){
        // En caso de recuperar un categoria especifica
        if (!empty($id)) {
            $data = $this->db->get_where("usuarios", ['codigo_usuario'=>$codigo])->row_array();
        }
        // recuperar todas las categorias
        else{
            $data = $this->db->get("usuarios")->result();
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function index_post(){
        $input = $this->input->post();
        $this->db->insert("usuarios", $input);
        $this->response(['Usuario agregada'], REST_Controller::HTTP_OK);
    }

    public function index_put($codigo){
        $input = $this->put();
        $this->db->update("usuarios", $input, array("codigo_usuario" => $codigo));
        $this->response(['Usuario actualizada'], REST_Controller::HTTP_OK);
    }

    public function index_delete($codigo){
        $this->db->delete("usuarios", array("codigo_usuario" => $codigo));
        $this->response(['Usuario eliminada'], REST_Controller::HTTP_OK);
    }

}