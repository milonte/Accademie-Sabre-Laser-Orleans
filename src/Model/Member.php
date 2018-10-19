<?php
/**
 * Created by PhpStorm.
 * User: wilder20
 * Date: 10/10/18
 * Time: 16:17
 */

namespace Model;

class Member
{
    /**
     * @var int
     */
    private $id;
    
    /**
     * @var string
     */
    private $lastName;
    
    /**
     * @var string
     */
    private $firstName;
    
    /**
     * @var string
     */
    private $email;
    
    /**
     * @var string
     */
    private $address;
    
    /**
     * @var string
     */
    private $postalCode;
    
    /**
     * @var string
     */
    private $city;
    
    /**
     * @var int
     */
    private $phone;
    
    /**
     * @var \DateTime
     */
    private $birthDate;
    
    /**
     * @var string
     */
    private $age16;
    
    /**
     * @var string
     */
    private $emergencyContact;
    
    /**
     * @var int
     */
    private $emergencyPhone;
    
    /**
     * @var mixed
     */
    private $payment;
    
    /**
     * @var string
     */
    private $status;
    
    /**
     * @return int
     */
    public function getId()
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
    public function getLastName()
    {
        return $this->lastName;
    }
    
    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }
    
    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }
    
    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }
    
    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }
    
    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }
    
    /**
     * @param string $address
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
    }
    
    /**
     * @return int
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }
    
    /**
     * @param string $postalCode
     */
    public function setPostalCode(string $postalCode)
    {
        $this->postalCode = $postalCode;
    }
    
    /**
     * @return string
     */
    public function getCity()
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
     * @return int
     */
    public function getPhone()
    {
        return $this->phone;
    }
    
    /**
     * @param int $phone
     */
    public function setPhone(int $phone)
    {
        $this->phone = $phone;
    }
    
    /**
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }
    
    /**
     * @param \DateTime $birthDate
     */
    public function setBirthDate(\DateTime $birthDate)
    {
        $this->birthDate = $birthDate;
    }
    
    /**
     * @return string
     */
    public function getAge16()
    {
        return $this->age16;
    }
    
    /**
     * @param string $age16
     */
    public function setAge16(string $age16)
    {
        $this->age16 = $age16;
    }
    
    /**
     * @return string
     */
    public function getEmergencyContact()
    {
        return $this->emergencyContact;
    }
    
    /**
     * @param string $emergencyContact
     */
    public function setEmergencyContact(string $emergencyContact)
    {
        $this->emergencyContact = $emergencyContact;
    }
    
    /**
     * @return int
     */
    public function getEmergencyPhone()
    {
        return $this->emergencyPhone;
    }
    
    /**
     * @param int $emergencyPhone
     */
    public function setEmergencyPhone(int $emergencyPhone)
    {
        $this->emergencyPhone = $emergencyPhone;
    }
    
    /**
     * @return int
     */
    public function getPayment()
    {
        return $this->payment;
    }
    
    /**
     * @param mixed $payment
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;
    }
    
    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
    
    /**
     * @param string $status
     */
    public function setStatus(string $status)
    {
        $this->status = $status;
    }
    
    
    
}