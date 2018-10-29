<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 19/10/18
 * Time: 09:44
 */

namespace Controller;

use Model\PictureManager;

/**
 * Class PictureController
 * @package Controller
 */
class PictureController extends AbstractController
{
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
    
}