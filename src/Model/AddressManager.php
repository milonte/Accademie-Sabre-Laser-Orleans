<?php


namespace Model;

/**
 * Class AddressManager
 *
 */
class AddressManager extends AbstractManager
{
        const TABLE = 'address';

        /**
         * AddressManager constructor.
         * @param \PDO $pdo
         */
        public function __construct(\PDO $pdo)
        {
        parent::__construct(self::TABLE, $pdo);
        }

        public function update(Address $address):int
        {
            $statement = $this->pdo->prepare("UPDATE ". $this->table ." SET `gym_name` = :gym_name, `gym_address` = :gym_address, `city` = :city, `zip_code` = :zip_code, `date_info` = :date_info, `schedule_info` = :schedule_info WHERE id=:id");
            $statement->bindValue('id', $address->getId(), \PDO::PARAM_INT);
            $statement->bindValue('gym_name', $address->getGymName(), \PDO::PARAM_STR);
            $statement->bindValue('gym_address', $address->getGymAddress(), \PDO::PARAM_STR);
            $statement->bindValue('city', $address->getCity(), \PDO::PARAM_INT);
            $statement->bindValue('zip_code', $address->getZipCode(), \PDO::PARAM_STR);
            $statement->bindValue('date_info', $address->getDateInfo(), \PDO::PARAM_STR);
            $statement->bindValue('schedule_info', $address->getScheduleInfo(), \PDO::PARAM_STR);


            return $statement->execute();
        }

}