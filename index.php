<?php

require_once ('partida.php');
require_once ('persona.php');

header("Content-Type:application/json");

$requestMethod = $_SERVER["REQUEST_METHOD"];

$paths = $_SERVER['REQUEST_URI'];  

$argus=explode('/',$paths);

unset($argus[0]); 

