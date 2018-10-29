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
    
    /**

     * @return array
     */
    public function selectAll(): array
    {
        return $this->pdo->query('SELECT * FROM ' . $this->table.' order by id DESC', \PDO::FETCH_CLASS, $this->className)->fetchAll();
    }
    

     * @param Picture $picture
     * @return int
     */
    public function insert(Picture $picture): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table (picture_name, picture_path, picture_date) VALUES (:picture_name, :picture_path, :picture_date)");
        $statement->bindValue('picture_name', $picture->getPictureName(), \PDO::PARAM_STR);
        $statement->bindValue('picture_path', $picture->getPicturePath(), \PDO::PARAM_STR);
        $statement->bindValue('picture_date', $picture->getPictureDate()->format('Y-m-d H:i:s'), \PDO::PARAM_STR);
        
        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
    }
}
