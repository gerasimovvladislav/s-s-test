<?php

declare(strict_types=1);

namespace backend\services;

use backend\exceptions\CityNotFoundException;
use backend\exceptions\ServiceNotFoundException;
use backend\repositories\ServiceRepositoryInterface;
use common\models\db\RefCity;
use common\models\db\RefService;
use Yii;

/**
 * Cервис для услуг.
 *
 * @author Vladislav Gerasimov <gerasim9393@mail.ru>
 */
class ServiceService implements ServiceServiceInterface
{

	/** @var ServiceRepositoryInterface */
	private $serviceRepository;

	public function __construct(ServiceRepositoryInterface $serviceRepository)
	{
		$this->serviceRepository = $serviceRepository;
	}


	/**
	 * @return array
	 */
	public function getAll(): array
	{
		$results = [];

		$results = $this->serviceRepository->getAll();

		return $results;
	}

	/**
	 * Возвращает список услуг в конкретном городе.
	 *
	 * @param int $cityId
	 * @return array
	 * @throws CityNotFoundException
	 */
	public function getByCity(int $cityId): ?array
	{
		print_R($cityId);die();
		if ($city = RefCity::findOne($cityId)) {
			return $this->serviceRepository->getById($city->id);
		}

		throw new CityNotFoundException(Yii::t('backend', "Такого города не существует."));
	}

	/**
	 * Возвращает информацию о конкретной услуге.
	 *
	 * @param int $serviceId
	 * @return array
	 * @throws ServiceNotFoundException
	 */
	public function getInfoById(int $serviceId): array
	{
		if ($city = RefService::findOne($serviceId)) {
			return $city;
		}

		throw new ServiceNotFoundException(Yii::t('backend', "Услуга не найдена."));
	}
}