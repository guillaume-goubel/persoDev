<?php

namespace Dyma\models {
    
    const TEST = 'Hello from User const!';

    class User
    {
        public function __construct()
        {
            echo 'Hello from User class!';
        }
    }
    
    class Admin
    {
        public function __construct()
        {
            echo 'Hello from Admin class!';
        }
    }
    
    function SayHello()
    {
        echo 'Hello from User function!';
    } 


}

