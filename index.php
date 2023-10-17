<?php

require_once ('Controller/controllerPartida.php');
require_once ('Controller/controllerPersona.php');
require_once ('Modelo/persona.php');

header("Content-Type:application/json");

$requestMethod = $_SERVER["REQUEST_METHOD"];
$paths = $_SERVER['REQUEST_URI'];

$argus=explode('/',$paths);
unset($argus[0]);

    if ($requestMethod=='GET') {
        if (empty($argus[1])) {
            $cod=406;
            $mes='No hay argumentos';
            header('HTTP/1.1 '.$cod.' '.$mes);
            echo json_encode(['cod'=>$cod,
                                'mes'=>$mes]);
        }else {
            if (count($argus)>20) {
                $cod=406;
                $mes="Hay demasiados argumentos";
                header('HTTP/1.1 '.$cod.' '.$mes);
                echo json_encode(['cod' => $cod,
                                    'mes' => $mes]);
            }else {
                switch($argus[1]){
                    case 'admin':
                        if ($persona=controllerPersona::login($argus[2],$argus[3])) {
                            if ($persona->getAdministrador()==1) {
                                switch($argus[4]){
                                    case 'listar':

                                    case 'registrar':
                                        if ($jugador = controllerPersona::crearJugador($argus[5], $argus[6], $argus[7], $argus[8])) {
                                            $cod = 200;
                                            $mes = 'Usuario creado';
                                            header('HTTP/1.1 ' . $cod . ' ' . $mes);
                                            return json_encode(['Código' => $cod, 'Mensaje' => $mes]);
                                        } else {
                                            $cod = 406;
                                            $mes = "Error al crear el jugador";
                                            header('HTTP/1.1 ' . $cod . ' ' . $mes);
                                            echo json_encode(['cod' => $cod, 'mes' => $mes]);
                                        }
                                        break;
                                    case 'modificar':
                                        if (controllerPersona::actualizarJugador($argus[5],$argus[6])) {
                                            $cod = 200;
                                            $mes = 'Jugador actualizado';
                                            header('HTTP/1.1 ' . $cod . ' ' . $mes);
                                            return json_encode(['Código' => $cod, 'Mensaje' => $mes]);
                                        }else {
                                            $cod = 406;
                                            $mes = "Error al crear el jugador";
                                            header('HTTP/1.1 ' . $cod . ' ' . $mes);
                                            echo json_encode(['cod' => $cod, 'mes' => $mes]);
                                        }
                                    case 'eliminar':
                                    case 'cambio':
                                }
                            }else {
                                $cod=406;
                                $mes="Este usuario no es administrador";
                                header('HTTP/1.1 '.$cod.' '.$mes);
                                echo json_encode(['cod' => $cod,
                                                    'mes' => $mes]);
                            }
                        }else {
                            $cod=406;
                                $mes="Error al iniciar sesión";
                                header('HTTP/1.1 '.$cod.' '.$mes);
                                echo json_encode(['cod' => $cod,
                                                    'mes' => $mes]);
                        }
                        break;
                    case 'user':
                        if (controllerPersona::login($argus[2],$argus[3])) {
                            
                        }
                        break;
                }
            }
        }
    }

    if ($requestMethod=='POST') {
        if (empty($argus[1])) {
            $cod=406;
            $mes='No hay argumentos';
            header('HTTP/1.1 '.$cod.' '.$mes);
            echo json_encode(['cod'=>$cod,
                                'mes'=>$mes]);
        }else {
            if (count($argus)>5) {
                $cod=406;
                $mes="Hay demasiados argumentos";
                header('HTTP/1.1 '.$cod.' '.$mes);
                echo json_encode(['cod' => $cod,
                                    'mes' => $mes]);
            }
        }
    }

    if ($requestMethod=='PUT') {
        if (empty($argus[1])) {
            $cod=406;
            $mes='No hay argumentos';
            header('HTTP/1.1 '.$cod.' '.$mes);
            echo json_encode(['cod'=>$cod,
                                'mes'=>$mes]);
        }else {
            if (count($argus)>5) {
                $cod=406;
                $mes="Hay demasiados argumentos";
                header('HTTP/1.1 '.$cod.' '.$mes);
                echo json_encode(['cod' => $cod,
                                    'mes' => $mes]);
            }
        }
    }

    if ($requestMethod=='DELETE') {
        if (empty($argus[1])) {
            $cod=406;
            $mes='No hay argumentos';
            header('HTTP/1.1 '.$cod.' '.$mes);
            echo json_encode(['cod'=>$cod,
                                'mes'=>$mes]);
        }else {
            if (count($argus)>5) {
                $cod=406;
                $mes="Hay demasiados argumentos";
                header('HTTP/1.1 '.$cod.' '.$mes);
                echo json_encode(['cod' => $cod,
                                    'mes' => $mes]);
            }else {
                # code...
            }
        }
    }


