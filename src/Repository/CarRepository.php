<?php

namespace Tlait\CarForRent\Repository;

use PDO;
use Tlait\CarForRent\Model\Car;

class CarRepository extends AbstractRepository
{
    /**
     * @param $payload
     * @return bool
     */
    public function insertCar($payload): bool
    {
        $carInserted = $this->getConnection()->prepare("INSERT INTO car(id, name, description, price, img) VALUES (?,?,?,?,?)");
        return $carInserted->execute($payload);
    }

    /**
     * @return array|null
     */
    public function selectCards(): ?array
    {
        $carSelected = $this->getConnection()->prepare("SELECT * FROM `car`");
        $carSelected->execute();
        $row = $carSelected->fetchAll(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }
        $carArray = [];
        foreach ($row as $index => $carData) {
            $car = new Car();
            $car->setId($carData['id']);
            $car->setName($carData['name']);
            $car->setDescription($carData['description']);
            $car->setPrice($carData['price']);
            $car->setImg($carData['img']);
            array_push($carArray, $car);
        }
        return $carArray;
    }
}
