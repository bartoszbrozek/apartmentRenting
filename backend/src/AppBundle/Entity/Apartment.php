<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Apartment
 *
 * @ORM\Entity
 * @ORM\Table(name="apartment")
 */
class Apartment
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberofrooms;

    /**
     * @ORM\Column(type="integer")
     */
    private $maxnumberofplaces;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberofreservedplaces;

    /**
     * @ORM\Column(type="integer")
     */
    private $gender;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getNumberOfRooms()
    {
        return $this->numberofrooms;
    }

    /**
     * @param mixed $numberofrooms
     */
    public function setNumberOfRooms($numberofrooms)
    {
        $this->numberofrooms = $numberofrooms;
    }

    /**
     * @return mixed
     */
    public function getMaxNumberOfPlaces()
    {
        return $this->maxnumberofplaces;
    }

    /**
     * @param mixed $maxnumberofplaces
     */
    public function setMaxNumberOfPlaces($maxnumberofplaces)
    {
        $this->maxnumberofplaces = $maxnumberofplaces;
    }

    /**
     * @return mixed
     */
    public function getNumberOfReservedPlaces()
    {
        return $this->numberofreservedplaces;
    }

    /**
     * @param mixed $numberofreservedplaces
     */
    public function setNumberOfReservedPlaces($numberofreservedplaces)
    {
        $this->numberofreservedplaces = $numberofreservedplaces;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }



}
