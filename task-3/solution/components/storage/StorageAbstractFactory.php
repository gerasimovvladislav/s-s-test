<?php

declare(strict_types=1);

namespace app\components\storage;

use app\components\storage\db\DbStorageInterface;
use app\components\storage\db\FileStorageInterface;
use app\components\storage\redis\RedisStorageInterface;
use app\config\Config;

abstract class StorageAbstractFactory implements StorageAbstractFactoryInterface
{
	/** @var Config*/
	private $config;

	public function __construct(Config $config)
	{
		$this->config = $config;
		$this->use($this->config->storage);
	}

	/**
	 * Устанавливаем - какое хранилище будем использовать.
	 * Паттерн Стратегия
	 */
	private function use(StorageInterface $storage): bool
	{
		switch ($storage) {
			case DbStorageInterface::class:
				return true;
				break;
			case FileStorageInterface::class:
				return true;
				break;
			case RedisStorageInterface::class:
				return true;
				break;
			default:
				return true;
		}
	}
}