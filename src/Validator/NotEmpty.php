<?php
/**
 * Created by PhpStorm.
 * User: nico
 * Date: 08/11/18
 * Time: 16:47
 */

namespace Validator;

class NotEmpty implements ValidatorInterface
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
     * @return NotEmpty
     */
    public function setError(string $error): NotEmpty
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
        if (empty($this->getValue())) {
            $this->setError('Valeur vide non autorisée.');
            return false;
        }

        return true;
    }
}