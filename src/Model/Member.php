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
    private $id;
    private $lastName;
    private $firstName;
    private $email;
    private $address;
    private $postalCode;
    private $city;
    private $phone;
    private $birthDate;
    private $age16;
    private $emergencyContact;
    private $emergencyPhone;
    private $payment;
    private $status;
    
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
    public function getLastName()
    {
        return $this->lastName;
    }
    
    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }
    
    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }
    
    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }
    
    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
    public function getPostalCode()
    {
        return $this->postalCode;
    }
    
    /**
     * @param mixed $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }
    
    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }
    
    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }
    
    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }
    
    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
    
    /**
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }
    
    /**
     * @param mixed $birthDate
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }
    
    /**
     * @return mixed
     */
    public function getAge16()
    {
        return $this->age16;
    }
    
    /**
     * @param mixed $age16
     */
    public function setAge16($age16)
    {
        $this->age16 = $age16;
    }
    
    /**
     * @return mixed
     */
    public function getEmergencyContact()
    {
        return $this->emergencyContact;
    }
    
    /**
     * @param mixed $emergencyContact
     */
    public function setEmergencyContact($emergencyContact)
    {
        $this->emergencyContact = $emergencyContact;
    }
    
    /**
     * @return mixed
     */
    public function getEmergencyPhone()
    {
        return $this->emergencyPhone;
    }
    
    /**
     * @param mixed $emergencyPhone
     */
    public function setEmergencyPhone($emergencyPhone)
    {
        $this->emergencyPhone = $emergencyPhone;
    }
    
    /**
     * @return mixed
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
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }
    
    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
    
    
    
}