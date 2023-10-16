<?php

require_once('Auxiliar/factoria.php');
require_once('Auxiliar/conexion.php');

class controllerPersona{

    public static function login($datosRecibidos){
        $jugador=conexion::consultarUsuario($datosRecibidos['correo']);
            
        if ($jugador instanceof persona) {
            if ($jugador->getCorreo()==$datosRecibidos['correo']) {
                if ($jugador->getContrasenia()==md5($datosRecibidos['contrasenia'])) {
                    return $jugador;
                }else {
                    $cod=400;
                    $mes='Contraseña erronea.';
                    header('HTTP/1.1 '. $cod.' '.$mes);
                    
                    return json_encode(['Código'=>$cod, 'Mensaje'=>$mes]);
                }
            }else {
                $cod=400;
                $mes='Correo incorrecto.';
                header('HTTP/1.1 '. $cod.' '.$mes);
                    
                return json_encode(['Código'=>$cod, 'Mensaje'=>$mes]);
            }
        }else {
            $cod=400;
            $mes='Error en el usuario.';
            header('HTTP/1.1 '. $cod.' '.$mes);
                    
            return json_encode(['Código'=>$cod, 'Mensaje'=>$mes]);
        }
    }

    public static function obtenerJugadores(){
        $jugadores=conexion::getJugadores();

        if ($jugadores[0] instanceof persona) {
            $cod=200;
            $mes='Todo OK';
            header('HTTP/1.1 '. $cod.' '.$mes);
                    
            return json_encode(['Código'=>$cod, 'Mensaje'=>$mes]);
        }else {
            $cod=400;
            $mes='Error con los jugadores';
            header('HTTP/1.1 '. $cod.' '.$mes);
                    
            return json_encode(['Código'=>$cod, 'Mensaje'=>$mes]);
        }
    }

    public static function actualizarJugador($datosRecibidos){
        $jugador=factoria::crearUsuario($datosRecibidos['id'],$datosRecibidos['nombre'],$datosRecibidos['contrasenia'],$datosRecibidos['correo'],0,0,$datosRecibidos['administrador']);

        if (conexion::modificarUsuario($jugador,$datosRecibidos['nuevoNombre'])) {
            $cod=200;
            $mes='Todo OK';
            header('HTTP/1.1 '. $cod.' '.$mes);
                    
            return json_encode(['Código'=>$cod, 'Mensaje'=>$mes]);  
        }else {
            $cod=400;
            $mes='Error al modificar el usuario';
            header('HTTP/1.1 '. $cod.' '.$mes);
                    
            return json_encode(['Código'=>$cod, 'Mensaje'=>$mes]);
        }
    }

    public static function borrarJugador($datosRecibidos){
        if (conexion::borrarUsuario($datosRecibidos['correo'])) {
            $cod=200;
            $mes='Todo OK';
            header('HTTP/1.1 '. $cod.' '.$mes);
                    
            return json_encode(['Código'=>$cod, 'Mensaje'=>$mes]);  
        }else {
            $cod=400;
            $mes='Error borrar el usuario';
            header('HTTP/1.1 '. $cod.' '.$mes);
                    
            return json_encode(['Código'=>$cod, 'Mensaje'=>$mes]);
        }
    }

    public static function crearJugador($datosRecibidos){
        $jugador=factoria::crearUsuario(0,$datosRecibidos['nombre'],$datosRecibidos['contrasenia'],$datosRecibidos['correo'],0,0,0);

        if (conexion::crearUsuario($jugador)) {
            $cod=200;
            $mes='Todo OK';
            header('HTTP/1.1 '. $cod.' '.$mes);
                    
            return json_encode(['Código'=>$cod, 'Mensaje'=>$mes]); 
        }else {
            $cod=400;
            $mes='Error al crear el jugador';
            header('HTTP/1.1 '. $cod.' '.$mes);
                    
            return json_encode(['Código'=>$cod, 'Mensaje'=>$mes]); 
        }
    }

    public static function actualizarContrasenia($datosRecibidos){
        $jugador=factoria::crearUsuario($datosRecibidos['id'],$datosRecibidos['nombre'],$datosRecibidos['contrasenia'],$datosRecibidos['correo'],0,0,$datosRecibidos['administrador']);

        if (conexion::modificarUsuario($jugador,$datosRecibidos['nuevoNombre'])) {
            $cod=200;
            $mes='Todo OK';
            header('HTTP/1.1 '. $cod.' '.$mes);
                    
            return json_encode(['Código'=>$cod, 'Mensaje'=>$mes]);  
        }else {
            $cod=400;
            $mes='Error al modificar el usuario';
            header('HTTP/1.1 '. $cod.' '.$mes);
                    
            return json_encode(['Código'=>$cod, 'Mensaje'=>$mes]);
        }
    }
}