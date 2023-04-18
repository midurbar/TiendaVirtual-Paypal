<?php
    class ClientesModel extends Query{
     
        public function __construct()
        {
            parent::__construct();
        }

        public function registroDirecto($nombre, $correo, $cont, $token)
        {
            $sql = "INSERT INTO clientes (nombre, correo, clave, token) VALUES (?,?,?,?)";
            $datos = array($nombre, $correo, $cont, $token);
            $data = $this->insertar($sql, $datos);
            if ($data>0) {
                $res = $data;
            } else {
                $res = 0;
            }
            return $res;
        }
    }
     
?>