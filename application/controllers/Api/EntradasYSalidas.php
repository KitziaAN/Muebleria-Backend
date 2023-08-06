<?php

require APPPATH . 'libraries/REST_Controller.php';

class EntradasYSalidas extends REST_Controller{

    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

    public function index_get($codigo=''){
        // En caso de recuperar un entrada_salida especifica
        if (!empty($codigo)) {
            $data = $this->db->get_where("salidas_entradas", ['fecha'=>$codigo])->result();
        }
        // recuperar todas las entrada_salida
        else{
            $data = $this->db->get("salidas_entradas")->result();
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function index_post(){
        $input = $this->input->post();
        $this->db->insert("salidas_entradas", $input);
        $this->response(['Entrada/Salida agregada'], REST_Controller::HTTP_OK);
    }

    public function index_put($codigo){
        $input = $this->put();
        $this->db->update("salidas_entradas", $input, array("codigo_eys" => $codigo));
        $this->response(['Entrada/Salida actualizada'], REST_Controller::HTTP_OK);
    }

    public function index_delete($codigo){
        $this->db->delete("salidas_entradas", array("codigo_eys" => $codigo));
        $this->response(['Entrada/salida eliminada'], REST_Controller::HTTP_OK);
    }

}