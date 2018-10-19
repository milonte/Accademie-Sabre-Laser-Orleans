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

use \Swift_SmtpTransport;
use \Swift_Mailer;
use \Swift_Message;

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


    private function contactForm()
    {
        $errorsForm = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['lastname'])) {
                $errorsForm['lastname0'] = "Votre nom doit être indiqué";
            } elseif (!preg_match("#[a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]$#", $_POST['lastname'])) {
                $errorsForm['invalid lastname'] = "Votre nom ne doit pas contenir de caractères spéciaux";
            }
            if (empty($_POST['firstname'])) {
                $errorsForm['firstname0'] = "Votre prénom doit être indiqué";
            } elseif (!preg_match("#[a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]$#", $_POST['firstname'])) {
                $errorsForm['invalid firstname'] = "Votre prénom ne doit pas contenir de caractères spéciaux";
            }
            if (empty($_POST['email'])) {
                $errorsForm['email0'] = "Votre mail doit être indiqué";
            } elseif (!preg_match(" /^.+@.+\.[a-zA-Z]{2,}$/ ", $_POST['email'])) {
                $errorsForm['invalid email'] = "Le format de l'email n'est pas correct";
            }
            if (empty($_POST['num'])) {
                $errorsForm['num0'] = "Votre numéro de téléphone doit être indiqué";
            } elseif (!preg_match(" #^[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}?$# ", $_POST['num'])) {
                $errorsForm['invalid phone'] = "Le numéro de téléphone renseigné est incorrect";
            }
            if (empty($_POST['message'])) {
                $errorsForm['message0'] = "Vous devez écrire un message";
            } elseif (!preg_match(" #[a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]$# ", $_POST['message'])) {
                $errorsForm['invalid message'] = "Votre message ne doit pas contenir de caractère non-autorisés";
            }
            if (empty($errorsForm)) {
                try {
                    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465))
                        ->setUsername(APP_MAIL_USERNAME)
                        ->setPassword(APP_MAIL_PASSWORD)
                        ->setEncryption(APP_MAIL_ENCRYPTION);
                    $mailer = new Swift_Mailer($transport);
                    $message = new Swift_Message();
                    $message->setSubject('Message formulaire aslo45');
                    $message->setFrom([$_POST['email'] => 'sender name']);
                    $message->addTo(APP_MAIL_ADDTO, 'recipient name');
                    $message->setBody('Cet email a été envoyé par ' . $_POST['lastname'] . ' ' . $_POST['firstname'] . ' ' . ':' . ' ' . $_POST['message']);
                    $result = $mailer->send($message);
                } catch (\Exception $exception) {
                    return $exception->getMessage();
                }
                header('Location: /');
                exit;
            }
        }
        return $errorsForm;
    }

    public function index()
    {
        return $this->twig->render('Home/index.html.twig', ['errors' => self::contactForm(), 'post' => $_POST]);
    }
}
