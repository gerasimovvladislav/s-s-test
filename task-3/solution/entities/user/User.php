<?php

declare(strict_types=1);

namespace app\entities\user;

use app\entities\user\fields\Id;
use app\entities\user\fields\Name;

/**
 * Класс сущности Пользователь.
 *
 * @author Vladislav Gerasimov <gerasim9393@mail.ru>
 */
class User
{
	/** @var Id Идентификатор пользователя. */
	private $id;

	/** @var Name Объект имени пользователи. */
	private $name;

	public function __construct(Id $id, Name $name)
	{
		$this->id = $id;
		$this->name = $name;
	}
}