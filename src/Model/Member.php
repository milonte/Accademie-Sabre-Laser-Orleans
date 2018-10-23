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
     * @var string
     */
    private $phone;
    
    
    /**
     * @var \DateTime
     */
    private $birthDate;
    
    
    /**
     * @var string
     */
    private $emergencyContact;
    
    
    /**
     * @var string
     */
    private $emergencyPhone;
    
    
    /**
     * @var int
     */
    private $payment;
    
    
    /**
     * @var string
     */
    private $status;
    
    
    /**
     * @return int
     */
    public function getId() :int
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
    public function getLastName() :string
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
    public function getFirstName() :string
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
    public function getEmail() :string
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
    public function getAddress() :string
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
     * @return string
     */
    public function getPostalCode() :string
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
    public function getCity() :string
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
    public function getPhone() :string
    {
        return $this->phone;
    }
    
    
    /**
     * @param string $phone
     */
    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }
    
    
    /**
     * @return \DateTime
     */
    public function getBirthDate() :\DateTime
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
    public function getEmergencyContact() :string
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
     * @return string
     */
    public function getEmergencyPhone() :string
    {
        return $this->emergencyPhone;
    }
    
    
    /**
     * @param string $emergencyPhone
     */
    public function setEmergencyPhone(string $emergencyPhone)
    {
        $this->emergencyPhone = $emergencyPhone;
    }
    
    
    /**
     * @return int
     */
    public function getPayment() :int
    {
        return $this->payment;
    }
    
    
    /**
     * @param int $payment
     */
    public function setPayment(int $payment)
    {
        $this->payment = $payment;
    }
    
    
    /**
     * @return string
     */
    public function getStatus() :string
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
