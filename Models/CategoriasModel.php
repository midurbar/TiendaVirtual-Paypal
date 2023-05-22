<?php
    class CategoriasModel extends Query{
     
        public function __construct()
        {
            parent::__construct();
        }

        public function getCategorias($estado)
        {
            $sql="SELECT * FROM categorias WHERE estado = $estado";
            return $this->selectAll($sql);
        }

        public function registrar($categoria, $imagen)
        {
            $sql = "INSERT INTO categorias (categoria, imagen) VALUES (?,?)";
            $array = array($categoria, $imagen);
            return $this->insertar($sql, $array);
        }

        public function verificarCategoria($categoria)
        {
            $sql="SELECT categoria FROM categorias WHERE categoria = '$categoria' AND estado = 1";
            return $this->select($sql);
        }

        public function verificarCorreoId($id)
        {
            $sql="SELECT correo FROM usuarios WHERE id = $id";
            return $this->select($sql);
        }

        public function eliminar($idUser)
        {
            $sql="UPDATE usuarios SET estado = ? WHERE id = ?";
            $array = array(0, $idUser);
            return $this->save($sql, $array);
        }

        public function getUsuario($idUser)
        {
            $sql="SELECT id, nombres, apellidos, correo FROM usuarios WHERE id = $idUser";
            return $this->select($sql);
        }

        public function modificar($categoria, $imagen, $id)
        {
            $sql = "UPDATE categorias SET categoria=?, imagen=? WHERE id = ?";
            $array = array($categoria, $imagen, $id);
            return $this->save($sql, $array);
        }
    }
     
?>