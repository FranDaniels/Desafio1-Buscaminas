<?php

class persona{
    public $id;
    public $nombre;
    public $contrasenia;
    public $correo;
    public $partidasJugadas;
    public $partidasGanadas;

	public function __construct($id, $nombre, $contrasenia, $correo, $partidasJugadas, $partidasGanadas) {

		$this->id = $id;
		$this->nombre = $nombre;
		$this->contrasenia = $contrasenia;
		$this->correo = $correo;
		$this->partidasJugadas = $partidasJugadas;
		$this->partidasGanadas = $partidasGanadas;
	}

	public function getId() {
		return $this->id;
	}

	public function setId($value) {
		$this->id = $value;
	}

	public function getNombre() {
		return $this->nombre;
	}

	public function setNombre($value) {
		$this->nombre = $value;
	}

	public function getContrasenia() {
		return $this->contrasenia;
	}

	public function setContrasenia($value) {
		$this->contrasenia = $value;
	}

	public function getCorreo() {
		return $this->correo;
	}

	public function setCorreo($value) {
		$this->correo = $value;
	}

	public function getPartidasJugadas() {
		return $this->partidasJugadas;
	}

	public function setPartidasJugadas($value) {
		$this->partidasJugadas = $value;
	}

	public function getPartidasGanadas() {
		return $this->partidasGanadas;
	}

	public function setPartidasGanadas($value) {
		$this->partidasGanadas = $value;
	}
}