<?php

declare(strict_types=1);

namespace app\entities\user\fields;

/**
 * Идентификатор пользователя.
 */
class Id
{
	private $id;

	public function __construct(string $id)
	{
		$this->id = $id;
	}

	public function getId(): string
	{
		return $this->id;
	}
}