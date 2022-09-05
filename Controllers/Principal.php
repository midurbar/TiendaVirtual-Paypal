<?php
    class Principal extends Controller
    {
        public function __construct() {
            parent::__construct();
            session_start();
        }
        public function index()
        {
           
        }
        //Vista about
        public function about()
        {
            $data['title'] = 'Nuestro equipo';
            $this->views->getView('principal', "about", $data);
        }
        //Vista shop
        public function shop($page)
        {
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
            $data['producto'] = $this->model->getProducto($id_producto);
            $data['title'] = $data['producto']['nombre'];
            $this->views->getView('principal', "detail", $data);
        }
        //Vista categorias
        public function categorias($datos)
        {
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
            $porPagina = 15;
            $desde = ($pagina -1) * $porPagina;

            $data['pagina'] = $pagina;
            $total = $this->model->getTotalProductosCat($id_categoria);
            $data['total'] = ceil($total['total'] / $porPagina);

            $data['productos'] = $this->model->getProductosCat($id_categoria, $desde, $porPagina);
            $data['title'] = 'Categorias';
            $this->views->getView('principal', "categorias", $data);
        }
        //Vista contact
        public function contact()
        {
            $data['title'] = 'Contactos';
            $this->views->getView('principal', "contact", $data);
        }
        
    }
?>