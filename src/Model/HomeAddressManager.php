<?php


namespace Model;


class HomeAddressManager extends AbstractManager
{
    const TABLE = 'address';

    public function __construct(\PDO $pdo)
    {
        parent::__construct(self::TABLE, $pdo);
    }

}