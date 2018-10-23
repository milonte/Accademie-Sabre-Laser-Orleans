<?php
/**
 * Created by PhpStorm.
 * User: wilder20
 * Date: 10/10/18
 * Time: 17:01
 */

namespace Model;

class MemberManager extends AbstractManager
{

    const TABLE = 'member';
    
    /**
     *  Initializes this class.
     */
    public function __construct(\PDO $pdo)
    {
        parent::__construct(self::TABLE, $pdo);
    }
    
    
    /**
     * @param Member $member
     * @return int
     */
    public function insert(Member $member): int
    {
        $statement = $this->pdo->prepare("INSERT INTO $this->table  (lastname, firstname, email, adress, postal_code, city, phone, birth_date,emergency_contact, emergency_phone, payment, status)
VALUES (:firstname, :lastname, :email, :adress, :postal_code,:city, :phone, :birth_date, :emergency_contact, :emergency_phone, :payment, 'pending')");
        $statement->bindValue('firstname', $member->getFirstname(), \PDO::PARAM_STR);
        $statement->bindValue('lastname', $member->getLastname(), \PDO::PARAM_STR);
        $statement->bindValue('email', $member->getEmail(), \PDO::PARAM_STR);
        $statement->bindValue('adress', $member->getAddress(), \PDO::PARAM_STR);
        $statement->bindValue('postal_code', $member->getPostalCode(), \PDO::PARAM_STR);
        $statement->bindValue('city', $member->getCity(), \PDO::PARAM_STR);
        $statement->bindValue('phone', $member->getPhone(), \PDO::PARAM_STR);
        $statement->bindValue('birth_date', $member->getBirthDate()->format('Y-m-d'), \PDO::PARAM_STR);
        $statement->bindValue('emergency_contact', $member->getEmergencyContact(), \PDO::PARAM_STR);
        $statement->bindValue('emergency_phone', $member->getEmergencyPhone(), \PDO::PARAM_STR);
        $statement->bindValue('payment', $member->getPayment(), \PDO::PARAM_INT);
        
        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
    }
}
