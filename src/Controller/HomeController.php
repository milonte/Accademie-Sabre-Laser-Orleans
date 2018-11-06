<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */
namespace Controller;

use Filter\Text;
use Model\Address;
use Model\AddressManager;
use Model\PictureManager;
use \Swift_Mailer;
use \Swift_Message;
use \Swift_SmtpTransport;

/**
 * Class HomeController
 *
 */
class HomeController extends AbstractController
{

    const MIN_GYM_NAME_LENGTH = 10;
    const MIN_GYM_ADDRESS_LENGTH = 10;
    const CONTENT_FILTER = "#[a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ!?,:'() \r\n ]$# ";
    const CITY_FILTER = "#[a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ'\- \r\n ]$# ";

    /**
     * @param array $userData
     * @return array
     */
    private function verifMail(array $userData): array
    {
        $errorsForm = [];
        $carConformity = "#[a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]$#";
        $numberConformity = " #^[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}?$# ";
        if (empty($userData['lastname'])) {
            $errorsForm['lastname'] = "Votre nom doit être indiqué";
        } elseif (!preg_match($carConformity, $userData['lastname'])) {
            $errorsForm['lastname'] = "Votre nom ne doit pas contenir de caractères spéciaux";
        }
        if (empty($userData['firstname'])) {
            $errorsForm['firstname'] = "Votre prénom doit être indiqué";
        } elseif (!preg_match($carConformity, $userData['firstname'])) {
            $errorsForm['firstname'] = "Votre prénom ne doit pas contenir de caractères spéciaux";
        }
        if (empty($userData['email'])) {
            $errorsForm['email'] = "Votre mail doit être indiqué";
        } elseif (!preg_match(" /^.+@.+\.[a-zA-Z]{2,}$/ ", $userData['email'])) {
            $errorsForm['email'] = "Le format de l'email n'est pas correct";
        }
        if (empty($userData['num'])) {
            $errorsForm['num'] = "Votre numéro de téléphone doit être indiqué";
        } elseif (!preg_match($numberConformity, $userData['num'])) {
            $errorsForm['num'] = "Le numéro de téléphone renseigné est incorrect";
        }
        if (empty($userData['message'])) {
            $errorsForm['message'] = "Vous devez écrire un message";
        } elseif (!preg_match($carConformity, $userData['message'])) {
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
        $pictureManager = new PictureManager($this->getPdo());
        $pictures = $pictureManager->selectPictureHomeAll();
        $coords = [];

        foreach ($addreses as $address) {
            $addressInfos = $addressManager->getAdressInfos(
                $address->gym_address
                . ' '
                . $address->zip_code
            )["features"][0]["geometry"]["coordinates"];
            $coords[] = [$addressInfos[1], $addressInfos[0]];
        }

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

        return $this->twig->render(
            'Home/index.html.twig',
            [
                'errors' => $errors,
                'post' => $userData,
                'addreses' => $addreses,
                'coords' => $coords,
                'pictures' => $pictures,
            ]
        );
    }

    /**
     * Edit addresses
     *
     * @return string
     */
    public function editAddress()
    {
        $addressManager = new AddressManager($this->getPdo());

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userData = $_POST;
            $textFilter = new Text();
            $textFilter->setTexts($userData);
            $userData = $textFilter->filter();
            $errors = $this->formErrors($userData);

            if (count($errors) === 0) {
                $address = new Address();
                $address->setId($userData['id']);
                $address->setGymName($userData['name']);
                $address->setGymAddress($userData['address']);
                $address->setZipCode($userData['zip_code']);
                $address->setCity($userData['city']);
                $address->setDateInfo($userData['date']);
                $address->setScheduleInfo($userData['schedule']);

                $addressManager->update($address);
            }
        }

        $addreses = $addressManager->selectAll();
        return $this->twig->render('Home/_address_form.html.twig', ['addreses' => $addreses, 'errors' => $errors]);
    }

    /**
     * Check form inputs
     *
     * @param table $data
     * @return table $errors
     */
    private function formErrors($data)
    {
        $errors = [];

        if (!isset($data['name']) || mb_strlen($data['name']) < self::MIN_GYM_NAME_LENGTH) {
            $errors['name_length'] = "Le nom doit contenir minimum " . self::MIN_GYM_NAME_LENGTH . " caractères !";
        } elseif (!preg_match(self::CONTENT_FILTER, $data['name'])) {
            $errors['name_regex'] = "Le nom contient des caractères spéciaux";
        }

        if (!isset($data['address']) || mb_strlen($data['address']) < self::MIN_GYM_ADDRESS_LENGTH) {
            $errors['address_length'] = "L'adresse' doit contenir minimum "
            . self::MIN_GYM_ADDRESS_LENGTH
            . " caractères !";
        } elseif (!preg_match(self::CONTENT_FILTER, $data['address'])) {
            $errors['address_regex'] = "L'adresse contient des caractères spéciaux";
        }

        if (!isset($data['zip_code']) || mb_strlen($data['zip_code']) !== 5) {
            $errors['zip_code_length'] = "Le code postal doit contenir 5 chiffres";
        } elseif (!preg_match("/^(([0-8][0-9])|(9[0-5]))[0-9]{3}$/ ", $data['zip_code'])) {
            $errors['zip_code_regex'] = "Code postal: format non valide";
        }

        if (!isset($data['city']) || mb_strlen($data['city']) < 3) {
            $errors['city_length'] = "La ville doit contenir minimum 3 caractères";
        } elseif (!preg_match(self::CITY_FILTER, $data['city'])) {
            $errors['city_regex'] = "La ville contient des caractères spéciaux";
        }

        if (!isset($data['date']) || mb_strlen($data['date']) < 10) {
            $errors['date_length'] = "La date doit contenir minimum 3 caractères";
        }

        if (!isset($data['schedule']) || mb_strlen($data['schedule']) < 10) {
            $errors['schedule_length'] = "Les horraires doivent contenir minimum 3 caractères";
        }

        if (count($errors) !== 0) {
            $errors['name'] = $data['name'];
            $errors['address'] = $data['address'];
            $errors['zip_code'] = $data['zip_code'];
            $errors['city'] = $data['city'];
            $errors['date'] = $data['date'];
            $errors['schedule'] = $data['schedule'];
        }

        return $errors;
    }
}
