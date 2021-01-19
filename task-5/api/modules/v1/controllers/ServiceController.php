<?php

declare(strict_types=1);

namespace api\modules\v1\controllers;

use api\models\search\ServiceSearch;
use backend\services\ServiceServiceInterface;
use common\models\db\RefService;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\rest\IndexAction;
use Yii;

class ServiceController extends ActiveController
{
	const ACTION_INDEX   = 'index';

	/** @var RefService */
	public $modelClass = RefService::class;

	/** @var ServiceServiceInterface */
	private $serviceService;

	public function __construct($id, $module, ServiceServiceInterface $serviceService, $config = [])
	{
		parent::__construct($id, $module, $config);

		$this->serviceService = $serviceService;
	}

	/**
	 * {@inheritDoc}
	 */
	public function actions(): array
	{
		return [
			static::ACTION_INDEX => [
				'class'               => IndexAction::class,
				'modelClass'          => RefService::class,
				'prepareDataProvider' => [$this, 'prepareDataProvider'],
			],
		];
	}

	/**
	 * @return ActiveDataProvider
	 */
	public function prepareDataProvider()
	{
		$searchModel = new ServiceSearch();
		$services = $searchModel->search(Yii::$app->request->queryParams);

		return $services;
	}
}
