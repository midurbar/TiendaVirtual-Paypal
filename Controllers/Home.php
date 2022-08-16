<?php
    class Home extends Controller
    {
        public function __construct() {
            parent::__construct();
            session_start();
        }
        public function index()
        {
            $data['title'] = 'Pagina Principal';
            $this->views->getView('home', "index", $data);
        }
        //Vista about
        public function about()
        {
            $data['title'] = 'Nuestro equipo';
            $this->views->getView('principal', "about", $data);
        }
        //Vista shop
        public function shop()
        {
            $data['title'] = 'Nuestros productos';
            $this->views->getView('principal', "shop", $data);
        }
        //Vista detail
        public function detail($id_producto)
        {
            $data['title'] = '-----------';
            $this->views->getView('principal', "detail", $data);
        }
        //Vista contact
        public function contact()
        {
            $data['title'] = 'Contactos';
            $this->views->getView('principal', "contact", $data);
        }
    }
?>