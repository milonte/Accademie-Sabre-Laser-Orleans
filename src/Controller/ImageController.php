<?php
/**
 * Created by PhpStorm.
 * User: wilder20
 * Date: 17/10/18
 * Time: 10:59
 */

namespace Controller;


use Model\Image;
use Model\ImageManager;

class ImageController extends AbstractController
{

    const AUTH_EXT = ['jpg', 'jpeg', 'png', 'gif'];
    const DIR_UPLOAD = 'assets/images';
    
    
    private function imageVerification(Image $image)
    {
        $errors = [];
    
        if (!in_array($image->getImageExtension(), self::AUTH_EXT)) {
            $errors[] = "[{$image->getImageName()}] file extension ".$image->getImageExtension()." is not allowed";
        }
    
        if ($image->getImageError() != 0) {
            $errors[] = "[{$image->getImageName()}] errored with code {$image->getImageError()}";
        }
    
        if ($image->getImageSize() > 2097152) {
            $errors[] = "[{$image->getImageName()}] is too large.";
        }
    
        return $errors;
    }
    
    
    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function add ()
    {
    
        $uploaded = [];
        $errorsGlobal = [];
        if (!empty($_FILES['images']['name'][0])) {
            $files = $_FILES['images'];
            
            foreach ($files['name'] as $position => $fileName) {
                
                $fileDate=new \DateTime();
                $fileExt = explode('.', $fileName);
                $fileExt = strtolower(end($fileExt));
                
                $image = new Image();
                $image->setImageName($files['name'][$position]);
                $image->setImageTMP($files['tmp_name'][$position]);
                $image->setImageSize($files['size'][$position]);
                $image->setImageError($files['error'][$position]);
                $image->setImageDate($fileDate);
                $image->setImageExtension($fileExt);
                
                if (!empty(self::imageVerification($image))) {
                    foreach (self::imageVerification($image) as $key => $value) {
                        $errorsGlobal[]=$value;
                    }
                } else {
                    
                    $fileNameNew = "image" . uniqid('', true) . '.' . $image->getImageExtension();

                    $fileDestination = self::DIR_UPLOAD . '/' . $fileNameNew;
                    
                    if (move_uploaded_file($image->getImageTMP(), $fileDestination)) {
        
                        $uploaded[$position] = $fileDestination;
        
                        $imageManager = new ImageManager($this->getPdo());
                        
                        $image->setImageName($fileNameNew);
                        $image->setImagePath($fileDestination);
                        
                        $id = $imageManager->insert($image);
                        $image->setImageId($id);
                        header('Location:/admin/addImage');
                        
                    }
                }
            }
        }
        
        return $this->twig->render('Admin/adminGalleryAddImage.html.twig', ['errors' => $errorsGlobal]);
    }
    

    
}
