<?php

declare(strict_types=1);

namespace backend\controllers\service;

use backend\models\search\ServiceSearch;
use backend\views\service\Index_ViewFile;
use yii\base\Action;
use yii\web\Request;

/**
 * Экшн главной страницы раздела Услуг.
 *
 * @author Vladislav Gerasimov <gerasim9393@mail.ru>
 */
class ServiceActionIndex extends Action
{
	/**
	 * Запуск действия.
	 *
	 * @return string
	 */
	public function run(Request $request): string
	{
		$param = $request->getQueryParams();

		$searchModel = new ServiceSearch();
		$dataProvider = $searchModel->search($param);

		return $this->controller->renderContent(new Index_ViewFile($searchModel, $dataProvider));
	}
}