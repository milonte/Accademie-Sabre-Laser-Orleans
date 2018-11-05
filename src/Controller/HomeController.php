<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace Controller;


use Model\AddressManager;
use Filter\Text;
use \Swift_SmtpTransport;
use \Swift_Mailer;
use \Swift_Message;
use Model\Address;
/**
 * Class HomeController
 *
 */
class HomeController extends AbstractController
{

    const MIN_TITLE_LENGTH = 3;
    const MIN_CONTENT_LENGTH = 10;
    const CONTENT_FILTER = "#[a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ!?,:'()\r\n ]$# ";

    /**
     * @param array $userData
     * @return array
     */
    private function verifMail(array $userData): array
    {
        $errorsForm = [];
        if (empty($userData['lastname'])) {
            $errorsForm['lastname'] = "Votre nom doit être indiqué";
        } elseif (!preg_match("#[a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]$#", $userData['lastname'])) {
            $errorsForm['lastname'] = "Votre nom ne doit pas contenir de caractères spéciaux";
        }
        if (empty($userData['firstname'])) {
            $errorsForm['firstname'] = "Votre prénom doit être indiqué";
        } elseif (!preg_match("#[a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]$#", $userData['firstname'])) {
            $errorsForm['firstname'] = "Votre prénom ne doit pas contenir de caractères spéciaux";
        }
        if (empty($userData['email'])) {
            $errorsForm['email'] = "Votre mail doit être indiqué";
        } elseif (!preg_match(" /^.+@.+\.[a-zA-Z]{2,}$/ ", $userData['email'])) {
            $errorsForm['email'] = "Le format de l'email n'est pas correct";
        }
        if (empty($userData['num'])) {
            $errorsForm['num'] = "Votre numéro de téléphone doit être indiqué";
        } elseif (!preg_match(" #^[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}?$# ", $userData['num'])) {
            $errorsForm['num'] = "Le numéro de téléphone renseigné est incorrect";
        }
        if (empty($userData['message'])) {
            $errorsForm['message'] = "Vous devez écrire un message";
        } elseif (!preg_match(" #[a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]$# ", $userData['message'])) {
            $errorsForm['message'] = "Votre message ne doit pas contenir de caractère non-autorisés";
        }


        return $errorsForm;
    }


    /**
     * @param array $userData
     * @return string
     */
    private function sendMail(array $userData): string
    {
        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465))
            ->setUsername(APP_MAIL_USERNAME)
            ->setPassword(APP_MAIL_PASSWORD)
            ->setEncryption(APP_MAIL_ENCRYPTION);
        $mailer = new Swift_Mailer($transport);
        $message = new Swift_Message();
        $message->setSubject('Message formulaire aslo45');
        $message->setFrom([$userData['email'] => $userData['lastname'] . ' ' . $userData['firstname']]);
        $message->addTo(APP_MAIL_ADDTO, 'recipient name');
        $message->addReplyTo($userData['email'], $userData['email']);
        $message->setBody($userData['message']);
        $result = $mailer->send($message);
        return $result;
    }


    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index()
    {

        $addressManager = new AddressManager($this->getPdo());
        $addreses = $addressManager->selectAll();

        $errors = $userData = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userData = $_POST;
            $textFilter = new Text();
            $textFilter->setTexts($userData);
            $userData = $textFilter->filter();
            $errors = $this->verifMail($userData);
            if (empty($errors)) {
                $this->sendMail($userData);
                header('location:/');
                exit();
            }
        }

        return $this->twig->render('Home/index.html.twig', ['errors' => $errors, 'post' => $userData, 'addreses'=>$addreses]);
    }

    public function listAddress() 
    {

        $addressManager = new AddressManager($this->getPdo());
        $addreses = $addressManager->selectAll();

        
        return $this->twig->render('Home/_address_form.html.twig', ['addreses' => $addreses]);
    }
    
    public function editAddress(int $id) 
    {

        $addressManager = new AddressManager($this->getPdo());

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            $userData = $_POST;
            $textFilter = new Text();
            $textFilter->setTexts($userData);
            $userData = $textFilter->filter();
    
            //if (count($this->formErrors()) === 0) {
                $address = new Address();
                $address->setId($id);
                $address->setGymName($userData['name']);
                $address->setGymAddress($userData['address']);
                $address->setZipCode($userData['zip_code']);
                $address->setCity($userData['city']);
                $address->setDateInfo($userData['date']);
                $address->setScheduleInfo($userData['schedule']);
    
                $addressManager->update($address);
            //}
    
            header('Location:/admin/addresses');
        }

    }

     /**
     * Check form inputs
     * @return table of errors (or bool false if no errors)
     */
    private function formErrors()
    {
        $errors = [];

        if (!isset($_POST['title']) || strlen(trim($_POST['title'])) < self::MIN_TITLE_LENGTH) {
            $errors['title_length'] = "Le titre doit contenir minimum " . self::MIN_TITLE_LENGTH . " caractères !";
        } else if (!preg_match(self::CONTENT_FILTER, $_POST['title'])) {
            $errors['title_regex'] = "Le titre contient des caractères spéciaux";
        }

        if (!isset($_POST['content']) || strlen(trim($_POST['content'])) < self::MIN_CONTENT_LENGTH) {
            $errors['content_length'] = "Le contenu doit contenir minimum " . self::MIN_CONTENT_LENGTH . " caractères !";
        } else if (!preg_match(self::CONTENT_FILTER, trim($_POST['content']))) {
            $errors['content_regex'] = "Le contenu contient des caractères spéciaux";
        }


        if ($_POST['linkUrl']) {
            if (!(filter_var($_POST['linkUrl'], FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED))) {
                $errors['link_regex'] = "Format non valide (format accepté : http://www.website.com)";
            }
        }

        if (count($errors) !== 0) {
            $errors['title'] = trim($_POST['title']);
            $errors['content'] = trim($_POST['content']);
            $errors['linkUrl'] = trim($_POST['linkUrl']);
        }
        return $errors;

    }

}
