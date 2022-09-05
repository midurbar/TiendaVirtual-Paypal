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
        public function categorias($id_categoria)
        {
            $data['productos'] = $this->model->getProductosCat($id_categoria);
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