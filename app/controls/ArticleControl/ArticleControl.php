<?php


class ArticleControl extends Nette\Application\UI\Control
{
	private $linkGenerator;

	function __construct($lg)
	{
		$this->linkGenerator = $lg;
	}

	function render($article)
	{
		$this->template->lg = $this->linkGenerator;
		$this->template->article = $article;
		$this->template->render(__DIR__ . '/template.latte');
	}

}