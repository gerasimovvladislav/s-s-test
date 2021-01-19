<?php

declare(strict_types=1);

namespace app\components\storage\redis;

/**
 * Интерфейс хранилища данных в редисе.
 */
interface RedisStorageInterface
{
	public function useDb(): void;

	public function save(): bool;

	public function find(): array;

	//TODO: описываем остальные методы
}