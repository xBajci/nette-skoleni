<?php

namespace App\Admin\Presenters;

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

	/*function __construct(Model\ArticleFacade $facade)
	{
		$this->facade = $facade;
	}*/


	function startup()
	{
		parent::startup();
		if (!$this->getUser()->isLoggedIn()) {
			$this->redirect('Sign:in', ['backlink' => $this->storeRequest()]);
		}

		//$this->getUser()->isInRole(Roles::MODERATOR)
		//$this->getUser()->isAllowed('file', 'delete')
	}

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

	function createComponentAddForm()
	{
		$form = new Nette\Application\UI\Form();
		$form->addText('title', 'Titulek:')
			->setRequired();
		$form->addTextArea('content');
		$form->addSubmit('send', 'Uložit');
		$form->onSuccess[] = [$this, 'addFormSucceeded'];
		$form->addProtection();
		return $form;
	}

	function addFormSucceeded($form, $vals)
	{
		$art = new Model\ArticleEntity;
		$art->title = $vals->title;
		$art->content = $vals->content;
		$art->userId = $this->getUser()->getId();

		$this->facade->add($art);

		$this->redirect('list');
	}


	function handleDelete($id)
	{
		$this->facade->delete($id);
		if ($this->isAjax()) {
			//$this->sendJson(['status' => 1]);
			$this->redrawControl('articles');
		} else {
			$this->redirect('this');
		}
	}

}


class Roles
{
	const MODERATOR = 'moderator';
}
