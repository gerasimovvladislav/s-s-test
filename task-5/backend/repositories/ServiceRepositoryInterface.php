<?php

declare(strict_types=1);

namespace backend\repositories;

use common\models\db\RefService;

/**
 * Интерфейс репозитория для услуг.
 *
 * @author Vladislav Gerasimov <gerasim9393@mail.ru>
 */
interface ServiceRepositoryInterface
{
	public function getAll(): array;

	public function getById(): RefService;
}