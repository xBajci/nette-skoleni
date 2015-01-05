<?php

interface MovieFacade
{
	function getRecentMovies();
}

class MovieFacadeDb implements MovieFacade
{
	private $db;

	function __construct(Nette\Database\Context $db)
	{
		$this->db = $db;
	}

	function getRecentMovies()
	{
		return $this->db->query('SELECT * FROM movies ORDER BY year');
	}

}



class Factory
{

	/** @return stdClass */
	static function createObj($arg)
	{
		return new stdClass;
	}

}