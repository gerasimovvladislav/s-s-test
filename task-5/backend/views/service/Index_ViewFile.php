<?php

declare(strict_types=1);

namespace backend\views\service;

use backend\controllers\ServiceController;
use backend\models\form\ServiceForm;
use backend\models\search\ServiceSearch;
use common\models\db\RefService;
use common\yii\ViewFile;
use yii\bootstrap\Html;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;
use Yii;

/**
 * Список услуг.
 */
class Index_ViewFile extends ViewFile
{
	/**
	 * @param ServiceSearch $searchModel Модель поиска услуг
	 * @param ActiveDataProvider $dataProvider Провайдер услуг
	 */
	public function __construct(ServiceSearch $searchModel, ActiveDataProvider $dataProvider)
	{
		$this->renderer = function() use ($searchModel, $dataProvider) {
?>
<div>
	<div class="container">
        <p>
			<?= Html::a('Добавить услугу', [ServiceController::ACTION_CREATE], ['class' => 'btn btn-success']) ?>
        </p>
		<?php echo GridView::widget([
			'dataProvider' => $dataProvider,
			'filterModel'  => $searchModel,
			'columns' => [
				RefService::ATTR_NAME,
				RefService::ATTR_DESCRIPTION,
				RefService::ATTR_CODE,
				[
					'attribute' => RefService::ATTR_CITY_ID,
					'value'     => function(RefService $service) {
		                $city = $service->getCity();

						return $city ? Html::encode($city->name) : "---";
					},
				],
				[
					'attribute' => RefService::ATTR_STATUS,
					'value'     => function(RefService $service) {
						return ServiceForm::STATUSES[$service->status] ?? "---";
					},
				],
				[
					'attribute' => RefService::ATTR_DELETED_AT,
					'value'     => function(RefService $service) {
						return $service->deleted_at ? "Да" : "Нет";
					},
				],
				[
					'class' => ActionColumn::class,
					'template' => '{update} {delete}',
					'buttons' => [
						'update' => function ($url, RefService $model) {
							$icon = Html::tag('span', '', ['class' => 'glyphicon glyphicon-pencil']);

							return Html::a(
								$icon,
								Url::to([ServiceController::ACTION_UPDATE, RefService::ATTR_ID => $model->id]),
								['title' => 'Редактировать']
							);
						},
						'delete' => function ($url, RefService $model) {
							$icon = Html::tag('span', '', ['class' => 'glyphicon glyphicon-trash']);

							return Html::a($icon, Url::to([ServiceController::ACTION_DELETE, RefService::ATTR_ID => $model->id]), [
								'title' => 'Удалить',
								'data-confirm' => 'Вы уверены, что хотите удалить эту услугу?',
								'data-method' => 'post',
								'data-pjax' => '0',
							]);
						},
					],
				],
			],
		]); ?>
	</div>
</div>
<?php
		};
	}
}