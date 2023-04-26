<?php
    class Principal extends Controller
    {
        public function __construct() {
            parent::__construct();
            session_start();
        }
        //Vista about
        public function about()
        {
            $data['perfil'] = 'no';
            $data['title'] = 'Nuestro equipo';
            $this->views->getView('principal', "about", $data);
        }
        //Vista shop
        public function shop($page)
        {
            $data['perfil'] = 'no';
            $pagina = (empty($page)) ? 1: $page;
            $porPagina = 20;
            $desde = ($pagina -1) * $porPagina;
            $data['title'] = 'Nuestros productos';
            $data['productos'] = $this->model->getProductos($desde, $porPagina);
            $data['pagina'] = $pagina;
            $total = $this->model->getTotalProductos();
            $data['total'] = ceil($total['total'] / $porPagina);
            $this->views->getView('principal', "shop", $data);
        }
        //Vista detail
        public function detail($id_producto)
        {
            $data['perfil'] = 'no';
            $data['producto'] = $this->model->getProducto($id_producto);
            $id_categoria = $data['producto']['id_categoria'];
            $data['relacionados'] = $this->model->getAleatorios($id_categoria, $data['producto']['id']);
            $data['title'] = $data['producto']['nombre'];
            $this->views->getView('principal', "detail", $data);
        }
        //Vista categorias
        public function categorias($datos)
        {
            $data['perfil'] = 'no';
            $id_categoria = 1;
            $page = 1;
            $array = explode(',', $datos);
            if (isset($array[0])) {
                if (!empty($array[0])) {
                    $id_categoria = $array[0];
                }
            }
            if (isset($array[1])) {
                if (!empty($array[1])) {
                    $page = $array[1];
                }
            }
            $pagina = (empty($page)) ? 1: $page;
            $porPagina = 16;
            $desde = ($pagina -1) * $porPagina;

            $data['pagina'] = $pagina;
            $total = $this->model->getTotalProductosCat($id_categoria);
            $data['total'] = ceil($total['total'] / $porPagina);

            $data['productos'] = $this->model->getProductosCat($id_categoria, $desde, $porPagina);
            $data['title'] = 'Categorias';
            $data['id_categoria'] = $id_categoria;
            $this->views->getView('principal', "categorias", $data);
        }
        //Vista contact
        public function contact()
        {
            $data['perfil'] = 'no';
            $data['title'] = 'Contactos';
            $this->views->getView('principal', "contact", $data);
        }
        //Vista lista deseos
        public function deseo()
        {
            $data['perfil'] = 'no';
            $data['title'] = 'Tu lista de deseos';
            $this->views->getView('principal', "deseo", $data);
        }

        //Obtener productos a partir de la lista del carrito
        public function ListaProductos() {
            $datos = file_get_contents('php://input');
            $json= json_decode($datos, true);
            $array['productos'] = array();
            $total = 0.00;
            if (!empty($json)) {
                foreach ($json as $producto) {
                    $result = $this->model->getProducto($producto['idProducto']);
                    $data['id'] = $result['id'];
                    $data['nombre'] = $result['nombre'];
                    $data['precio'] = $result['precio'];
                    $data['cantidad'] = $producto['cantidad'];
                    $data['imagen'] = $result['imagen'];
                    $SubTotal = $result['precio'] * $producto['cantidad'];
                    $data['SubTotal'] = number_format($SubTotal, 2);
                    array_push($array['productos'], $data);
                    $total += $SubTotal;
                }
            }
            $array['total'] = number_format($total, 2);
            $array['totalPaypal'] = number_format($total, 2, '.','');
            $array['moneda'] = MONEDA;
            echo json_encode($array, JSON_UNESCAPED_UNICODE);
            die();
        }

    }
?>