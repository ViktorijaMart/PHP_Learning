<?php
declare(strict_types=1);

class PasswordValidator
{
    public function validate(string $password): void
    {
        $errorMessage = '';

        if ($this->validateLength($password)) {
            $errorMessage .= 'Password must be at least 10 symbols long' . '<br>';
        }

        if (!$this->validateSpecialCharacters($password)) {
            $errorMessage .= 'Password must contain 2 different special symbols (!@#$%^&*_)' . '<br>';
        }

        if (!$this->validateCasing($password)) {
            $errorMessage .= 'Password mus contain uppercase and lowercase letters' . '<br>';
        }

        if(!$this->validateNumber($password)) {
            $errorMessage .= 'Password must contain at least one number' . '<br>';
        }

        if(empty($errorMessage)) {
            echo 'Password is valid';
        } else {
            throw new Exception($errorMessage);
        }
    }

    // better write separate functions for each validation point than to pu them all in if's in validate function

    private function validateLength(string $password): bool
    {
        return strlen($password) <= 10;
    }

    private function validateSpecialCharacters(string $password): bool
    {
        $specialCharacters = ['!', '@', '#', '$', '%', '^', '&', '*', '_'];
        $specialCharactersCount = 0;

        foreach ($specialCharacters as $specialCharacter) {
            if (str_contains($password, $specialCharacter)) {
                $specialCharactersCount++;
            }
        }

        return $specialCharactersCount >= 2;
    }

    private function validateCasing(string $password): bool
    {
        return preg_match('/[A-Z]/', $password) && preg_match('/[a-z]/', $password);
    }

    private function validateNumber(string $password): bool
    {
        return (bool)preg_match('/\d/', $password);
    }
}

try {
    $passwordValidator = new PasswordValidator();
    $passwordValidator->validate('abc');
} catch (Exception $exception) {
    echo 'Invalid Password: ' . $exception->getMessage();
}

/*
1.1 Para??ykite ??rank?? slapta??od??io stiprumui nustatyti.
Slapta??odis turi:
- b??ti sudarytas i?? ne ma??iau 10 simbli??
- turi tur??ti bent 2 skirtingus specialiuosius simbolius (!@#$%^&*_)
- turi tur??ti ir ma????j??, ir did??i??j?? raid??i?? (aB)
- turi tur??ti bent vien?? skaitmen?? (0-9)
Slapta??od??io validavimas turi vykti klas??je PasswordValidator.
Validatorius, atrad??s taisykl??s pa??eidim??, turi mesti exception'?? su ??inute (pvz.: "Password must be at least ten symbols long")
Kodas, kvie??iantis validatori?? turi gaudyti exception'?? ir spausdinti ??inut?? terminale.
Jeigu slapta??odis atitinka reikalavimus, spausdinkite "Password is valid"
Failo kvietimo pavyzdys:
php -f 1_password_validator.php 123456
Password must be at least 10 symbols long
php -f 1_password_validator.php 123456aBc!@
Password is valid

1.2 Patobulinkite validatoriu. Validatorius turi sukaupti visas klaidas ir jas i??spausdinti.
Failo kvietimo pavyzdys:
php -f 1_password_validator.php 123456
Password must be at least 10 symbols long
Password must contain at least 2 special symbols (!@#$%^&*_)
Password must contain uppercase and lowercase letters
*/