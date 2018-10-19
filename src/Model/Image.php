<?php
/**
 * Created by PhpStorm.
 * User: wilder20
 * Date: 17/10/18
 * Time: 11:07
 */

namespace Model;


class Image
{
    private $imageTMP;
    private $id;
    private $imageName;
    private $imagePath;
    private $imageDate;
    private $imageTags;
    private $imageExtension;
    private $imageSize;
    private $imageError;
    private $imageId;
    
    /**
     * @return mixed
     */
    public function getImageId()
    {
        return $this->imageId;
    }
    
    /**
     * @param mixed $imageId
     */
    public function setImageId($imageId)
    {
        $this->imageId = $imageId;
    }
    
    /**
     * @return mixed
     */
    public function getImageError()
    {
        return $this->imageError;
    }
    
    /**
     * @param mixed $imageError
     */
    public function setImageError($imageError)
    {
        $this->imageError = $imageError;
    }
    
    /**
     * @return mixed
     */
    public function getImageSize()
    {
        return $this->imageSize;
    }
    
    /**
     * @param mixed $imageSize
     */
    public function setImageSize($imageSize)
    {
        $this->imageSize = $imageSize;
    }
    
    
    /**
     * @return mixed
     */
    public function getImageTMP()
    {
        return $this->imageTMP;
    }
    
    /**
     * @param mixed $imageTMP
     */
    public function setImageTMP($imageTMP)
    {
        $this->imageTMP = $imageTMP;
    }
    
    
    /**
     * @return mixed
     */
    public function getImageExtension()
    {
        return $this->imageExtension;
    }
    
    /**
     * @param mixed $imageExtension
     */
    public function setImageExtension($imageExtension)
    {
        $this->imageExtension = $imageExtension;
    }
    
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * @return mixed
     */
    public function getImageName()
    {
        return $this->imageName;
    }
    
    /**
     * @param mixed $imageName
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }
    
    /**
     * @return mixed
     */
    public function getImagePath()
    {
        return $this->imagePath;
    }
    
    /**
     * @param mixed $imagePath
     */
    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;
    }
    
    /**
     * @return mixed
     */
    public function getImageDate()
    {
        return $this->imageDate;
    }
    
    /**
     * @param mixed $imageDate
     */
    public function setImageDate($imageDate)
    {
        $this->imageDate = $imageDate;
    }
    
    /**
     * @return mixed
     */
    public function getImageTags()
    {
        return $this->imageTags;
    }
    
    /**
     * @param mixed $imageTags
     */
    public function setImageTags($imageTags)
    {
        $this->imageTags = $imageTags;
    }
}
