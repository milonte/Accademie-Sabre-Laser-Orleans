<?php
/**
 * Created by PhpStorm.
 * User: wcs
 * Date: 23/10/17
 * Time: 10:57
 * PHP version 7
 */

namespace Model;

/**
 * Class Address
 *
 */
class Address
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */

    private $gymName;
    /**
     * @var string
     */
    private $gymAddress;
    /**
     * @var string
     */
    private $city;
    /**
     * @var string
     */
    private $zipCode;
    /**
     * @var string
     */
    private $dateInfo;
    /**
     * @var string
     */
    private $scheduleInfo;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getGymName(): string
    {
        return $this->gymName;
    }

    /**
     * @param string $gymName
     */
    public function setGymName(string $gymName)
    {
        $this->gymName = $gymName;
    }

    /**
     * @return string
     */
    public function getGymAddress(): string
    {
        return $this->gymAddress;
    }

    /**
     * @param string $gymAddress
     */
    public function setGymAddress(string $gymAddress)
    {
        $this->gymAddress = $gymAddress;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     */
    public function setZipCode(string $zipCode)
    {
        $this->zipCode = $zipCode;
    }

    /**
     * @return string
     */
    public function getDateInfo(): string
    {
        return $this->dateInfo;
    }

    /**
     * @param string $dateInfo
     */
    public function setDateInfo(string $dateInfo)
    {
        $this->dateInfo = $dateInfo;
    }

    /**
     * @return string
     */
    public function getScheduleInfo(): string
    {
        return $this->scheduleInfo;
    }

    /**
     * @param string $scheduleInfo
     */
    public function setScheduleInfo(string $scheduleInfo)
    {
        $this->scheduleInfo = $scheduleInfo;
    }
}