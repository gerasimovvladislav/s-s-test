<?php

declare(strict_types=1);

namespace backend\models\form;

use common\models\db\RefCity;
use common\models\db\RefService;
use common\yii\TrimValidator;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\validators\NumberValidator;
use yii\validators\RangeValidator;
use yii\validators\RequiredValidator;
use yii\validators\StringValidator;
use Yii;

class ServiceForm extends Model
{
	/** @var string Название услуги */
	public $name;
	const ATTR_NAME = 'name';

	/** @var string Описание услуги */
	public $description;
	const ATTR_DESCRIPTION = 'description';

	/** @var string Код */
	public $code;
	const ATTR_CODE = 'code';

	/** @var int Статус */
	public $status;
	const ATTR_STATUS = 'status';

	/** @var string Город */
	public $cityId;
	const ATTR_CITY_ID = 'cityId';

	/** @var string Дата удаления */
	public $deletedAt;
	const ATTR_DELETED_AT = 'deletedAt';

	const STATUSES = [
		RefService::STATUS_ACTIVE => "Активный",
		RefService::STATUS_INACTIVE => "Не активный",
	];

	/** @var RefService Модель, с которой работает форма */
	public $service;

	/**
	 * {@inheritdoc}
	 *
	 * @param RefService $service Модель, с которой работает форма
	 */
	public function __construct(RefService $service, $config = [])
	{
		$this->service = $service;
		$this->name = $service->name;
		$this->description = $service->description;
		$this->code = $service->code;
		$this->cityId = $service->city_id;
		$this->status = $service->status;
		$this->deletedAt = $service->deleted_at;

		parent::__construct($config);
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules(): array
	{
		return [
			[static::ATTR_NAME, TrimValidator::class],
			[static::ATTR_NAME, RequiredValidator::class],
			[static::ATTR_NAME, StringValidator::class, "length" => [2, 255]],
			[static::ATTR_DESCRIPTION, StringValidator::class, "length" => [2, 255]],
			[static::ATTR_CODE, StringValidator::class, "length" => 7],
			[static::ATTR_CITY_ID, NumberValidator::class],
			[static::ATTR_STATUS, RangeValidator::class, 'range' => [RefService::STATUS_INACTIVE, RefService::STATUS_ACTIVE]],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels(): array
	{
		return [
			static::ATTR_NAME => 'Услуга',
			static::ATTR_DESCRIPTION => 'Описание',
			static::ATTR_CITY_ID => 'Город',
		];
	}

	/**
	 * Сохранение данных, указанных в форме.
	 *
	 * @return bool
	 */
	public function save(): bool
	{
		if (false === $this->validate()) {
			return false;
		}

		$this->service->name = $this->name;
		$this->service->description = $this->description;
		$this->service->code = $this->code;
		$this->service->city_id = $this->cityId;
		$this->service->status = $this->status;
		$this->service->deleted_at = $this->deletedAt;

		if (false === $this->service->save()) {
			throw new \LogicException($this->service);
		}

		return true;
	}

	/**
	 * Пометить услугу как удаленную
	 *
	 * @return bool
	 */
	public function delete(): bool
	{
		if (null !== $this->service->deleted_at) {
			Yii::$app->session->addFlash('danger', 'Ошибка при удалении услуги');
		} else {
			$this->service->deleted_at = time();

			if (false !== $this->service->save()) {
				return true;
			}
		}

		return false;
	}

	public static function getCitiesForDropdown(): ?array
	{
		$cities = RefCity::find()->all();

		return ArrayHelper::map($cities, RefCity::ATTR_ID, RefCity::ATTR_NAME);
	}
}