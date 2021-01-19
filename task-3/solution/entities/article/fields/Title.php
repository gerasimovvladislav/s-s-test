<?php

declare(strict_types=1);

namespace app\entities\article\fields;

/**
 * Заголовок статьи.
 */
class Title
{
	private $text;

	public function __construct(string $text)
	{
		$this->text = $text;
	}

	public function getText(): string
	{
		return $this->text;
	}
}