<?php

declare(strict_types=1);

namespace backend\repositories;

use common\models\db\RefService;

/**
 * Репозиторий для услуг.
 *
 * @author Vladislav Gerasimov <gerasim9393@mail.ru>
 */
class ServiceRepository implements ServiceRepositoryInterface
{
	public function getAll(): array
	{
		$servicesQuery = RefService::find();
		$services = $servicesQuery->all();

		return $services;
	}

	public function getById(): RefService
	{
		// TODO: Implement getById() method.
	}
}