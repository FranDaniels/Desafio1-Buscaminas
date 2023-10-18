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
                
                $consulta->execute();
                $resultados=$consulta->get_result();
                $personas=[];

                while ($fila=$resultados->fetch_array()){
                    $persona = new Persona($fila[0], $fila[1], $fila[2], $fila[3], $fila[4], $fila[5], $fila[6]);
                    echo json_encode(['Id: ' => $persona->id, 
                    'Nombre: ' => $persona->nombre,
                    'Contrasenia: '=>$persona->contrasenia,
                    'Correo: '=>$persona->correo,
                    'Partidas Jugadas: '=>$persona->partidasJugadas,
                    'Partidas Ganadas: '=>$persona->partidasGanadas,
                    'Administrador:' =>$persona->administrador]);
                    array_push($personas,$persona);
                }
            } catch (Exception $e) {
                echo "Fallo al mostrar: (" . $e->getMessage() . ") <br>";
            }
            
            $resultados->free_result();
            $consulta->close();
            self::$conexion->close();
        }
        return $personas;
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
                    echo json_encode(['Id: ' => $persona->id, 
                    'Nombre: ' => $persona->nombre,
                    'Contrasenia: '=>$persona->contrasenia,
                    'Correo: '=>$persona->correo,
                    'Partidas Jugadas: '=>$persona->partidasJugadas,
                    'Partidas Ganadas: '=>$persona->partidasGanadas,
                    'Administrador:' =>$persona->administrador]);
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
    
        $query->bind_param('ss',$nuevoCorreo, $correo);

        try {
            $query->execute(); 
        } catch (Exception $e) {
            echo "Fallo al modificar el usuario: (" . $e->getMessage() . ") <br>";
        }

        $query->close();
        self::$conexion->close();
    }

    //Borrado de usuario
    static function borrarUsuario($correo){
        self::comprobarConexion();
    
        $query = self::$conexion->prepare(constantes::$borrarUsuario);
    
        $query->bind_param('s', $correo);
    
        try {
            $query->execute();
        } catch (Exception $e) {
            echo "Fallo al borrar: (" . $e->getMessage() . ") <br>";
        }
        $query->close();
        self::$conexion->close();
    }

    //Creación de nueva partida
    static function insertarPartida($idPartida,$idUsu,$tableroOculto,$tableroMostrado,$finalizado){
        self::comprobarConexion();

        $query=self::$conexion->prepare(constantes::$crearPartida); 
        $query->bind_param('iissi',$idPartida,$idUsu,$tableroOculto,$tableroMostrado,$finalizado);

        try {
            echo $query->execute();
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
            $stmt->bind_param('i',$idPartida);
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
    static function modificarContraseña($correo, $nuevaContrasenia) {
        self::comprobarConexion();
    
        $query = self::$conexion->prepare(constantes::$modificarContrasenia);
        $query->bind_param('ss', $nuevaContrasenia, $correo);
    
        try {
            $query->execute();
        } catch (Exception $e) {
            echo "Fallo al modificar el usuario: (" . $e->getMessage() . ") <br>";
        }
    
        $query->close();
        self::$conexion->close();
    }

    //Actualizar partida finalizada
    static function actualizarPartidaFinalizada($idPartida){
        self::comprobarConexion();

        $query=self::$conexion->prepare(constantes::$actualizarPartidaFinalizada);
        $query->bind_param('i', $idPartida);
    
        try {
            $query->execute();
        } catch (Exception $e) {
            echo "Fallo al modificar la partida: (" . $e->getMessage() . ") <br>";
        }
    
        $query->close();
        self::$conexion->close();
    }

    //Consulta a partidas terminadas
    public static function partidasTerminadas(){
        $partida=null;
        if (self::comprobarConexion()==0) {
            $consulta=self::$conexion->prepare(constantes::$selectTodosUsuarios);

            try {
                
                $consulta->execute();
                $resultados=$consulta->get_result();
                $personas=[];

                while ($fila=$resultados->fetch_array()){
                    $partida = new partida($fila[0], $fila[1], $fila[2], $fila[3], $fila[4]);
                    echo json_encode(['IdPartida: ' => $partida->idPartida,
                    'IdUsuario: '=>$partida->idUsuario,
                    'Finalizado: '=>$partida->finalizado]);
                    array_push($partidas,$partida);
                }
            } catch (Exception $e) {
                echo "Fallo al mostrar: (" . $e->getMessage() . ") <br>";
            }
            
            $resultados->free_result();
            $consulta->close();
            self::$conexion->close();
        }
        return $partidas;
    }

    //Actualizar cada vez que gana una partida
    public static function actualizarRankingPartidasGanadas($idPartida){
        self::comprobarConexion();
    
        $query = self::$conexion->prepare(constantes::$actualizarGanadas);
        $query->bind_param('i', $idPartida);
    
        try {
            $query->execute();
        } catch (Exception $e) {
            echo "Fallo al actualizar las Ganadas: (" . $e->getMessage() . ") <br>";
        }
    
        $query->close();
        self::$conexion->close();
    }

    //Actualizar cada vez que juegue una partida
    public static function actualizarRankingPartidasJugadas($idPartida){
        self::comprobarConexion();
    
        $query = self::$conexion->prepare(constantes::$actualizarJugadas);
        $query->bind_param('i', $idPartida);
    
        try {
            $query->execute();
        } catch (Exception $e) {
            echo "Fallo al actualizar las Ganadas: (" . $e->getMessage() . ") <br>";
        }
    
        $query->close();
        self::$conexion->close();
    }

    //Rendirse
    public static function rendirse($idPartida){
        self::comprobarConexion();
    
        $query = self::$conexion->prepare(constantes::$rendirse);
        $query->bind_param('i', $idPartida);
    
        try {
            $query->execute();
        } catch (Exception $e) {
            echo "Fallo al actualizar las Ganadas: (" . $e->getMessage() . ") <br>";
        }
    
        $query->close();
        self::$conexion->close();
    }

    //Consulta partidas ganadas
    public static function todoRanking(){
        $persona=null;
        if (self::comprobarConexion()==0) {
            $consulta=self::$conexion->prepare(constantes::$ranking);

            try {
                
                $consulta->execute();
                $resultados=$consulta->get_result();
                $personas=[];

                while ($fila=$resultados->fetch_array()){
                    $persona = new Persona($fila[0], $fila[1], $fila[2], $fila[3], $fila[4], $fila[5], $fila[6]);
                    echo json_encode(['Nombre: ' => $persona->nombre,
                    'Partidas Ganadas: '=>$persona->partidasGanadas]);
                    array_push($personas,$persona);
                }
            } catch (Exception $e) {
                echo "Fallo al mostrar: (" . $e->getMessage() . ") <br>";
            }
            
            $resultados->free_result();
            $consulta->close();
            self::$conexion->close();
        }
        return $personas;
    }
}