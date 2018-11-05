<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 19/10/18
 * Time: 09:44
 */

namespace Controller;

use Model\PictureManager;
use Model\Picture;

/**
 * Class PictureController
 * @package Controller
 */
class PictureController extends AbstractController
{
    const AUTH_EXT = ['image/gif', 'image/jpeg', 'image/png'];
    const DIR_UPLOAD = 'assets/images/gallery';
    
    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index()
    {
        $galleryManager = new PictureManager($this->getPdo());
        $pictures = $galleryManager->selectAll();
        
        return $this->twig->render('Picture/index.html.twig', ['pictures' => $pictures]);
    }
    
    /**
     * @param $file
     * @return array
     */
    private function pictureVerification($file)
    {
        $errors = [];
        
        if (!in_array($file['type'], self::AUTH_EXT)) {
            $errors[] = $file['name'] . " L'extension n'est pas autorisée. Les extensions autorisées sont les suivantes: .jpg / .jpeg / .gif and .png";
        }
        
        if ($file['error'] != 0) {
            $errors[] = $file['name'] . "Le système a rencontré une erreur lors de l'upload de votre image. le code de l'erreur est " . $file['error'];
        }
        
        if ($file['size'] > 2097152) {
            $errors[] = $file['name'] . " La taille du fichier est trop grande.";
        }
        
        return $errors;
    }
    
    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function indexAdmin()
    {
        $galleryManager = new PictureManager($this->getPdo());
        $pictures = $galleryManager->selectAll();
        
        return $this->twig->render('Admin/galerie.html.twig', ['pictures' => $pictures]);
    }
    
  
    public function add()
    {
        $errors = [];
        $success = false;
        
        if (!empty($_FILES['image'])) {
            $file = $_FILES['image'];
            $errors = $this->pictureVerification($file);
            
            if (empty($errors)) {
                $fileNameNew = "image_" . $file['name'];
                $fileDestination = self::DIR_UPLOAD . '/' . $fileNameNew;
                
                if (move_uploaded_file($file['tmp_name'], $fileDestination)) {
                    $fileDate = new \DateTime();
                    $pictureManager = new PictureManager($this->getPdo());
                    $picture = new Picture();
                    $picture->setPictureName($fileNameNew);
                    $picture->setPicturePath($fileDestination);
                    $picture->setPictureDate($fileDate);
                    
                    $id = $pictureManager->insert($picture);
                    if ($id > 0) {
                        $success = true;
                    }
                }
            }
        }
        
        return $this->twig->render('Admin/adminPictureAdd.html.twig', ['errors' => $errors, 'success' => $success]);
    }
}
