<?php

declare(strict_types=1);

namespace app\entities\user;

/**
 * Объект имени пользователя.
 */
class Name
{
	private $last;
	private $first;
	private $middle;

	public function __construct(string $last, string $first, ?string $middle)
	{
		$this->last = $last;
		$this->first = $first;
		$this->middle = $middle;
	}

	/**
	 * Возвращает полное имя пользователя (ФИО).
	 *
	 * @return string
	 */
	public function getFull(): string
	{
		return trim($this->last . ' ' . $this->first . ' ' . $this->middle);
	}

	public function getFirst(): string
	{
		return $this->first;
	}

	public function getMiddle(): ?string
	{
		return $this->middle;
	}

	public function getLast(): string
	{
		return $this->last;
	}
}