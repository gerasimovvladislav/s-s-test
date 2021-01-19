<?php

declare(strict_types=1);

namespace backend\controllers\service;

use backend\controllers\ServiceController;
use backend\models\form\ServiceForm;
use common\models\db\RefService;
use yii\base\Action;
use Yii;

/**
 * Экшн для удаления Услуги.
 *
 * @author Vladislav Gerasimov <gerasim9393@mail.ru>
 */
class ServiceActionDelete extends Action
{
	/**
	 * Запуск действия.
	 */
	public function run(int $id)
	{
		$model = RefService::findOne($id);
		$form = new ServiceForm($model);

		if ($form->delete()) {
			Yii::$app->session->addFlash('success', 'Услуга успешно удалена');
		} else {
			foreach ($model->getErrors() as $error) {
				Yii::$app->session->addFlash('error', array_shift($error));
			}
		}

		return $this->controller->redirect(ServiceController::ACTION_INDEX);
	}
}