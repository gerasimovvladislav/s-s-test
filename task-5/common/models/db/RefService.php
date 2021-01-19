<?php

namespace common\models\db;

use common\models\query\RefServiceQuery;
use yii\db\ActiveRecord;
use Yii;

/**
 * Справочник услуг.
 *
 * @property string         $id                     Идентификатор.
 * @property string         $code                   Код.
 * @property string         $name                   Название.
 * @property string         $description            Описание.
 * @property float         	$price             		Цена.
 * @property int         	$status             	Статус.
 * @property int         	$expired             	Срок действия.
 * @property int         	$city_id             	Город.
 * @property int         	$deleted_at             Дата удаления.
 *
 * @property RefCity 		$city                   Модель города.
 *
 * @author Vladislav Gerasimov <gerasim9393@mail.ru>
 */
class RefService extends ActiveRecord
{
	const ATTR_ID = "id";
	const ATTR_NAME = "name";
	const ATTR_CODE = "code";
	const ATTR_PRICE = "price";
	const ATTR_DESCRIPTION = "description";
	const ATTR_STATUS = "status";
	const ATTR_EXPIRED = "expired";
	const ATTR_CITY_ID = "city_id";
	const ATTR_DELETED_AT = "deleted_at";

	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 0;

	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'ref_service';
	}

	/**
	 * Получить город
	 *
	 * @return RefCity|null
	 */
	public function getCity(): ?RefCity {
		return RefCity::findOne($this->city_id);
	}

	/**
	 * {@inheritDoc}
	 * @return RefServiceQuery
	 * @author Vladislav Gerasimov <v.gerasimov@nash.travel>
	 */
	public static function find(): RefServiceQuery
	{
		return Yii::createObject(RefServiceQuery::class, [get_called_class()]);
	}
}