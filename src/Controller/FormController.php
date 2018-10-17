<?php
/**
 * Created by PhpStorm.
 * User: wilder2
 * Date: 16/10/18
 * Time: 20:06
 */

namespace Controller;


class FormController extends AbstractController
{
    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index()
    {
        return $this->twig->render('Home/contact_form.html.twig');
    }


    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function errors()
    {
        $errorsForm = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (count($_POST) < 5) {
                $errorsForm[] = "ATTENTION, tous les champs doivent être renseigné";
            }

            if (!preg_match(" /^.+@.+\.[a-zA-Z]{2,}$/ ", $_POST['email'])) {
                $errorsForm['invalid email'] = "Le format de l'email n'est pas correct";
            }

            if (!preg_match(" #^[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}?$# ", $_POST['tel'])
                || !preg_match(" #^[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}?$# ", $_POST['EmergencyContactTel'])) {
                $errorsForm['invalid phone'] = "Le numéro de téléphone renseigné est incorrect";
            }

        }
        return $this->twig->render('Home/contact_form.html.twig', ['errors' => $errorsForm, 'post' => $_POST]);
    }
}
