<?php

namespace App\Model;

use Nette;


class ImageRepository extends Nette\Object
{
	private $db;

	function __construct(Nette\Database\Context $db)
	{
		$this->db = $db;
	}

	function add(array $image)
	{
		$row = $this->db->table('images')->insert($image);
	}
}