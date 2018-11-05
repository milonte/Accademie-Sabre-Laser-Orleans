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
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (title,content,image_url,link_url,date) VALUES (:title, :content, :imageUrl, :linkUrl, :date)");
        $statement->bindValue('title', $event->getTitle(), \PDO::PARAM_STR);
        $statement->bindValue('content', $event->getContent(), \PDO::PARAM_STR);
        $statement->bindValue('imageUrl', $event->getImageUrl(), \PDO::PARAM_STR);
        $statement->bindValue('linkUrl', $event->getLinkUrl(), \PDO::PARAM_STR);
        $statement->bindValue('date', $event->getDate()->format("d/m/y"), \PDO::PARAM_STR);
        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
    }
}
