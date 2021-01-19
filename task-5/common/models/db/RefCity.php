<?php

namespace common\models\db;

use yii\db\ActiveRecord;

/**
 * Справочник городов.
 *
 * @property string $id Идентификатор.
 * @property string $name Название.
 *
 * @author Vladislav Gerasimov <gerasim9393@mail.ru>
 */
class RefCity extends ActiveRecord
{
	const ATTR_ID = "id";
	const ATTR_NAME = "name";

	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'ref_city';
	}
}