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
    /**
     *item
     */
    const TABLE = 'member';
    
    /**
     *  Initializes this class.
     */
    public function __construct(\PDO $pdo)
    {
        parent::__construct(self::TABLE, $pdo);
    }
    
    
    /**
     * @param Item $item
     * @return int
     */
    public function insert(Member $member): int
    {
        $statement = $this->pdo->prepare("INSERT INTO $this->table  (lastname, firstname, email, adress, postal_code, city, phone, birth_date, age16, emergency_contact, emergency_phone, payment, status)
VALUES (:firstname, :lastname, :email, :adress, :postal_code,:city, :phone, :birth_date, :age16, :emergency_contact, :emergency_phone, :payment, 'pending')");
        $statement->bindValue('firstname', $member->getFirstname(), \PDO::PARAM_STR);
        $statement->bindValue('lastname', $member->getLastname(), \PDO::PARAM_STR);
        $statement->bindValue('email', $member->getEmail(), \PDO::PARAM_STR);
        $statement->bindValue('adress', $member->getAddress(), \PDO::PARAM_STR);
        $statement->bindValue('postal_code', $member->getPostalCode(), \PDO::PARAM_INT);
        $statement->bindValue('city', $member->getCity(), \PDO::PARAM_STR);
        $statement->bindValue('phone', $member->getPhone(), \PDO::PARAM_INT);
        $statement->bindValue('birth_date', $member->getBirthDate(), \PDO::PARAM_STR);
        $statement->bindValue('age16', $member->getAge16(), \PDO::PARAM_STR);
        $statement->bindValue('emergency_contact', $member->getEmergencyContact(), \PDO::PARAM_STR);
        $statement->bindValue('emergency_phone', $member->getEmergencyPhone(), \PDO::PARAM_INT);
        $statement->bindValue('payment', $member->getPayment(), \PDO::PARAM_INT);
        
        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
    }
    
    
    /**
     * @param int $id
     */
    public function delete(int $id): void
    {

        $statement = $this->pdo->prepare("DELETE FROM $this->table WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
    
    
    /**
     * @param Item $item
     * @return int
     */
    public function update(Item $item):int
    {
        
        $statement = $this->pdo->prepare("UPDATE $this->table SET `title` = :title WHERE id=:id");
        $statement->bindValue('id', $item->getId(), \PDO::PARAM_INT);
        $statement->bindValue('title', $item->getTitle(), \PDO::PARAM_STR);
        
        
        return $statement->execute();
    }
}
