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
    private $lastname;
    private $firstname;
    private $email;
    private $adress;
    private $postal_code;
    private $city;
    private $phone;
    private $birth_date;
    private $age16;
    private $emergencyContact;
    private $emergencyPhone;
    private $payment;
    private $status;
    
    
    
    
    /**
     * @return mixed
     */
    public function getAdress()
    {
        return $this->adress;
    }
    
    /**
     * @param mixed $adress
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;
    }

    
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
    public function getLastname()
    {
        return $this->lastname;
    }
    
    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }
    
    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }
    
    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
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
    public function getPostalCode()
    {
        return $this->postal_code;
    }
    
    /**
     * @param mixed $postal_code
     */
    public function setPostalCode($postal_code)
    {
        $this->postal_code = $postal_code;
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
        return $this->birth_date;
    }
    
    /**
     * @param mixed $birth_date
     */
    public function setBirthDate($birth_date)
    {
        $this->birth_date = $birth_date;
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

