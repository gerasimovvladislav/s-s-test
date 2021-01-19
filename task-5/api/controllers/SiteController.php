<?php

declare(strict_types=1);

namespace api\controllers;

use HttpException;
use Yii;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class SiteController extends Controller
{
	/**
	 * @return mixed
	 */
	public function actionIndex(): Response
	{
		return $this->asJson([]);
	}

	/**
	 * @return mixed
	 */
	public function actionError()
	{
		$exception = Yii::$app->getErrorHandler()->exception;
		if (null === $exception) {
			$exception = new NotFoundHttpException('Страница не найдена.');
		}

		if ($exception instanceof HttpException) {
			Yii::$app->response->setStatusCode($exception->getCode());
		}
		else {
			Yii::$app->response->setStatusCode(500);
		}

		return $this->asJson([
			'error' => $exception->getMessage(),
			'code'  => $exception->getCode(),
		]);
	}
}
