<?php
class Asociado
{
	private $id = null; // Se inicializa a nulo por defecto
	private $nombre;
	private $logo;
	private $descripcion;

	// Constante para la ruta de los logos
	const RUTA_LOGOS_ASOCIADOS = "/public/images/asociados/";

	// Constructor que recibe todos los parámetros excepto el id
	public function __construct($nombre, $logo, $descripcion)
	{
		$this->nombre = $nombre;
		$this->logo = $logo;
		$this->descripcion = $descripcion;
	}

	// Getters
	public function getId()
	{
		return $this->id;
	}

	public function getNombre()
	{
		return $this->nombre;
	}

	public function getLogo()
	{
		return $this->logo;
	}

	public function getDescripcion()
	{
		return $this->descripcion;
	}

	// Setters que devuelven el objeto $this para permitir encadenamiento
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}

	public function setNombre($nombre)
	{
		$this->nombre = $nombre;
		return $this;
	}

	public function setLogo($logo)
	{
		$this->logo = $logo;
		return $this;
	}

	public function setDescripcion($descripcion)
	{
		$this->descripcion = $descripcion;
		return $this;
	}

	// Método que devuelve la URL completa del logo
	public function getUrl()
	{
		return self::RUTA_LOGOS_ASOCIADOS . $this->logo;
	}

	// Sobrescribir el método __toString para devolver la descripción del logo
	public function __toString()
	{
		return $this->descripcion;
	}
}
