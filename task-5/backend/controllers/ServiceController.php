<?php

declare(strict_types=1);

namespace backend\controllers;

use backend\controllers\service\ServiceActionCreate;
use backend\controllers\service\ServiceActionDelete;
use backend\controllers\service\ServiceActionIndex;
use backend\controllers\service\ServiceActionUpdate;
use backend\models\search\ServiceSearch;
use common\models\db\RefService;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\filters\AccessControl;
use Yii;

/**
 * Контроллер раздела Услуги.
 *
 * @author Vladislav Gerasimov <gerasim9393@mail.ru>
 */
class ServiceController extends Controller
{
	public const ACTION_INDEX = 'index';
	public const ACTION_CREATE = 'create';
	public const ACTION_UPDATE = 'update';
	public const ACTION_DELETE = 'delete';

	/**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                        	static::ACTION_INDEX,
							static::ACTION_CREATE,
							static::ACTION_UPDATE,
							static::ACTION_DELETE,
						],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
			'verbs' => [
				'class' => VerbFilter::class,
				'actions' => [
					static::ACTION_DELETE => ['POST'],
				],
			],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        $actions = [
			static::ACTION_INDEX => ServiceActionIndex::class,
			static::ACTION_CREATE => ServiceActionCreate::class,
			static::ACTION_UPDATE => ServiceActionUpdate::class,
			static::ACTION_DELETE => ServiceActionDelete::class,
        ];

		return $actions;
    }
}
