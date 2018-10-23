<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 19/10/18
 * Time: 14:26
 */

namespace Model;


class Picture
{
    private $id;

    private $pictureName;

    private $picturePath;

    private $pictureDate;

    private $pictureTag;

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

    /**
     * @return mixed
     */
    public function getPictureTag() :string
    {
        return $this->pictureTag;
    }

    /**
     * @param mixed $pictureTag
     */
    public function setPictureTag(string $pictureTag)
    {
        $this->pictureTag = $pictureTag;
    }


}
