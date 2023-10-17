<?php

require_once('Auxiliar/constantes.php');

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

    //Consultar varios usuarios
    public static function getJugadores(){
        $persona=null;
        if (self::comprobarConexion()==0) {
            $consulta=self::$conexion->prepare(constantes::$selectTodosUsuarios);

            try {
                $stmt=self::$conexion->prepare($consulta);
                $stmt->execute();
                $resultados=$stmt->get_result();
                $personas=[];

                while ($fila=$resultados->fetch_array()){
                    $persona = new Persona($fila[0], $fila[1], $fila[2], $fila[3], $fila[4], $fila[5], $fila[6]);
                    array_push($personas,$persona);
                }
            } catch (Exception $e) {
                echo "Fallo al mostrar: (" . $e->getMessage() . ") <br>";
            }
            
            $resultados->free_result();
            $consulta->close();
            self::$conexion->close();
        }
        return $persona;
    }

    //Consulta de usuario en concreto
    static function consultarUsuario($correo){
        $persona=null;
        if (self::comprobarConexion()==0) {
            $consulta=self::$conexion->prepare(constantes::$selectUsuarioConcreto);

            try {
                $consulta->bind_param('s',$correo);
                $consulta->execute();
                $resultados=$consulta->get_result();

                while ($fila=$resultados->fetch_array()){
                    $persona = new Persona($fila[0], $fila[1], $fila[2], $fila[3], $fila[4], $fila[5], $fila[6]);
                }
            } catch (Exception $e) {
                echo "Fallo al mostrar: (" . $e->getMessage() . ") <br>";
            }
            
            $resultados->free_result();
            $consulta->close();
            self::$conexion->close();
        }
        return $persona;
    }

    //Creación de usuario
    static function crearUsuario($idUsu,$nombre,$contrasenia,$correo,$partidasJugadas,$partidasGanadas,$admin){ 
        self::comprobarConexion();

        $query=self::$conexion->prepare(constantes::$crearUsuario);
        $query->bind_param('isssiii', $idUsu, $nombre, $contrasenia, $correo, $partidasJugadas, $partidasGanadas, $admin);

        try {
            $query->execute();
        } catch (Exception $e) {
            echo "Fallo al insertar: (" . $e->getMessage() . ") <br>";
        }
        $query->close();
        self::$conexion->close();
    }

    //Modificar usuario
    static function modificarUsuario($correo,$nuevoCorreo){
        self::comprobarConexion();

        $query=self::$conexion->prepare(constantes::$modificarUsuario);
        $stmt=self::$conexion->prepare($query);
        $stmt->bind_param('si',$nuevoCorreo, $correo);

        try {
            $stmt->execute().'Modificación realizada correctamente.<br>'; 
        } catch (Exception $e) {
            echo "Fallo al modificar el usuario: (" . $e->getMessage() . ") <br>";
        }

        $query->close();
        self::$conexion->close();
    }

    //Borrado de usuario
    static function borrarUsuario($correo){
        self::comprobarConexion();

        $query=self::$conexion->prepare(constantes::$borrarUsuario);
        $stmt=self::$conexion->prepare($query);
        $stmt->bind_param('i', $correo);
        try {
            $stmt->execute();
            echo "Borrado correctamente <br>";
        } catch (Exception $e) {
            echo "Fallo al borrar: (" . $e->getMessage() . ") <br>";
        }
        $query->close();
        self::$conexion->close();
    }

    //Creación de nueva partida
    static function insertarPartida($partida){
        self::comprobarConexion();

        $query=self::$conexion->prepare(constantes::$crearPartida); 
        $stmt=self::$conexion->prepare($query);

        $stmt->bind_param('iissi',$partida);

        try {
            echo $stmt->execute().'registro insertado.<br>';
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
            $stmt=self::$conexion->prepare($query);
            $stmt->bind_param('i', $idPartida);
            try {
                $stmt->execute();
            } catch (Exception $e) {
                echo "Error al borrar: (" . $e->getMessage() . ")";
            }
            $query->close();
            self::$conexion->close();
        }
    }

    //Consultar partida en específica
    static function consultarPartida($idPartida){
        
        if (self::comprobarConexion()==0) {
            $consulta=self::$conexion->prepare(constantes::$consultarPartidaConcreta);

            $stmt=self::$conexion->prepare($consulta);
            $stmt->bind_param('s',$idPartida);
            $stmt->execute();
            $resultados=$stmt->get_result();

            while ($fila=$resultados->fetch_array()){
                print_r($fila);
            }

            $consulta->close();
            self::$conexion->close();
        }        
    }

    //Cambiar contraseña de usuario
    static function modificarContraseña($correo,$contrasenia){
        self::comprobarConexion();

        $query=self::$conexion->prepare(constantes::$modificarContrasenia);
        $stmt=self::$conexion->prepare($query);
        $stmt->bind_param('ss',$correo,$contrasenia);

        try {
            echo $stmt->execute().'Modificación realizada correctamente.<br>'; 
        } catch (Exception $e) {
            echo "Fallo al modificar el usuario: (" . $e->getMessage() . ") <br>";
        }

        $query->close();
        self::$conexion->close();
    }
}