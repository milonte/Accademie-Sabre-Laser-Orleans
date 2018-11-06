<?php

namespace Model;

use GuzzleHttp\Client;

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

    /**
     * Get adresse informations
     *
     * @param string $address
     * @return array
     */
    public function getAdressInfos(string $address): array
    {
        $uri = 'https://api-adresse.data.gouv.fr/search/?q=' . urlencode($address) . '&autocomplete=0';
        $client = new Client();
        $response = $client->request('GET', $uri);
        $body = $response->getBody();
        $addresses = json_decode($body->getContents(), true);

        return $addresses;
    }

    /**
     * @param Address $address
     * @return int
     */
    public function update(Address $address): int
    {
        $statement = $this->pdo->prepare(
            "UPDATE "
            . $this->table
            . " SET `gym_name` = :gym_name,"
            . " `gym_address` = :gym_address,"
            . " `city` = :city,"
            . " `zip_code` = :zip_code,"
            . " `date_info` = :date_info,"
            . " `schedule_info` = :schedule_info"
            . " WHERE id=:id"
        );
        $statement->bindValue('id', $address->getId(), \PDO::PARAM_INT);
        $statement->bindValue('gym_name', $address->getGymName(), \PDO::PARAM_STR);
        $statement->bindValue('gym_address', $address->getGymAddress(), \PDO::PARAM_STR);
        $statement->bindValue('city', $address->getCity(), \PDO::PARAM_STR);
        $statement->bindValue('zip_code', $address->getZipCode(), \PDO::PARAM_STR);
        $statement->bindValue('date_info', $address->getDateInfo(), \PDO::PARAM_STR);
        $statement->bindValue('schedule_info', $address->getScheduleInfo(), \PDO::PARAM_STR);

        return $statement->execute();
    }
}
