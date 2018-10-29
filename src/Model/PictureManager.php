<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace Model;


/**
 * Class PictureManager
 * @package Model
 */
class PictureManager extends AbstractManager
{

    const TABLE = 'picture';

    /**
     * PictureManager constructor.
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        parent::__construct(self::TABLE, $pdo);
    }
    
    public function selectAll(): array
    {
        return $this->pdo->query('SELECT * FROM ' . $this->table.' order by id DESC', \PDO::FETCH_CLASS, $this->className)->fetchAll();
    }
    
}
