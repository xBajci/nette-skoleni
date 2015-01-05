<?php

namespace App\Model;

use Nette;


class ArticleFacade extends Nette\Object
{
	private $db;

	function __construct(Nette\Database\Context $db)
	{
		$this->db = $db;
	}

	function add(ArticleEntity $art)
	{
		$row = $this->db->table('article')->insert([
			'user_id' => $art->userId,
			'title' => $art->title,
			'content' => $art->content,
			'created' => new \DateTime,
		]);

		$counter = NULL;
		$slug = Nette\Utils\Strings::webalize($art->title);
		try {
			retry:
			$row->update(['slug' => $slug . $counter]);
		} catch (\PDOException $e) {
			if ($e->getCode() === '23000') {
				$counter++;
				goto retry;
			}
			throw $e;
		}
	}

	function getById($id)
	{
		return $this->db->table('article')->where('id', $id);
	}

	function getBySlug($slug)
	{
		return $this->db->table('article')->where('slug', $slug)->fetch();
	}

	function delete($id)
	{
		sleep(1);
		$this->getById($id)->delete();
	}

	function getAll()
	{
		return $this->db->table('article');
	}

}



class ArticleEntity extends Nette\Object
{
	public $title;
	public $content;
	public $userId;
}


class ErrorWhileAddingException extends \Exception
{}

class DuplicateNameException extends \Exception
{}