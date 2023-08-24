<?php
require_once ("conexion.php");
class ModeloExamen{
    public static function mdlGuardarLibros($tabla, $data)
    {
        $stm = conexion::conectar()->prepare("INSERT INTO $tabla (isbn, titulo, nombre_autor, numero_paginas, precio)
        VALUES(:isbn, :titulo, :nombre_autor, :numero_paginas, :precio)");
        $stm->bindParam(':isbn', $data['isbn'], PDO::PARAM_STR);
        $stm->bindParam(':titulo', $data['titulo'], PDO::PARAM_STR);
        $stm->bindParam(':nombre_autor', $data['nombre_autor'], PDO::PARAM_STR);
        $stm->bindParam(':numero_paginas', $data['numero_paginas'], PDO::PARAM_STR);
        $stm->bindParam(':precio', $data['precio'], PDO::PARAM_STR);
        if($stm->execute())
            return "ok";
        else
            return "error";
    }

    
    public static function mdlCargarLibros($tabla, $parametro, $id){
        if($parametro == null)
        {
            $stm = conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stm->execute();
            $datos = $stm->fetchAll();
            return $datos;
        }else{
            $stm = conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_libros=:id_libros");
            $stm->bindParam(':id_libros', $id, PDO::PARAM_INT);
            $stm->execute();
            $datos = $stm->fetch();
            return $datos;
        }
    }
    public static function mdlActualizarLibros($tabla, $data){
        $stm = conexion::conectar()->prepare("UPDATE $tabla SET cedula=:cedula, nombre=:nombre, apellidos=:apellidos, direccion=:direccion, telefono=:telefono, email=:email WHERE id_cliente=:id_cliente");
        $stm->bindParam(':cedula', $data['cedula'], PDO::PARAM_STR);
        $stm->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
        $stm->bindParam(':apellidos', $data['apellidos'], PDO::PARAM_STR);
        $stm->bindParam(':direccion', $data['direccion'], PDO::PARAM_STR);
        $stm->bindParam(':telefono', $data['telefono'], PDO::PARAM_STR);
        $stm->bindParam(':email', $data['email'], PDO::PARAM_STR);
        $stm->bindParam(':id_cliente', $data['id_cliente'], PDO::PARAM_INT);
        if($stm->execute())
            return "ok";
        else
            return "error";

    }

        
    public static function mdlEliminarCliente($tabla, $id)  {
        $stm = conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_cliente = :id_cliente");
        $stm->bindParam(':id_cliente', $id, PDO::PARAM_INT);
        if($stm->execute())
            return 1;
        else
            return 0;
    }
}
