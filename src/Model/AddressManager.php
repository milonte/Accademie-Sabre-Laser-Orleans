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

}