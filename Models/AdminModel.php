<?php
    class AdminModel extends Query{
     
        public function __construct()
        {
            parent::__construct();
        }

        public function getUsuario($correo)
        {
            $sql="SELECT * FROM usuarios WHERE correo = $correo";
            return $this->select($sql);
        }

        public function getTotales( $proceso)
        {
            $sql="SELECT COUNT(*) AS total FROM pedidos WHERE proceso = $proceso";
            return $this->select($sql);
        }

        public function getProductos()
        {
            $sql="SELECT COUNT(*) AS total FROM productos WHERE estado = 1";
            return $this->select($sql);
        }
    }
     
?>