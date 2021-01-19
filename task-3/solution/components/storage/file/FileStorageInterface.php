<?php

declare(strict_types=1);

namespace app\components\storage\db;

/**
 * Интерфейс хранилища данных в файловой системе.
 */
interface FileStorageInterface
{
	public function setPath(): string;

	public function save(): bool;

	public function find(): array;

	//TODO: описываем остальные методы
}