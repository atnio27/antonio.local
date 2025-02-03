<?php

namespace antonio\app\entity;

use antonio\app\entity\IEntity;

class Imagen implements IEntity
{
	private $id = null;
	private $nombre = "";
	private $descripcion = "";
	private $idUsuario = null;
	private $categoria = 1;
	private $numVisualizaciones = 0;
	private $numLikes = 0;
	private $numDownloads = 0;

	const RUTA_IMAGENES_PORTFOLIO = '/public/images/index/portfolio/';
	const RUTA_IMAGENES_GALERIA = '/public/images/index/gallery/';
	const RUTA_IMAGENES_CLIENTES = '/public/images/clients/';
	const RUTA_IMAGENES_SUBIDAS = '/public/images/imagenes_subidas/';

	public function __construct($nombre = "", $descripcion = "", $categoria = 1, $idUsuario = null, $numVisualizaciones = 0, $numLikes = 0, $numDownloads = 0)
	{
		$this->nombre = $nombre;
		$this->descripcion = $descripcion;
		$this->idUsuario = $idUsuario;
		$this->categoria = $categoria;
		$this->numVisualizaciones = $numVisualizaciones;
		$this->numLikes = $numLikes;
		$this->numDownloads = $numDownloads;
	}

	public function toArray(): array
	{
		return [
			'id' => $this->getId(),
			'nombre' => $this->getNombre(),
			'descripcion' => $this->getDescripcion(),
			'idUsuario' => $this->idUsuario,
			'numVisualizaciones' => $this->getNumVisualizaciones(),
			'numLikes' => $this->getNumLikes(),
			'numDownloads' => $this->getNumDownloads(),
			'categoria' => $this->getCategoria()
		];
	}

	public function getId()
	{
		return $this->id;
	}
	public function getNombre()
	{
		return $this->nombre;
	}
	public function getDescripcion()
	{
		return $this->descripcion;
	}
	public function getIdUsuario()
	{
		return $this->idUsuario;
	}
	public function getCategoria()
	{
		return $this->categoria;
	}
	public function getNumVisualizaciones()
	{
		return $this->numVisualizaciones;
	}
	public function getNumLikes()
	{
		return $this->numLikes;
	}
	public function getNumDownloads()
	{
		return $this->numDownloads;
	}
	public function setNombre($nombre): Imagen
	{
		$this->nombre = $nombre;
		return $this;
	}
	public function setDescripcion($descripcion): Imagen
	{
		$this->descripcion = $descripcion;
		return $this;
	}
	public function setIdUsuario($idUsuario): Imagen
	{
		$this->idUsuario = $idUsuario;
		return $this;
	}
	public function setCategoria($categoria): Imagen
	{
		$this->categoria = $categoria;
		return $this;
	}
	public function setNumVisualizaciones($numVisualizaciones): Imagen
	{
		$this->numVisualizaciones = $numVisualizaciones;
		return $this;
	}
	public function setNumLikes($numLikes): Imagen
	{
		$this->numLikes = $numLikes;
		return $this;
	}
	public function setNumDownloads($numDownloads): Imagen
	{
		$this->numDownloads = $numDownloads;
		return $this;
	}

	public function getUrlPortfolio()
	{
		return self::RUTA_IMAGENES_PORTFOLIO . $this->getNombre();
	}
	public function getUrlGaleria()
	{
		return self::RUTA_IMAGENES_GALERIA . $this->getNombre();
	}
	public function getUrlClientes()
	{
		return self::RUTA_IMAGENES_CLIENTES . $this->getNombre();
	}
	public function getUrlSubidas()
	{
		return self::RUTA_IMAGENES_SUBIDAS . $this->getNombre();
	}

	public function __toString()
	{
		return $this->descripcion;
	}
}
