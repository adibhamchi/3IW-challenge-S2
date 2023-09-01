<?php

namespace App\Core;

class Validator
{
    private array $data = [];
    public array $errors = [];
    public function isSubmited(): bool
    {
        $this->data = ($this->method == "POST")?$_POST:$_GET;
        if(isset($this->data["submit"])){
            return true;
        }
        return false;
    }
    public function isValid(): bool
    {
        //La bonne method ?
        if($_SERVER["REQUEST_METHOD"] != $this->method){
            die("Tentative de Hack");
        }

        $inputCount = count($this->config["inputs"]);

        //On compte les input type file et non-file séparément
        $fileInputCount = 0;
        $nonFileInputCount = 0;
        foreach ($this->config["inputs"] as $name=>$configInput){
            if ($configInput["type"] === "file") {
                $fileInputCount++;
            } else {
                $nonFileInputCount++;
            }
        }

        //Le nb de inputs non-file
        if($nonFileInputCount+1 != count($this->data)){
            die("Tentative de Hack");
        }

        //Le nb de inputs file
        if($fileInputCount != count($_FILES)){
            die("Tentative de Hack");
        }

        foreach ($this->config["inputs"] as $name=>$configInput){
            if($configInput["type"] !== "file") {
                if(!isset($this->data[$name])){
                    die("Tentative de Hack");
                }
                if(isset($configInput["required"]) && self::isEmpty($this->data[$name])){
                    die("Tentative de Hack");
                }
                if(isset($configInput["min"]) && !self::isMinLength($this->data[$name], $configInput["min"])){
                    $this->errors[]=$configInput["error"];
                }
                if(isset($configInput["max"]) && !self::isMaxLength($this->data[$name], $configInput["max"])){
                    $this->errors[]=$configInput["error"];
                }
            } else { //Pour les inputs de type file
                if(!isset($_FILES[$name])){
                    die("Tentative de Hack");
                }
                //Ici, vous pouvez ajouter d'autres vérifications pour les inputs de type file
            }
        }
        if(empty($this->errors)){
            return true;
        }
        return false;
    }


    public static function isEmpty(String $string): bool
    {
        return empty(trim($string));
    }
    public static function isMinLength(String $string, $length): bool
    {
        return strlen(trim($string))>=$length;
    }
    public static function isMaxLength(String $string, $length): bool
    {
        return strlen(trim($string))<=$length;
    }

}