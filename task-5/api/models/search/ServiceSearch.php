<?php

declare(strict_types=1);

namespace api\models\search;

use common\helpers\DateHelper;
use common\models\db\RefService;
use common\yii\TrimValidator;
use yii\data\ActiveDataProvider;
use yii\validators\DefaultValueValidator;
use yii\validators\NumberValidator;
use yii\validators\RangeValidator;
use yii\validators\StringValidator;

/**
 * Форма поиска счетов.
 *
 * @author Vladislav Gerasimov <gerasim9393@mail.ru>
 */
class ServiceSearch extends RefService
{
	/**
	 * {@inheritdoc}
	 *
	 * @author Насибуллин Рафаэль <nsbln.rafael@gmail.com>
	 */
	public function rules(): array
	{
		return [
			[static::ATTR_ID, TrimValidator::class],
			[static::ATTR_ID, NumberValidator::class],
			[static::ATTR_NAME, TrimValidator::class],
			[static::ATTR_NAME, StringValidator::class],
			[static::ATTR_DESCRIPTION, TrimValidator::class],
			[static::ATTR_DESCRIPTION, StringValidator::class],
			[static::ATTR_CODE, TrimValidator::class],
			[static::ATTR_CODE, StringValidator::class],
			[static::ATTR_PRICE, TrimValidator::class],
			[static::ATTR_PRICE, NumberValidator::class],
			[static::ATTR_DESCRIPTION, TrimValidator::class],
			[static::ATTR_DESCRIPTION, StringValidator::class],
			[static::ATTR_STATUS, TrimValidator::class],
			[static::ATTR_STATUS, RangeValidator::class, 'range' => [RefService::STATUS_INACTIVE, RefService::STATUS_ACTIVE]],
			[static::ATTR_EXPIRED, TrimValidator::class],
			[static::ATTR_EXPIRED, DefaultValueValidator::class, 'value' => DateHelper::current()->getTimestamp()],
			[static::ATTR_CITY_ID, TrimValidator::class],
			[static::ATTR_CITY_ID, NumberValidator::class],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels(): array
	{
		return [
			static::ATTR_ID => 'ID',
			static::ATTR_NAME => 'Название',
			static::ATTR_DESCRIPTION => 'Описание',
			static::ATTR_STATUS => 'Статус',
			static::ATTR_EXPIRED => 'Срок действия',
			static::ATTR_CITY_ID => 'Город',
		];
	}

	/**
	 * Выполнение поиска.
	 *
	 * @param array $params Параметры поиска
	 *
	 * @return ActiveDataProvider
	 */
	public function search(array $params): ActiveDataProvider
	{
		$query = static::find()
			->active()
			->notDeleted()
			->orderBy([static::ATTR_EXPIRED => SORT_DESC]);

		$provider = new ActiveDataProvider([
			'query' => $query,
		]);

		$this->load([$this->formName() => $params]);

		if (false === $this->validate()) {
			return $provider;
		}

		$query->andFilterWhere([RefService::ATTR_ID => $this->id]);
		$query->andFilterWhere([RefService::ATTR_CITY_ID => $this->city_id]);

		return $provider;
	}
}