<?php

//function load_users_data($user_ids) {
//	$user_ids = explode(',', $user_ids);
//	foreach ($user_ids as $user_id) {
//		$db = mysqli_connect("localhost", "root", "123123", "database");
//		$sql = mysqli_query($db, "SELECT * FROM users WHERE id=$user_id");
//		while($obj = $sql->fetch_object()){
//			$data[$user_id] = $obj->name;
//		}
//		mysqli_close($db);
//	}
//	return $data;
//}


/**
 * Получаем данные о пользователях.
 * @param array $ids
 * return UserData[]|array
 */
public function getUsersData(array $ids = []): array
{
	$data = $this->userRepository->getByIds($ids);

	return $data;
}

//P.S.: не совсем понятна задача, т.к. не вижу корректным рефакторить эту функцию - ее стоит просто переписать по-другому ничего не оставляя из этого кода.
// разнести все по функциям/классам
// А если все же рассматривать данный код - то:
// - я бы использовал PDO, а не mysqli
// - стоило вынести коннект к бд за тело цикла
// - нет тайпхинтинга
// - название функции не однозначное
// - стоит данные для доступов вынести в конфиги
// - нет обработки исключений
// - а оно будет/может быть, т.к. $data может не быть

