<?php

require __DIR__.'/lib/models/User.php';
require __DIR__.'/lib/models/Email.php';

// test avec le include de lib2/User.php qui n'existe pas
include __DIR__.'/lib2/models/User.php';

use Dyma\models\{Admin, Email};
use Dyma\models\User as DymaUser;
use function Dyma\models\{SayHello};
use const Dyma\models\{TEST};
use const Dyma\const\{TOTO_TEST_CONST};

class USer extends DymaUser
{
    public function __construct()
    {
        echo 'Hello from User class!';
    }
}

$user = new User();
SayHello();
echo TEST;

$email = new Email();
echo $email;

$admin = new Admin();
echo $email;

echo TOTO_TEST;
echo TOTO_TEST_CONST;

