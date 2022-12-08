<?php
declare(strict_types=1);

/*
1.1 Susikurkite naują tuščią katalogą ir atsidarykite jį per kodo editorių.
Išskaidykite praeitos temos "inventory checker" užduotį (https://github.com/donatascn/ca-php-course/blob/master/oop/l5/2_inventory_checker.php)
į atskirus failus pagal skaidrėse nurodytą failų struktūrą.
Programa turėtų būti paleidžiama iš root katalogo:
php -f 2_inventory_checker.php "1:3,2:2,5:1"
Klasės turėtų gulėti "src" kataloge:
Exception'ai - "src/Exception" kataloge.
Kitos klasės - "src/Service" kataloge.
- Pridėkite namespace'sus visoms projekto klasėms
- Sutvarkykite projekto autoload'inimą, pasinaudodami "spl_autoload_register" funkcija.
Programa turėtų veikti be papildomų require statementų - už visų failų įtraukimą į index.php failą turi
būti atsakingas autoloaderis
- Panaudokite "use" statementus, kad nereiktų rašyti pilnai kvalifikuotų klasių pavadinimų (FQCN)
*/

spl_autoload_register(function ($className) {
    if ($className === 'Inventory_Checker\App') {
        require 'src/App.php';
    }

    if ($className === 'Inventory_Checker\Validator\InputValidator') {
        require 'src/Validator/InputValidator.php';
    }

    if ($className === 'Inventory_Checker\Service\InventoryService') {
        require 'src/Service/InventoryService.php';
    }

    if ($className === 'Inventory_Checker\Exception\InventoryException') {
        require 'src/Exception/InventoryException.php';
    }

    if ($className === 'Inventory_Checker\Exception\InputValidationException') {
        require 'src/Exception/InputValidationException.php';
    }
});

use Inventory_Checker\App;

$appObj = new App();
$appObj->execute();