<?php
/**
 * Created by PhpStorm.
 * User: wilder2
 * Date: 16/10/18
 * Time: 20:06
 */

namespace Controller;


class MemberController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('Home/contact_form.html.twig');
    }


}