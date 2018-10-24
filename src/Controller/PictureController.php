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
    
    private function pictureVerification()
    {
        $errors = [];
        
        if (!in_array($_FILES['image']['type'], self::AUTH_EXT)) {
            $errors[] = $_FILES['image']['name'] . " L'extension n'est pas autorisée. Les extensions autorisées sont les suivantes: .jpg / .jpeg / .gif and .png";
        }
        
        if ($_FILES['image']['error'] != 0) {
            $errors[] = $_FILES['image']['name'] . "Le système a rencontré une erreur lors de l'upload de votre image. le code de l'erreur est " . $_FILES['image']['error'];
        }
        
        if ($_FILES['image']['size'] > 2097152) {
            $errors[] = $_FILES['image']['name'] . " La taille du fichier est trop grande.";
        }
        
        return $errors;
    }
    
    public function add()
    {
        $errors = [];
        $success = false;
        
        if (!empty($_FILES['image'])) {
            $errors = $this->pictureVerification();
            
            if (empty($errors)) {
                $fileNameNew = "image_" . $_FILES['image']['name'];
                $fileDestination = self::DIR_UPLOAD . '/' . $fileNameNew;
                
                if (move_uploaded_file($_FILES['image']['tmp_name'], $fileDestination)) {
                    $test = "blabla";
                    var_dump($test);
                    
                    $fileDate = new \DateTime();
                    $pictureManager = new PictureManager($this->getPdo());
                    $picture = new Picture();
                    $picture->setPictureName($fileNameNew);
                    $picture->setPicturePath($fileDestination);
                    $picture->setPictureDate($fileDate);
                    
                    $id = $pictureManager->insert($picture);
                    if (isset($id)) {
                        $success = true;
                    }
                }
            }
        }
        
        return $this->twig->render('Admin/adminPictureAdd.html.twig', ['errors' => $errors, 'success' => $success]);
    }
}
