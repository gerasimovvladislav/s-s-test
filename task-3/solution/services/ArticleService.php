<?php

declare(strict_types=1);

namespace app\services;

use app\repositories\ArticleRepositoryInterface;

/**
 * Сервис для статей.
 */
class ArticleService implements ArticleServiceInterface
{
	/** @var ArticleRepositoryInterface */
	private $repository;

	public function __construct(ArticleRepositoryInterface $repository)
	{
		$this->repository = $repository;
	}

	//TODO: реализуем интерфейс...
}