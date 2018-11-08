<?php
/**
 * Created by PhpStorm.
 * User: wilder20
 * Date: 10/10/18
 * Time: 16:46
 */

namespace Controller;

use Form\Form;
use Model\AbstractManager;
use Model\Member;
use Model\MemberManager;
use Filter\Text;
use Validator\Date;
use Validator\Email;
use Validator\NotEmpty;

class MemberController extends AbstractController
{
    const MAX_SIZE_MEMBER_FIELD = 255;
    
    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function add()
    {
        $errors=[];
        $success = false;

        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            $userData = $_POST;
            $textFilter = new Text();
            $textFilter->setTexts($userData);
            $userData = $textFilter->filter();

//            $notEmptyValidator = new NotEmpty();
//            foreach ($userData as $key => $data) {
//                $notEmptyValidator->setValue($data);
//                if (false === $notEmptyValidator->validate()) {
//                    $errors[] = array($key => $notEmptyValidator->getError());
//                }
//            }

            $validators = [
                'email' => (new Email())->setValue($userData['email']),
                'birthDate' => (new Date())->setValue($userData['birthDate'])
            ];

            $form =  new Form();
            $form->setValidators($validators);
            $valid = $form->validate();

            if ($valid) {
                $memberAdd = new MemberManager($this->getPdo());
                $member = new Member();
                $member->setFirstName($userData['firstname']);
                $member->setLastname($userData['lastname']);
                $member->setEmail($userData['email']);
                $member->setAddress($userData['address']);
                $member->setPostalCode($userData['postalcode']);
                $member->setCity($userData['city']);
                $member->setPhone($userData['tel']);
                $member->setBirthDate(new \DateTime($userData['birthDate']));
                $member->setEmergencyContact($userData['EmergencyContact']);
                $member->setEmergencyPhone($userData['EmergencyContactTel']);
                $member->setPayment($userData['paiement']);
                
                $id = $memberAdd->insert($member);
                if ($id > 0) {
                    $success = true;
                }
            }
        }
        return $this->twig->render(
            'Member/memberForm.html.twig',
            ['errors' => $errors, 'success' => $success, 'validators' => $validators]
        );
    }
}
