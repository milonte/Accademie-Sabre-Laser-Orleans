<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 19/10/18
 * Time: 09:44
 */

namespace Controller;

use Model\GalleryManager;
use Model\Images;

class GalleryController extends AbstractController
{
    public function gallery()
    {
        $galleryManager = new GalleryManager($this->getPdo());
        $images = $galleryManager->selectAll();

        return $this->twig->render('Gallery/gallery.html.twig', ['images' => $images]);
    }
}