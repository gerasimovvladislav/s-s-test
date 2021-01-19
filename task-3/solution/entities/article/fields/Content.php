<?php

declare(strict_types=1);

namespace app\entities\article;

/**
 * Контент статьи.
 */
class Content
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