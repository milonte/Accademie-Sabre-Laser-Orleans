<?php


namespace Model;

/**
 * Class HomeAddressManager
 *
 */
class HomeAddressManager extends AbstractManager
{
    const TABLE = 'address';

        /**
         * HomeAddressManager constructor.
         * @param \PDO $pdo
         */
        public function __construct(\PDO $pdo)
        {
        parent::__construct(self::TABLE, $pdo);
        }

}