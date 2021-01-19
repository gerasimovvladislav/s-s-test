<?php

declare(strict_types=1);

namespace console\controllers;

use app\models\form\SignUp;
use common\models\User;
use yii\console\Controller;
use yii\helpers\Console;
use yii\helpers\Json;

/**
 * Class UserController
 * @author Vladislav Gerasimov <gerasim9393@mail.ru>
 */
class UserController extends Controller
{
	/**
	 * Запускает процесс создания пользователя
	 * @return int
	 * @throws \yii\base\Exception
	 */
	public function actionSignUp()
	{
		$this->stdout("Create user \n");
		$this->stdout("Username [webmaster]:");
		$user_name = Console::stdin();
		$this->stdout("Password [webmaster]:");
		$password = Console::stdin();
		$this->stdout("Email [webmaster@example.com]:");
		$email = Console::stdin();
		if (!$user_name) {
			$user_name = 'webmaster';
		}
		if (!$password) {
			$password = 'webmaster';
		}
		if (!$email) {
			$email = 'webmaster@example.com';
		}

		$user = new User();
		$user->username = $user_name;
		$user->email = $email;
		$user->status = User::STATUS_ACTIVE;
		$user->setPassword($password);
		$user->generateAuthKey();

		if ($user->save()) {
			$this->stdout("RefUser " . $user->username . " created! \n");
			return 0;
		}
		$this->stdout(Json::encode($user->getFirstErrors(), JSON_PRETTY_PRINT) . "\n");
		return 1;
	}
}