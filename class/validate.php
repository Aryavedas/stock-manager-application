<?php
class Validate
{
    private  $_error = array();
    private  $_formMethod = NULL;

    public  function __construct($formMethod)
    {
        $this->_formMethod = $formMethod;
    }

    public function setRules($item,  $itemLabel,  $rules)
    {
        if (isset($this->_formMethod[$item])) {
            $formValue = trim($this->_formMethod[$item]);
        } else {
            $formValue = "";
        }

        if (array_key_exists("sanitize", $rules)) {
            $formValue = Input::runSanitize($formValue, $rules["sanitize"]);
        }

        foreach ($rules as $rule => $ruleValue) {

            switch ($rule) {

                case "required":
                    if ($ruleValue === TRUE && empty($formValue)) {
                        $this->_error[$item] = "{$itemLabel} Tidak Boleh Kosong";
                    }
                    break;

                case "min_char":
                    if (strlen($formValue) < $ruleValue) {
                        $this->_error[$item] = "{$itemLabel} Minimal {$ruleValue} Karakter";
                    }
                    break;

                case "max_char":
                    if (strlen($formValue) > $ruleValue) {
                        $this->_error[$item] = "{$itemLabel} Maksimal {$ruleValue} Karakter";
                    }
                    break;

                case "numeric":
                    if ($ruleValue === TRUE && !is_numeric($formValue)) {
                        $this->_error[$item] = "{$itemLabel} Harus Berupa Angka";
                    }
                    break;

                case "min_value":
                    if ($formValue < $ruleValue) {
                        $this->_error[$item] = "{$itemLabel} Minimal {$ruleValue}";
                    }
                    break;

                case "max_value":
                    if ($formValue > $ruleValue) {
                        $this->_error[$item] = "{$itemLabel} Maksimal {$ruleValue}";
                    }
                    break;

                case 'matches':
                    if ($formValue != $this->_formMethod[$ruleValue]) {
                        $this->_error[$item] = "Password tidak sama";
                    }
                    break;

                case 'email':
                    if ($ruleValue === TRUE && !filter_var($formValue, FILTER_VALIDATE_EMAIL)) {
                        $this->_error[$item] = "Format Penulisan {$itemLabel} Salah";
                    }
                    break;

                case 'url':
                    if ($ruleValue === TRUE && !filter_var($formValue, FILTER_VALIDATE_URL)) {
                        $this->_error[$item] = "Format Penulisan {$itemLabel} Salah";
                    }
                    break;

                case "unique":
                    require_once("database.php");
                    $db = Database::getInstance();
                    if ($db->check($ruleValue[0], $ruleValue[1], $formValue)) {
                        $this->_error[$item] = "$itemLabel sudah terpakai, silahkan pilih
                        nama lain";
                    }
                    break;

                case 'regexp':
                    if (!preg_match($ruleValue, $formValue)) {
                        $this->_error[$item] = "Pola $itemLabel tidak sesuai";
                    }
                    break;
            }
            if (!empty($this->_error[$item])) {
                break;
            }
        }

        return $formValue;
    }

    public function getError()
    {
        return $this->_error;
    }

    public function passed()
    {
        if (empty($this->_error)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
