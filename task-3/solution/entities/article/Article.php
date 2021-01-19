<?php

declare(strict_types=1);

namespace app\entities\article;

use app\entities\article\fields\Title;
use app\entities\article\fields\Content;
use app\entities\user\Id as AuthorId;
use app\entities\user\User;
use app\entities\user\User as Author;

/**
 * Класс сущности Статья.
 */
class Article
{
	/** @var string Заголовок статьи. */
	private $title;

	/** @var string Контент статьи. */
	private $content;

	/** @var Author Объект пользователя/автора. */
	private $author;

	/** @var AuthorId Идентификатор автора. */
	private $authorId;

	public function __construct(Title $title, Content $content, Author $author)
	{
		$this->title = $title;
		$this->content = $content;
		$this->author = $author;
		$this->setAuthor($this->author->getId());
	}

	/**
	 * @param AuthorId $authorId
	 */
	public function setAuthor(AuthorId $authorId): void
	{
		$this->authorId = $authorId;
	}

	/**
	 * @param User
	 */
	public function getAuthor(): User
	{
		return $this->author;
	}
}