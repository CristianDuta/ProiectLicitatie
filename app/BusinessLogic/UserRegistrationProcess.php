<?php

namespace BusinessLogic;

use Database\Model\User;

class UserRegistrationProcess
{
    private $email;
    private $password;
    private $firstName;
    private $lastName;
    private $phoneNumber;
    private $newsOption;

    /**
     * UserRegistrationProcess constructor.
     * @param string $email
     * @param string $password
     * @param string $firstName
     * @param string $lastName
     * @param string $phoneNumber
     * @param bool $newsOption
     */
    public function __construct($email, $password, $firstName, $lastName, $phoneNumber, $newsOption = false)
    {
        $this->email       = $email;
        $this->password    = $password;
        $this->firstName   = $firstName;
        $this->lastName    = $lastName;
        $this->phoneNumber = $phoneNumber;
        $this->newsOption  = !empty($newsOption);
    }



    function execute()
    {
        $user = new User();
        $user->setEmail($this->email);
        $user->setPassword(password_hash($this->password, PASSWORD_DEFAULT));
        $user->setFirstName($this->firstName);
        $user->setLastName($this->lastName);
        $user->setPhoneNumber($this->phoneNumber);
        $user->setNewsOption($this->newsOption);
        $user->save();
    }
}
