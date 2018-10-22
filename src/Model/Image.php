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
    /**
     * @var
     */
    private $imageTMP;
    /**
     * @var
     */
    private $id;
    /**
     * @var
     */
    private $imageName;
    /**
     * @var
     */
    private $imagePath;
    /**
     * @var
     */
    private $imageDate;
    /**
     * @var
     */
    private $imageTags;
    /**
     * @var
     */
    private $imageExtension;
    /**
     * @var
     */
    private $imageSize;
    /**
     * @var
     */
    private $imageError;
    /**
     * @var
     */
    private $imageId;
    
    
    /**
     * @return int
     */
    public function getImageId():int
    {
        return $this->imageId;
    }
    
    /**
     * @param int $imageId
     */
    public function setImageId(int $imageId)
    {
        $this->imageId = $imageId;
    }
    
    /**
     * @return string
     */
    public function getImageError():string
    {
        return $this->imageError;
    }
    
    /**
     * @param string $imageError
     */
    public function setImageError(string $imageError)
    {
        $this->imageError = $imageError;
    }
    
    /**
     * @return int
     */
    public function getImageSize():int
    {
        return $this->imageSize;
    }
    
    /**
     * @param int $imageSize
     */
    public function setImageSize(int $imageSize)
    {
        $this->imageSize = $imageSize;
    }
    
    /**
     * @return string
     */
    public function getImageTMP():string
    {
        return $this->imageTMP;
    }
    
    /**
     * @param string $imageTMP
     */
    public function setImageTMP(string $imageTMP)
    {
        $this->imageTMP = $imageTMP;
    }
    
    /**
     * @return string
     */
    public function getImageExtension():string
    {
        return $this->imageExtension;
    }
    
    /**
     * @param string $imageExtension
     */
    public function setImageExtension(string $imageExtension)
    {
        $this->imageExtension = $imageExtension;
    }
    
    /**
     * @return int
     */
    public function getId():int
    {
        return $this->id;
    }
    
    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }
    
    /**
     * @return string
     */
    public function getImageName():string
    {
        return $this->imageName;
    }
    
    /**
     * @param string $imageName
     */
    public function setImageName(string $imageName)
    {
        $this->imageName = $imageName;
    }
    
    /**
     * @return string
     */
    public function getImagePath():string
    {
        return $this->imagePath;
    }
    
    /**
     * @param string $imagePath
     */
    public function setImagePath(string $imagePath)
    {
        $this->imagePath = $imagePath;
    }
    
    /**
     * @return \DateTime
     */
    public function getImageDate():\DateTime
    {
        return $this->imageDate;
    }
    
    /**
     * @param \DateTime $imageDate
     */
    public function setImageDate(\DateTime $imageDate)
    {
        $this->imageDate = $imageDate;
    }
    
    /**
     * @return string
     */
    public function getImageTags():string
    {
        return $this->imageTags;
    }
    
    /**
     * @param string $imageTags
     */
    public function setImageTags(string $imageTags)
    {
        $this->imageTags = $imageTags;
    }
}
