<?php

namespace Tlait\CarForRent\Validation;

use Exception;
use Tlait\CarForRent\Transfer\TransferInterface;

class ValidateRules
{
    /**
     * @param array $validateData
     * @param array $validateRules
     * @return array
     * @throws Exception
     */
    protected function handleValidate(array $validateData, array $validateRules): array
    {
        $error = array();
        foreach ($validateData as $fieldName => $value) {
            foreach ($validateRules[$fieldName] as $index => $rule) {
                $rule = explode(":", $rule);
                $ruleName = $rule[0];
                $ruleValue = $rule[1] ?? null;
                switch ($ruleName) {
                    case "required":
                        $requiredValidate = $this->requiredValidate($fieldName, $value);
                        $error = $requiredValidate ? array_merge($error, array($fieldName => $requiredValidate)) : $error;
                        break;
                    case "max":
                        if (isset($error[$fieldName]) && $error[$fieldName]) {
                            break;
                        }

                        $maxValidate = $this->maxValidate($fieldName, $value, $ruleValue);
                        $error = $maxValidate ? array_merge($error, array($fieldName => $maxValidate)) : $error;
                        break;
                    default:
                        throw new Exception("$ruleName not support!");
                }
            }
        }
        return $error;
    }

    /**
     * @param $fieldName
     * @param $value
     * @return string
     */
    private function requiredValidate($fieldName, $value): string
    {
        if (empty($value)) {
            return ucfirst($fieldName) . " is required!";
        }
        return "";
    }

    /**
     * @param $fieldName
     * @param $value
     * @param $ruleValue
     * @return string
     */
    private function maxValidate($fieldName, $value, $ruleValue): string
    {
        if (is_string($value)) {
            if (strlen($value) > (int)$ruleValue) {
                return ucfirst($fieldName) . " must not exceed $ruleValue characters!";
            }
            return "";
        }
        if ($value > $ruleValue) {
            return ucfirst($fieldName) . " must not rather than $ruleValue!";
        }
        return "";
    }
}
