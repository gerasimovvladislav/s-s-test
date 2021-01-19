<?php

declare(strict_types=1);

namespace common\models\query;

use common\models\db\RefCity;
use common\models\db\RefService;
use yii\db\ActiveQuery;
use yii\db\Expression;

/**
 * Шаблоны для запросов в таблицу услуг.
 *
 * @author Vladislav Gerasimov <v.gerasimov@nash.travel>
 */
class RefServiceQuery extends ActiveQuery
{
	/**
	 * Выбрать услугу по городу.
	 *
	 * @param RefCity $city Объект города.
	 *
	 * @return RefServiceQuery
	 * @author Vladislav Gerasimov <v.gerasimov@nash.travel>
	 */
	public function byCity(RefCity $city): self
	{
		return $this
			->andWhere([RefService::tableName() . "." . RefService::ATTR_CITY_ID => $city->id]);
	}

	/**
	 * Фильтруем по активности.
	 *
	 * @return RefServiceQuery
	 * @author Vladislav Gerasimov <v.gerasimov@nash.travel>
	 */
	public function active(): self
	{
		return $this
			->andWhere([RefService::tableName() . "." . RefService::ATTR_STATUS => RefService::STATUS_INACTIVE]);
	}

	/**
	 * Фильтруем не удаленные
	 *
	 * @return RefServiceQuery
	 * @author Vladislav Gerasimov <v.gerasimov@nash.travel>
	 */
	public function notDeleted(): self
	{
		return $this
			->andWhere(['IS', RefService::tableName() . "." . RefService::ATTR_DELETED_AT, new Expression("NULL")]);
	}
}
