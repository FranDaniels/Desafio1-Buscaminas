<?php

require_once('constantes.php');

class conexion{

    static $conexion;

    //Comprobación de que la conexión se realiza correctamente
    static function comprobarConexion(){
        $numero=0;
        self::$conexion=new mysqli(constantes::$host,constantes::$user,constantes::$password,constantes::$url);
        if(!self::$conexion){
            $numero=-1;
        }
        return $numero;//En el caso que me de -1 es false si me da 0 es true y la conexion es correcta.
    }


    //Consulta de usuario en concreto
    static function consultarUsuario($idUsuario){
        
        if (self::comprobarConexion()==0) {
            $consulta=self::$conexion->prepare(constantes::$selectUsuarioConcreto);

            $stmt=mysqli_prepare(self::$conexion,$consulta);
            mysqli_stmt_bind_param($stmt,'s',$idUsuario);
            mysqli_stmt_execute($stmt);
            $resultados=mysqli_stmt_get_result($stmt);

            while ($fila=mysqli_fetch_array($resultados)){
                print_r($fila);
            }

            $consulta->close();
            self::$conexion->close();
        }
    }

    //Creación de usuario
    static function crearUsuario(){
        self::comprobarConexion();

        $query=self::$conexion->prepare(constantes::$crearUsuario);
        $stmt=mysqli_prepare(self::$conexion,$query);
        mysqli_stmt_bind_param($stmt,'isssii');
        try {
            echo mysqli_stmt_execute($stmt).'registro insertado.<br>';
        } catch (Exception $e) {
            echo "Fallo al insertar: (" . $e->getMessage() . ") <br>";
        }
        $query->close();
        self::$conexion->close();
    }

    //Modificar usuario
    static function modificarUsuario($idUsuario,$nuevoNombreUsuario){
        self::comprobarConexion();

        $query=self::$conexion->prepare(constantes::$modificarUsuario);
        $stmt=mysqli_prepare(self::$conexion,$query);
        mysqli_stmt_bind_param($stmt,'si',$nuevoNombreUsuario, $idUsuario);

        try {
            echo mysqli_stmt_execute($stmt).'Modificación realizada correctamente.<br>'; 
        } catch (Exception $e) {
            echo "Fallo al modificar el usuario: (" . $e->getMessage() . ") <br>";
        }

        $query->close();
        self::$conexion->close();
    }

    //Borrado de usuario
    static function borrarUsuario($idUsuario){
        self::comprobarConexion();

        $query=self::$conexion->prepare(constantes::$borrarUsuario);
        try {
            mysqli_query(self::$conexion,$query);
            echo "Borrado correctamente <br>";
        } catch (Exception $e) {
            echo "Fallo al borrar: (" . $e->getMessage() . ") <br>";
        }
        $query->close();
        self::$conexion->close();
    }

    //Creación de nueva partida
    static function insertarPartida(){
        self::comprobarConexion();

        $query=self::$conexion->prepare(constantes::$crearPartida); 
        $stmt=mysqli_prepare(self::$conexion,$query);

        mysqli_stmt_bind_param($stmt,'iissb');

        try {
            echo mysqli_stmt_execute($stmt).'registro insertado.<br>';
        } catch (Exception $e) {
            echo "Fallo al insertar: (" . $e->getMessage() . ") <br>";
        }
        $query->close();
        self::$conexion->close();
    }

    //Borrar partida
    static function borrarPartida($idPartida){
        if (self::comprobarConexion()==0) {
            $query=self::$conexion->prepare(constantes::$borrarPartida);    
            try {
                mysqli_query(self::$conexion,$query);
            } catch (Exception $e) {
                echo "Error al borrar: (" . $e->getMessage() . ")";
            }
            $query->close();
            self::$conexion->close();
        }
    }

    //Consultar partida en especifica
    static function consultarPartida($idUsuario){
        
        if (self::comprobarConexion()==0) {
            $consulta=self::$conexion->prepare(constantes::$consultarPartidaConcreta);

            $stmt=mysqli_prepare(self::$conexion,$consulta);
            mysqli_stmt_bind_param($stmt,'s',$idUsuario);
            mysqli_stmt_execute($stmt);
            $resultados=mysqli_stmt_get_result($stmt);

            while ($fila=mysqli_fetch_array($resultados)){
                print_r($fila);
            }

            $consulta->close();
            self::$conexion->close();
        }        
    }
}