<?php
/**
 * Created by PhpStorm.
 * User: nico
 * Date: 08/11/18
 * Time: 17:14
 */

namespace Form;


use Validator\ValidatorInterface;

class Form implements ValidatorInterface
{
    /**
     * @var array
     */
    private $fields;

    /**
     * @var array
     */
    private $validators;

    /**
     * @return array
     */
    public function getValidators(): array
    {
        return $this->validators;
    }

    /**
     * @param array $validators
     * @return Form
     */
    public function setValidators(array $validators): Form
    {
        foreach ($validators as $validator) {
            if (!$validator instanceof ValidatorInterface) {
                throw new \Exception('Type '.gettype($validator).' interdit.');
            }
        }
        $this->validators = $validators;
        return $this;
    }

    public function validate(): bool
    {
        $valid = true;

        foreach ($this->getValidators() as $key => $validator) {
            if (false === $validator->validate()) {
                $valid = false;
            }
        }

        return $valid;
    }
}
