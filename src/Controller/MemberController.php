<?php
/**
 * Created by PhpStorm.
 * User: wilder20
 * Date: 10/10/18
 * Time: 16:46
 */

namespace Controller;

use Model\AbstractManager;
use Model\Member;
use Model\MemberManager;

class MemberController extends AbstractController
{
    
    public function index()
    {
        return $this->twig->render('Member/memberForm.html.twig');
    }
    
    public function testInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = strip_tags($data);
        return $data;
    }
    
    public function addMember()
    {
        $errorsForm=[];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (count($_POST)<12) {
                $errorsForm[] = "ATTENTION, tous les champs doivent être renseigné";
            }
            
            if (!preg_match(" /^.+@.+\.[a-zA-Z]{2,}$/ ", $_POST['email'])) {
                $errorsForm['invalid email']="Le format de l'email n'est pas correct";
            }
            
            if (!preg_match(" #^[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}?$# ", $_POST['tel'])
                || !preg_match(" #^[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}?$# ", $_POST['EmergencyContactTel'])) {
                $errorsForm['invalid phone']="Le numéro de téléphone renseigné est incorrect";
            }
            if (!preg_match("#^(0?\d|[12]\d|3[01])-(0?\d|1[012])-((?:19|20)\d{2})$# ", $_POST['birthDate'])) {
                $errorsForm['invalid date']="le format de la date est incorrect";
            }
            foreach ($_POST as $value) {
                if (gettype($value)=="string") {
                    if (strlen($value)>40) {
                        $errorsForm['sizeString'] ="le nombre de caractère utilisé est trop long";
                    }
                }
            }
            if (empty($errorsForm)) {
                $memberAdd = new MemberManager($this->getPdo());
                $member = new Member();
                $member->setFirstname(self::testInput($_POST['firstname']));
                $member->setLastname(self::testInput($_POST['lastname']));
                $member->setEmail(self::testInput($_POST['email']));
                $member->setAdress(self::testInput($_POST['adress']));
                $member->setPostalCode(self::testInput($_POST['postalcode']));
                $member->setCity(self::testInput($_POST['city']));
                $member->setPhone(self::testInput($_POST['tel']));
                $member->setBirthDate(self::testInput($_POST['birthDate']));
                $member->setAge16(self::testInput($_POST['age16']));
                $member->setEmergencyContact(self::testInput($_POST['EmergencyContact']));
                $member->setEmergencyPhone(self::testInput($_POST['EmergencyContactTel']));
                $member->setPayment(self::testInput($_POST['paiement']));
                
                $id = $memberAdd->insert($member);
                //header('Location:/inscription');
            }
        }
        return $this->twig->render('Member/memberForm.html.twig', ['errors' => $errorsForm, 'post' => $_POST]);
    }
}
