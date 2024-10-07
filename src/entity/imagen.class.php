<?php
class Imagen
{
	const RUTA_IMAGENES_PORTFOLIO = '/public/images/index/portfolio/';
	const RUTA_IMAGENES_GALERIA = '/public/images/index/gallery/';
	const RUTA_IMAGENES_CLIENTES = '/public/images/clients/';
	const RUTA_IMAGENES_SUBIDAS = '/public/images/galeria/';

	private $id;
	private $nombre;
	private $descripcion;
	private $categoria;
	private $numVisualizaciones;
	private $numLikes;
	private $numDownloads;

	public function __construct(
		string $nombre = "",
		string $descripcion = "",
		string $categoria = "",
		int $numVisualizaciones = 0,
		int $numLikes = 0,
		int $numDownloads = 0
	) {
		$this->nombre = $nombre;
		$this->descripcion = $descripcion;
		$this->categoria = $categoria;
		$this->numVisualizaciones = $numVisualizaciones;
		$this->numLikes = $numLikes;
		$this->numDownloads = $numDownloads;
	}

	// Getters
	public function getId(): int
	{
		return $this->id;
	}

	public function getNombre(): string
	{
		return $this->nombre;
	}

	public function getDescripcion(): string
	{
		return $this->descripcion;
	}

	public function getCategoria(): string
	{
		return $this->categoria;
	}

	public function getNumVisualizaciones(): int
	{
		return $this->numVisualizaciones;
	}

	public function getNumLikes(): int
	{
		return $this->numLikes;
	}

	public function getNumDownloads(): int
	{
		return $this->numDownloads;
	}

	// Setters (excepto setId())
	public function setNombre(string $nombre): Imagen
	{
		$this->nombre = $nombre;
		return $this;
	}

	public function setDescripcion(string $descripcion): Imagen
	{
		$this->descripcion = $descripcion;
		return $this;
	}

	public function setCategoria(string $categoria): Imagen
	{
		$this->categoria = $categoria;
		return $this;
	}

	public function setNumVisualizaciones(int $numVisualizaciones): Imagen
	{
		$this->numVisualizaciones = $numVisualizaciones;
		return $this;
	}

	public function setNumLikes(int $numLikes): Imagen
	{
		$this->numLikes = $numLikes;
		return $this;
	}

	public function setNumDownloads(int $numDownloads): Imagen
	{
		$this->numDownloads = $numDownloads;
		return $this;
	}

	public function __toString(): string
	{
		return $this->descripcion;
	}

	public function getUrlPortfolio(): string
	{
		return self::RUTA_IMAGENES_PORTFOLIO . $this->getNombre();
	}

	public function getUrlGaleria(): string
	{
		return self::RUTA_IMAGENES_GALERIA . $this->getNombre();
	}

	public function getUrlClientes(): string
	{
		return self::RUTA_IMAGENES_CLIENTES . $this->nombre;
	}
}
