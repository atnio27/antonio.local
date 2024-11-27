<?php

require_once __DIR__ . '/../entity/IEntity.php';

class Categoria implements IEntity
{
	// const RUTA_IMAGENES_PORTFOLIO = '/public/images/index/portfolio/';
	// const RUTA_IMAGENES_GALERIA = '/public/images/index/gallery/';
	// const RUTA_IMAGENES_CLIENTES = '/public/images/clients/';
	// const RUTA_IMAGENES_SUBIDAS = '/public/images/galeria/';

	/**
	 * @var string
	 */
	private $id;
	private $nombre;
	private $numImagenes;

	public function __construct(
		string $nombre = "",
		int $numImagenes = 0
	) {
		$this->id = null;
		$this->nombre = $nombre;
		$this->numImagenes = $numImagenes;
	}

	public function toArray(): array
	{
		return [
			'id' => $this->getId(),
			'nombre' => $this->getNombre(),
			'numImagenes' => $this->getNumImagenes()
		];
	}

	// Getter para $id
	public function getId()
	{
		return $this->id;
	}

	// Setter para $id
	public function setId($id)
	{
		$this->id = $id;
	}

	// Getter para $nombre
	public function getNombre(): string
	{
		return $this->nombre;
	}

	// Setter para $nombre
	public function setNombre(string $nombre)
	{
		$this->nombre = $nombre;
	}

	// Getter para $numImagenes
	public function getNumImagenes(): int
	{
		return $this->numImagenes;
	}

	// Setter para $numImagenes
	public function setNumImagenes(int $numImagenes)
	{
		$this->numImagenes = $numImagenes;
	}
}
