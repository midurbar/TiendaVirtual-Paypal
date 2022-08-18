<?php
    class PrincipalModel extends Query{
     
        public function __construct()
        {
            parent::__construct();
        }

        public function getProducto($id_producto)
        {
            $sql="SELECT * FROM productos WHERE id=$id_producto";
            return $this->select($sql);
        }
    }
     
?>