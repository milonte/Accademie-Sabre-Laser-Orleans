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
    public function show()
    {
        $galleryManager = new PictureManager($this->getPdo());
        $pictures = $galleryManager->selectAll();

        return $this->twig->render('Picture/gallery.html.twig', ['pictures' => $pictures]);
    }
}