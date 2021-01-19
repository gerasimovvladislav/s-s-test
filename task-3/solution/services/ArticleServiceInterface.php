<?php

declare(strict_types=1);

namespace app\services;

use app\entities\article\Article;
use app\entities\user\User;

/**
 * Интерфейс для сервиса для работы со статьями.
 */
interface ArticleServiceInterface
{
	/**
	 * Получить все статьи (возможность фильтровать по пользователю).
	 * @return array
	 */
	public function getAll(?User $user = null): array;

	/**
	 * Создает статью текущим пользователем.
	 * @param string $title
	 * @param string $content
	 * @return bool
	 */
	public function create(string $title, string $content): bool;

	/**
	 * Передать статью другому пользователю.
	 * @param Article $article
	 * @param User $newAuthor
	 * @return bool
	 */
	public function transfer(Article $article, User $newAuthor): bool;
}