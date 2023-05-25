<?php
    class PedidosModel extends Query{
     
        public function __construct()
        {
            parent::__construct();
        }

        public function getPedidos($proceso)
        {
            $sql="SELECT * FROM pedidos WHERE proceso = $proceso";
            return $this->selectAll($sql);
        }

        
    }
     