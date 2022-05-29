<?php

namespace Tlait\CarForRent\Service;

use Ramsey\Uuid\Uuid;
use Tlait\CarForRent\Model\Car;
use Tlait\CarForRent\Repository\CarRepository;
use Tlait\CarForRent\Transfer\CarTransfer;

class CarService
{
    private CarRepository $carRepository;

    /**
     * @param CarRepository $carRepository
     */
    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function createCar(CarTransfer $carTransfer): ?Car
    {
        $uuid = Uuid::uuid4();
        $payload = [
            $uuid,
            $carTransfer->getName(),
            $carTransfer->getDescription(),
            $carTransfer->getPrice(),
            $carTransfer->getImg()
        ];
        if (!$this->carRepository->insertCar($payload)) {
            return null;
        }
        $car = new Car();
        $car->setId($uuid);
        $car->setName($carTransfer->getName());
        $car->setDescription($carTransfer->getDescription());
        $car->setPrice($carTransfer->getPrice());
        $car->setImg($carTransfer->getImg());

        return $car;
    }

    public function getCars()
    {
        return $this->carRepository->selectCards();
    }
}
