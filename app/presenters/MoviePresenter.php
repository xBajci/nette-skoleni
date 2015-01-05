<?php

namespace App\Presenters;

use Nette;


class MoviePresenter extends Nette\Application\UI\Presenter
{
	private $mf;

	function __construct(\MovieFacade $mf/*, UserFacade $uf*/)
	{
		$this->mf = $mf;
	}

	function renderList()
	{
		$this->template->movies = $this->mf->getRecentMovies();
		//include 'template.phtml';
	}

}