<?php
/**
 * Created by PhpStorm.
 * User: wilder20
 * Date: 17/10/18
 * Time: 11:05
 */

namespace Model;


class ImageManager extends AbstractManager
{
    const TABLE = 'image';
    
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
    public function insert(Image $image): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table (image_name, image_path, image_date) VALUES (:image_name, :image_path, :image_date)");
        $statement->bindValue('image_name', $image->getImageName(), \PDO::PARAM_STR);
        $statement->bindValue('image_path', $image->getImagePath(), \PDO::PARAM_STR);
        $statement->bindValue('image_date', $image->getImageDate(), \PDO::PARAM_STR);
        //$statement->bindValue('image_tags', $image->getImageTags(), \PDO::PARAM_STR);
        
        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
    }
    
    
    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM $this->table WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
    
    
    /**
     * @param Item $item
     * @return int
     */
    public function update(Item $item): int
    {
        
        // prepared request
        $statement = $this->pdo->prepare("UPDATE $this->table SET `title` = :title WHERE id=:id");
        $statement->bindValue('id', $item->getId(), \PDO::PARAM_INT);
        $statement->bindValue('title', $item->getTitle(), \PDO::PARAM_STR);
        
        
        return $statement->execute();
    }
    
    public function selectAll(): array
    {
        return $this->pdo->query('SELECT * FROM ' . $this->table.' order by image_date DESC', \PDO::FETCH_CLASS, $this->className)->fetchAll();
    }
}