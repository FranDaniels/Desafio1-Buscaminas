<?php

require_once('constantes.php');

class conexion{

    static $conexion;

    static function comprobarConexion(){
        $numero=0;
        self::$conexion=new mysqli(constantes::$host,constantes::$user,constantes::$password,constantes::$url);
        if(!self::$conexion){
            $numero=-1;
        }
        return $numero;//En el caso que me de -1 es false si me da 0 es true y la conexion es correcta.
    }

    static function consultarUsuario($idUsuario){
        
        if (self::comprobarConexion()==0) {
            $consulta=self::$conexion->prepare("SELECT * FROM persona WHERE idUsuario = ?");

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

    static function crearUsuario(){
        self::comprobarConexion();

        $query=self::$conexion->prepare("INSERT INTO persona (idUsuario,nombre,contrasenia,correo,partidasJugadas,partidasGanadas) VALUES (?,?,?,?,?,?)");
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

    static function borrarUsuario($idUsuario){
        self::comprobarConexion();

        $query=self::$conexion->prepare("DELETE FROM persona WHERE $idUsuario = '?'");
        try {
            mysqli_query(self::$conexion,$query);
            echo "Borrado correctamente <br>";
        } catch (Exception $e) {
            echo "Fallo al borrar: (" . $e->getMessage() . ") <br>";
        }
        $query->close();
        self::$conexion->close();
    }

    static function insertarPartida(){
        self::comprobarConexion();

        $query=self::$conexion->prepare("INSERT INTO partida (idPartida,idUsuario,tableroOculto,tableroMostrado,finalizado) VALUES (?,?,?,?,?)"); 
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

    static function borrarPartida($idPartida){
        if (self::comprobarConexion()==0) {
            $query=self::$conexion->prepare("DELETE FROM partida WHERE idPartida = '$idPartida'");    
            try {
                mysqli_query(self::$conexion,$query);
            } catch (Exception $e) {
                echo "Error al borrar: (" . $e->getMessage() . ")";
            }
            $query->close();
            self::$conexion->close();
        }
    }

    static function consultarPartidas($idUsuario){
        
        if (self::comprobarConexion()==0) {
            $consulta=self::$conexion->prepare("SELECT * FROM persona WHERE idUsuario = ?");

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