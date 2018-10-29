<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 19/10/18
 * Time: 14:26
 */

namespace Model;

/**
 * Class Picture
 * @package Model
 */
class Picture
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $pictureName;

    /**
     * @var string
     */
    private $picturePath;

    /**
     * @var \DateTime
     */
    private $pictureDate;

    /**
     * @return mixed
     */
    public function getId() :int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPictureName() :string
    {
        return $this->pictureName;
    }

    /**
     * @param mixed $pictureName
     */
    public function setPictureName(string $pictureName)
    {
        $this->pictureName = $pictureName;
    }

    /**
     * @return mixed
     */
    public function getPicturePath() :string
    {
        return $this->picturePath;
    }

    /**
     * @param mixed $picturePath
     */
    public function setPicturePath(string $picturePath)
    {
        $this->picturePath = $picturePath;
    }

    /**
     * @return mixed
     */
    public function getPictureDate() :\DateTime
    {
        return $this->pictureDate;
    }

    /**
     * @param mixed $pictureDate
     */
    public function setPictureDate(\DateTime $pictureDate)
    {
        $this->pictureDate = $pictureDate;
    }
}
