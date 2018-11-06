<?php

/**
 * Created milonte.
 * User: milonte
 * Date: 06/11/17
 * Time: 11:55
 * PHP version 7
 */
namespace Controller;

use Filter\Text;
use Model\AddressManager;
use Model\Address;

/**
 * Class AddressController
 *
 */
class AddressController extends AbstractController
{
    const MIN_GYM_NAME_LENGTH = 10;
    const MIN_GYM_ADDRESS_LENGTH = 10;
    const CONTENT_FILTER = "#[a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ!?,:'() \r\n ]$# ";
    const CITY_FILTER = "#[a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ'\- \r\n ]$# ";
    
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
