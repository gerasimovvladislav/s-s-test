<?php

use common\models\db\RefCity;
use yii\db\Migration;

/**
 * Class m210118_202340_create_table_city
 */
class m210118_202340_create_table_city extends Migration
{
	const RECORDS = [
		[1, "Dimitrovgrad"],
		[2, "Moscow"],
		[3, "Praga"],
		[4, "Saint-Peterburg"],
		[5, "Samara"],
	];

    public function up()
    {
		$this->createTable(RefCity::tableName(), [
			RefCity::ATTR_ID => 'pk',
			RefCity::ATTR_NAME => $this->string(32),
		]);

		$this->batchInsert(RefCity::tableName(), [RefCity::ATTR_ID, RefCity::ATTR_NAME], static::RECORDS);
    }

    public function down()
    {
		$this->dropTable(RefCity::tableName());
    }
}
