<?php
/**
 * Created by PhpStorm.
 * User: nico
 * Date: 08/11/18
 * Time: 16:47
 */

namespace Validator;

class Email implements ValidatorInterface
{
    /**
     * @var mixed
     */
    private $value;

    /**
     * @var string
     */
    private $error;

    /**
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * @param string $error
     * @return Email
     */
    public function setError(string $error): Email
    {
        $this->error = $error;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return NotEmpty
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return bool
     */
    public function validate(): bool
    {
        if (!filter_var($this->getValue(), FILTER_VALIDATE_EMAIL)) {
            $this->setError("Le format de l'email n'est pas correct");
            return false;
        }

        return true;
    }
}