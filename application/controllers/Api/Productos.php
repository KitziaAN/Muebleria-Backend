<?php

require APPPATH . 'libraries/REST_Controller.php';

class Productos extends REST_Controller{

    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

    public function index_get($codigo=0){
        // En caso de recuperar un producto especifica
        if (!empty($id)) {
            $data = $this->db->get_where("productos", ['codigo_producto'=>$codigo])->row_array();
        }
        // recuperar todas las productos
        else{
            $data = $this->db->get("productos")->result();
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function index_post(){
        $input = $this->input->post();
        $this->db->insert("productos", $input);
        $this->response(['Producto agregado'], REST_Controller::HTTP_OK);
    }

    public function index_put($codigo){
        $input = $this->put();
        $this->db->update("productos", $input, array("codigo_producto" => $codigo));
        $this->response(['Producto actualizado'], REST_Controller::HTTP_OK);
    }

    public function index_delete($codigo){
        $this->db->delete("productos", array("codigo_producto" => $codigo));
        $this->response(['Producto eliminado'], REST_Controller::HTTP_OK);
    }

}