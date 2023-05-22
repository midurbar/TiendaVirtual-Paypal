<?php
    class Categorias extends Controller
    {
        public function __construct() {
            parent::__construct();
            session_start();
        }
        public function index()
        {
            $data['title'] = 'usuarios';
            $this->views->getView('admin/categorias', "index", $data);
        }
        public function listar()
        {
            $data = $this->model->getCategorias(1);
            for ($i=0; $i < count($data); $i++) { 
                $data[$i]['accion'] = '<div class="d-flex">
                                        <button class="btn btn-primary" type="button" onclick="editCat('.$data[$i]['id'].')"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger" type="button" onclick="eliminarCat('.$data[$i]['id'].')"><i class="fas fa-trash"></i></button>
                                    </div>';
            }
            echo json_encode($data);
            die();
        }
        public function registrar()
        {
            if (isset($_POST['categoria'])) {
                $categoria = $_POST['categoria'];
                $imagen=$_FILES['imagen'];
                $tmp_name = $imagen['tmp_name'];
                $id = $_POST['id'];
                $ruta = 'assets/img/categorias/';
                $nombreImg = date('YmdHis');
                if (empty($_POST['categoria'])) {
                    $respuesta = array('msg' => 'todos los campos son requeridos', 'icono' => 'warning');
                } else {
                    if (!empty($imagen['name'])) {
                        $destino = $ruta . $nombreImg . '.jpg';
                    } else if (empty($_POST['imagen_actual']) && empty($imagen['name'])) {
                        $destino = $_POST['imagen_actual'];
                    } else {
                        $destino = $ruta . 'default.png';
                    }
                    
                    if (empty($id)) {
                        $result = $this->model->verificarCategoria($categoria);
                        if (empty($result)) {
                            $data = $this->model->registrar($categoria, $destino);
                            if ($data > 0) {
                                if (!empty($imagen['name'])) {
                                    move_uploaded_file($tmp_name, $destino);
                                }
                                $respuesta = array('msg' => 'categoria registrada', 'icono' => 'success');
                            } else {
                                $respuesta = array('msg' => 'error al registrar', 'icono' => 'error');
                            }
                        } else {
                            $respuesta = array('msg' => 'la categoria ya existe', 'icono' => 'warning');
                        }
                    } else {
                        $data = $this->model->modificar($categoria, $destino, $id);
                        if ($data == 1) {
                            if (!empty($imagen['name'])) {
                                move_uploaded_file($tmp_name, $destino);
                            }
                            $respuesta = array('msg' => 'categoria modificada', 'icono' => 'success');
                        } else {
                            $respuesta = array('msg' => 'error al modificar', 'icono' => 'error');
                        }
                    }
                }
                echo json_encode($respuesta);
            }
            
            die();
        }
        //Eliminar Usuario
        public function delete($idUser)
        {
            if (is_numeric($idUser)) {
                $data = $this->model->eliminar($idUser);
                if ($data == 1) {
                    $respuesta = array('msg' => 'usuario dado de baja', 'icono' => 'success');
                } else {
                    $respuesta = array('msg' => 'error al eliminar', 'icono' => 'error');
                }
            } else {
                $respuesta = array('msg' => 'error desconocido', 'icono' => 'error');
            }
            echo json_encode($respuesta);
            die();
        }
        //Editar Usuario
        public function edit($idUser)
        {
            if (is_numeric($idUser)) {
                
                $data = $this->model->getUsuario($idUser);
                echo json_encode($data, JSON_UNESCAPED_UNICODE);
            };

            die();
        }
    }
?>