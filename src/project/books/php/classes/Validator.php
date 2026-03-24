<?php

class Validator {
    private $data;
    private $rules;
    private $errors = [];

    public function __construct($data, $rules) {
        $this->data = $data;
        $this->rules = $rules;
        $this->validate();
    }

    private function validate() {
        foreach ($this->rules as $field => $ruleset) {
            $ruleArray = explode('|', $ruleset);
            foreach ($ruleArray as $rule) {
                $this->applyRule($field, $rule);
            }
        }
    }

private function applyRule($field, $rule) {
        $value = $this->data[$field] ?? null;

        if ($rule === 'required' && ($value === null || $value === '' || (is_array($value) && empty($value)))) {
            $this->addError($field, "The $field field is required.");
        } elseif ($rule === 'notempty' && empty($value)) {
            $this->addError($field, "The $field field cannot be empty.");
        } elseif ($rule === 'array' && !is_array($value)) {
            $this->addError($field, "The $field field must be an array.");
        } elseif (strpos($rule, 'min:') === 0) {
            $min = substr($rule, 4);
            $length = is_array($value) ? count($value) : strlen($value ?? '');
            if ($length < $min) {
                $msg = is_array($value) ? "Select at least $min options." : "Must be at least $min characters.";
                $this->addError($field, $msg);
            }
        } elseif (strpos($rule, 'max:') === 0) {
            $max = substr($rule, 4);
            $length = is_array($value) ? count($value) : strlen($value ?? '');
            if ($length > $max) {
                $msg = is_array($value) ? "Select no more than $max options." : "Cannot exceed $max characters.";
                $this->addError($field, $msg);
            }
        }
    }

    private function addError($field, $message) {
        $this->errors[$field][] = $message;
    }

    public function fails() {
        return !empty($this->errors);
    }

    public function errors() {
        return $this->errors;
    }
}