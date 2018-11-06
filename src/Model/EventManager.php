<?php

/**
 * Created by Milon Teddy.
 * User: milonte
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace Model;

/**
 * class EventManager
 */
class EventManager extends AbstractManager
{
    /**
     * const TABLE :string
     */
    const TABLE = 'event';

    /**
     *  Initializes this class.
     */
    public function __construct(\PDO $pdo)
    {
        parent::__construct(self::TABLE, $pdo);
    }
 
    /**
     * Insert an event into database
     * @param $event :Event
     * @return $this->pdo->lastInsterId :int
     */
    public function insert(Event $event): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " .
        self::TABLE . " (title,content,image_url,link_url,date, viewed) VALUES (:title, :content, :imageUrl, :linkUrl, :date, :viewed)");
        $statement->bindValue('title', $event->getTitle(), \PDO::PARAM_STR);
        $statement->bindValue('content', $event->getContent(), \PDO::PARAM_STR);
        $statement->bindValue('imageUrl', $event->getImageUrl(), \PDO::PARAM_STR);
        $statement->bindValue('linkUrl', $event->getLinkUrl(), \PDO::PARAM_STR);
        $statement->bindValue('date', $event->getDate()->format("d/m/y"), \PDO::PARAM_STR);
        $statement->bindValue('viewed', $event->isViewed(), \PDO::PARAM_INT);
        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
    }
  
    /**
     * @param Event $event
     * @return int
     */
    public function updateViewed(Event $event): int
    {
        $statement = $this->pdo->prepare("UPDATE $this->table SET `viewed` = :viewed WHERE id= :id");
        $statement->bindValue('id', $event->getId(), \PDO::PARAM_INT);
        $statement->bindValue('viewed', !$event->isViewed(), \PDO::PARAM_BOOL);
        return $statement->execute();
    }

    /**
     * @return array
     */
    public function selectViewed() :array
    {
        $statement = $this->pdo->query("SELECT * FROM $this->table WHERE viewed = 1");
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        return $statement->fetchAll();
    }
}
