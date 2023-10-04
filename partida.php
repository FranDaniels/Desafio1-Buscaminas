<?php

class partida{
    public $idPartida;
    public $idUsuario;
    public $tableroOculto;
    public $tableroMostrado;
    public $finalizado;

	public function __construct($idPartida, $idUsuario, $tableroOculto, $tableroMostrado, $finalizado) {

		$this->idPartida = $idPartida;
		$this->idUsuario = $idUsuario;
		$this->tableroOculto = $tableroOculto;
		$this->tableroMostrado = $tableroMostrado;
		$this->finalizado = $finalizado;
	}

	public function getIdPartida() {
		return $this->idPartida;
	}

	public function setIdPartida($value) {
		$this->idPartida = $value;
	}

	public function getIdUsuario() {
		return $this->idUsuario;
	}

	public function setIdUsuario($value) {
		$this->idUsuario = $value;
	}

	public function getTableroOculto() {
		return $this->tableroOculto;
	}

	public function setTableroOculto($value) {
		$this->tableroOculto = $value;
	}

	public function getTableroMostrado() {
		return $this->tableroMostrado;
	}

	public function setTableroMostrado($value) {
		$this->tableroMostrado = $value;
	}

	public function getFinalizado() {
		return $this->finalizado;
	}

	public function setFinalizado($value) {
		$this->finalizado = $value;
	}
}