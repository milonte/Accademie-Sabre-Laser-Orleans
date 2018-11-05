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
    public function getAdressInfos(string $address) :array
    {
        $uri = 'https://api-adresse.data.gouv.fr/search/?q=' . urlencode($address) . '&autocomplete=0';
        $client = new Client();
        $response = $client->request('GET', $uri);
        $body = $response->getBody();
        $addresses = json_decode($body->getContents(), true);

        return $addresses;
        
    }
}