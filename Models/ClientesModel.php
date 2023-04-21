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

        public function getToken($token)
        {
            $sql="SELECT * FROM clientes WHERE token = '$token'";
            return $this->select($sql);
        }

        public function actualizarVerify($id)
        {
            $sql = "UPDATE clientes SET token=?, verify=? WHERE id=?";
            $datos = array(null, 1, $id);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $res = $data;
            } else {
                $res = 0;
            }
            return $res;
        }

        public function getVerificar($correo)
        {
            $sql="SELECT * FROM clientes WHERE correo = '$correo'";
            return $this->select($sql);
        }

        public function registrarPedido($id_transaccion, $monto, $estado, $fecha, $email, $nombre, $apellido, $direccion, $ciudad, $email_user)
        {
            $sql = "INSERT INTO pedidos (id_transaccion, monto, estado, fecha, email, nombre, apellido, direccion, ciudad, email_user) VALUES (?,?,?,?,?,?,?,?,?,?)";
            $datos = array($id_transaccion, $monto, $estado, $fecha, $email, $nombre, $apellido, $direccion, $ciudad, $email_user);
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