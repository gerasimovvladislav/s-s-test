<?php

use common\models\db\RefCity;
use common\models\db\RefService;
use yii\db\Migration;

/**
 * Class m210118_202546_create_table_service
 */
class m210118_202546_create_table_service extends Migration
{
	const ATTR_FK_CITY = 'service_city_fk';
	const ATTR_INDEX_CITY_ID = 'idx-service-city-id';
	const ATTR_INDEX_NAME = 'idx-service-name';
	const ATTR_INDEX_STATUS = 'idx-service-status';

	const RECORDS = [
		[1, "Test service 1", "Test description for test service 1", "A_Nhj13", 1, RefService::STATUS_ACTIVE],
		[2, "Test service 2", "Test description for test service 2", "A_Nhj14", 2, RefService::STATUS_INACTIVE],
		[3, "Test service 3", "Test description for test service 3", "A_NYj14", 3, RefService::STATUS_ACTIVE],
		[4, "Test service 4", "Test description for test service 4", "OONYj14", 4, RefService::STATUS_INACTIVE],
		[5, "Test service 5", "Test description for test service 5", "lOtYj14", 5, RefService::STATUS_ACTIVE],
	];

	public function up()
	{
		$this->createTable(RefService::tableName(), [
			RefService::ATTR_ID => 'pk',
			RefService::ATTR_NAME => $this->string(32),
			RefService::ATTR_CODE => $this->string(7),
			RefService::ATTR_PRICE => $this->decimal(15, 4),
			RefService::ATTR_DESCRIPTION => $this->text(),
			RefService::ATTR_STATUS => $this->tinyInteger()->defaultValue(RefService::STATUS_INACTIVE),
			RefService::ATTR_EXPIRED => $this->integer(11),
			RefService::ATTR_CITY_ID => $this->integer(11),
			RefService::ATTR_DELETED_AT => $this->integer(11),
		]);

		$this->addForeignKey(
			static::ATTR_FK_CITY,
			RefService::tableName(),
			RefService::ATTR_CITY_ID,
			RefCity::tableName(),
			RefCity::ATTR_ID,
			'CASCADE'
		);

		$this->createIndex(static::ATTR_INDEX_CITY_ID, RefService::tableName(), RefService::ATTR_CITY_ID);
		$this->createIndex(static::ATTR_INDEX_NAME, RefService::tableName(), RefService::ATTR_NAME);
		$this->createIndex(static::ATTR_INDEX_STATUS, RefService::tableName(), RefService::ATTR_STATUS);

		$this->batchInsert(
			RefService::tableName(),
			[
				RefService::ATTR_ID,
				RefService::ATTR_NAME,
				RefService::ATTR_DESCRIPTION,
				RefService::ATTR_CODE,
				RefService::ATTR_CITY_ID,
				RefService::ATTR_STATUS,
			],
			static::RECORDS);
	}

	public function down()
	{
		$this->dropForeignKey(static::ATTR_FK_CITY, RefService::tableName());
		$this->dropTable(RefService::tableName());
	}
}
