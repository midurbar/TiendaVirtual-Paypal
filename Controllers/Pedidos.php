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
        public function listarPedidos()
        {
            $data = $this->model->getPedidos(1);
            for ($i=0; $i < count($data); $i++) { 
                $data[$i]['accion'] = '<div class="d-flex">
                                        <button class="btn btn-info" type="button" onclick="cambiarProceso('.$data[$i]['id'].')"><i class="fas fa-check-circle"></i></button>
                                    </div>';
            }
            echo json_encode($data);
            die();
        }

        public function listarFinalizados()
        {
            $data = $this->model->getPedidos(3);
            for ($i=0; $i < count($data); $i++) { 
                $data[$i]['accion'] = '<div class="d-flex">
                                        <button class="btn btn-danger" type="button" onclick="eliminarProd('.$data[$i]['id'].')"><i class="fas fa-trash"></i></button>
                                    </div>';
            }
            echo json_encode($data);
            die();
        }

        public function update($idPedido)
        {
            if (is_numeric($idPedido)) {
                $data = $this->model->actualizarEstado(2, $idPedido);
                if ($data == 1) {
                    $respuesta = array('msg' => 'pedido actualizado', 'icono' => 'success');
                } else {
                    $respuesta = array('msg' => 'error al actualizar', 'icono' => 'error');
                }
                echo json_encode($respuesta);
            }
            die();
        }
    }
?>