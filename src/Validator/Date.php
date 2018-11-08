<?php
/**
 * Created by PhpStorm.
 * User: nico
 * Date: 08/11/18
 * Time: 16:47
 */

namespace Validator;

class Date implements ValidatorInterface
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
     * @return Date
     */
    public function setError(string $error): Date
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
        $checkDate=explode("-", $this->getValue());
        if (!checkdate($checkDate[1], $checkDate[2], $checkDate[0])) {
            $this->setError("le format de la date est incorrect");
            return false;
        }

        return true;
    }
}