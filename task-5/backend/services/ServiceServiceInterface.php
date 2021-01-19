<?php

declare(strict_types=1);

namespace backend\services;

use common\models\db\RefService;

/**
 * Интерфейс сервиса для услуг.
 *
 * @author Vladislav Gerasimov <gerasim9393@mail.ru>
 */
interface ServiceServiceInterface
{
	/**
	 * Возвращает список всех услуг.
	 *
	 * @return RefService[]
	 */
	public function getAll(): array;

	/**
	 * Возвращает список услуг в конкретном городе.
	 * @param int $cityId Идентификатор города.
	 *
	 * @return RefService[]
	 */
	public function getByCity(int $cityId): ?array;

	/**
	 * Возвращает информацию по конкретной услуге.
	 * @param int $cityId Идентификатор услуги.
	 *
	 * @return RefService[]
	 */
	public function getInfoById(int $serviceId): array;
}