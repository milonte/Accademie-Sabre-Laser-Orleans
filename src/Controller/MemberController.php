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
    
    public function addMember()
    {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            if (isset($_POST['firstname']) AND
                isset($_POST['lastname']) AND
                isset($_POST['email']) AND
                isset($_POST['adress']) AND
                isset($_POST['postalcode']) AND
                isset($_POST['city']) AND
                isset($_POST['tel']) AND
                isset($_POST['birthDate']) AND
                isset($_POST['age16']) AND
                isset($_POST['EmergencyContact']) AND
                isset($_POST['EmergencyContactTel']) AND
                isset($_POST['postalcode']) AND
                isset($_POST['paiement'])
                ) {
                
                $memberAdd = new MemberManager($this->getPdo());
                $member = new Member();
                $member->setFirstname($_POST['firstname']);
                $member->setLastname($_POST['lastname']);
                $member->setEmail($_POST['email']);
                $member->setAdress($_POST['adress']);
                $member->setPostalCode($_POST['postalcode']);
                $member->setCity($_POST['city']);
                $member->setPhone($_POST['tel']);
                $member->setBirthDate($_POST['birthDate']);
                $member->setAge16($_POST['age16']);
                $member->setEmergencyContact($_POST['EmergencyContact']);
                $member->setEmergencyPhone($_POST['EmergencyContactTel']);
                $member->setPayment($_POST['paiement']);
    
                $id = $memberAdd->insert($member);
                header('Location:/inscription/'); //
                }
                else {
                    echo "ATTENTION, tous les champs doivent être renseigné";
            }
        }
        
        return $this->twig->render('Member/memberForm.html.twig');
    }
    
    
}
