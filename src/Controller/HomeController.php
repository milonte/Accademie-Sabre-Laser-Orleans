<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */
namespace Controller;
/**
 * Class HomeController
 *
 */
class HomeController extends AbstractController
{
    /**
     * Display item listing
     *
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index()
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
        return $this->twig->render('Home/index.html.twig', ['errors' => $errorsForm, 'post' => $_POST]);
    }




}