<?php
    class Pedidos extends Controller
    {
        public function __construct() {
            parent::__construct();
            session_start();
        }
        public function index()
        {
            $data['title'] = 'pedidos';
            $this->views->getView('admin/pedidos', "index", $data);
        }
        public function listar()
        {
            $data = $this->model->getPedidos(1);
            for ($i=0; $i < count($data); $i++) { 
                $data[$i]['accion'] = '<div class="d-flex">
                                        <button class="btn btn-danger" type="button" onclick="eliminarProd('.$data[$i]['id'].')"><i class="fas fa-trash"></i></button>
                                    </div>';
            }
            echo json_encode($data);
            die();
        }
        
    }
?>