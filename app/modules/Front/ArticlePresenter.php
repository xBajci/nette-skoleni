<?php

namespace App\Front\Presenters;

use Nette,
	App\Model;



/**
 * Homepage presenter.
 */
class ArticlePresenter extends BasePresenter
{
	/** @var Model\ArticleFacade @inject */
	public $facade;

	const ARTICLES_PER_PAGE = 5;


	function renderList($page = 1)
	{
		if ($page < 1) {
			$this->redirect('list'); // tohle nebo to druhe
			//$this->error();
		}

		$this->template->articles = $this->facade
			->getAll()->order('created DESC')
			->page($page, self::ARTICLES_PER_PAGE, $lastPage);

		if ($page > $lastPage) {
			$this->redirect('list', $lastPage); // tohle nebo to druhe
			//$this->error();
		}

		$this->template->page = $page;
		$this->template->lastPage = $lastPage;
	}


	function renderDetail($slug)
	{
		$article = $this->facade->getBySlug($slug);
		if (!$article) {
			$this->error();
		}
		$this->template->article = $article;
	}

	function renderRss()
	{
		//$this->lastModified()
		$this->template->articles = $this->facade
			->getAll()->order('created DESC')->limit(10);
	}

	function createComponentArticle()
	{
		return new \ArticleControl(function($article) {
			return $this->link('detail', $article->slug);
		});
	}

}
