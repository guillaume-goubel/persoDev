<pre>
    <?php
    
        interface Naming {
            function setFirstName($value);
            function getFirstName();
            function setLastName($value);
            function getLastName();
        }

        trait Move {
            function moving (){
                echo "I'm moving";
            }
        }

        abstract class Bar {
            
            protected $foo;
            
            function __construct($firstName, $lastName, $foo) {
                $this->setFirstName($firstName);
                $this->setLastName($lastName);
                $this->foo = $foo;
            }

            abstract function greeting():string;
        }
        
        class Person extends Bar implements Naming {
            
            use Move;
            private $firstName;
            private $lastName;
            public $foo;

            public function setFirstName($value) {
                $this->firstName = $value;
            }

            public function getFirstName() {
                return $this->firstName;
            }

            public function setLastName($value) {
                $this->lastName = $value;
            }

            public function getLastName() {
                return $this->lastName;
            }

            function greeting():string{
                return "Hello $this->firstName $this->lastName $this->foo";
            }

        }

        $user = new Person('toto', 'titi', 'bar');
        var_dump($user->greeting());

    ?>
<pre>