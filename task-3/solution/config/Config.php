<?php

declare(strict_types=1);

namespace app\config;

/**
 * Класс реализующий хранение информации о конфигурации приложения.
 */
class Config
{
	private $params;

	public function __construct(array $params)
	{
		$this->params = $params;
	}

	public function get() { //... }

	public function set() { //... }
}