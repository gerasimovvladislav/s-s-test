<?php

declare(strict_types=1);

namespace app\components\storage;

/**
 * Интерфейс фабрики хранилищ.
 */
interface StorageAbstractFactoryInterface
{
	public function use(StorageInterface $storage): bool;
}