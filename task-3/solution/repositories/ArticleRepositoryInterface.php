<?php

declare(strict_types=1);

namespace app\repositories;

use app\entities\article\Article;
use app\entities\article\Content;
use app\entities\article\Title;
use app\entities\user\User as Author;

/**
 * Интерфейс репозитория для получения доступа к данным по статьям.
 */
interface ArticleRepositoryInterface
{
	/**
	 * Получить все статьи по пользователю.
	 * @return Article[]|array
	 */
	public function findAllByUser(User $user): array;

	/**
	 * @param Title $title
	 * @param Content $content
	 * @param Author $author
	 * @return Article
	 */
	public function create(Title $title, Content $content, Author $author): Article;

	/**
	 * @param Article $article
	 * @return bool
	 */
	public function update(Article $article): bool;
}