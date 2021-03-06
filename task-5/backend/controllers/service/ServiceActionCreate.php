<?php

declare(strict_types=1);

namespace backend\controllers\service;

use backend\controllers\ServiceController;
use backend\models\form\ServiceForm;
use backend\views\service\Form_ViewFile;
use common\models\db\RefService;
use yii\base\Action;
use yii\web\Request;
use Yii;

/**
 * Экшн для создания Услуги.
 *
 * @author Vladislav Gerasimov <gerasim9393@mail.ru>
 */
class ServiceActionCreate extends Action
{
	/**
	 * Запуск действия.
	 */
	public function run(Request $request)
	{
		$post = $request->post();

		$service = new RefService();
		$form = new ServiceForm($service);

		if ($form->load($post) && $form->validate()) {
			if (false === $form->save()) {
				Yii::$app->session->addFlash('danger', 'Ошибка при сохранении услуги');
			} else {
				Yii::$app->session->addFlash('success', 'Услуга успешно сохранена');
			}

			return $this->controller->redirect(ServiceController::ACTION_INDEX);
		}

		return $this->controller->renderContent(new Form_ViewFile($form));
	}
}