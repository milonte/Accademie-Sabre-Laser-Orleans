<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 19/10/18
 * Time: 09:44
 */

namespace Controller;

use Model\GalleryManager;

class GalleryController extends AbstractController
{
    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function gallery()
    {
        $galleryManager = new GalleryManager($this->getPdo());
        $image = $galleryManager->selectAll();

        return $this->twig->render('Gallery/gallery.html.twig', ['image' => $image]);
    }
}