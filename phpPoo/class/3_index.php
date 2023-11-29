<pre>

    <?php 

        // Construct / destruct ------------------------------
        class Reader{

            public function __construct(public $fileName)
            {
                $this->fileName = fopen($fileName, 'r');
                echo 'reader instance';
            }

            function read(){
                echo fread($this->fileName, 10);
            }

            public function __destruct()
            {
                fclose($this->fileName);
                echo 'reader destruct';
            }

        }

        // $reader = new Reader(__DIR__.'/text.txt');
        // $reader->read();
        // Construct / destruct ------------------------------

        
        // Heritage ------------------------------
        class User
        {

            public bool $isAdmin = false;

            public function __construct(public string $name)
            {
                
            }

            protected function greeting (){
                echo 'Hello ';
            }

        }

        class Admin extends User 
        {
            public bool $isAdmin = true;

            public function __construct($name)
            {
                parent::__construct($name);
            }

            public function greeting (){
                $foo = parent::greeting();
                $bar = 'les gars';
                return $foo.$bar;
            }

        }

        $user = new User('jean');
        $admin = new Admin('Toto');

        // var_dump($user);
        // var_dump($admin->greeting());
        // Heritage ------------------------------

        class User2{

            private $fullName;

            public function __construct(private string $firstname, private string $lastname)
            {
                $this->fullName = $firstname.' '.$lastname;
            }

            public function __destruct()
            {
            }

            public function __get($prop)
            {
                return $this->$prop;
            }

            public function __toString()
            {
                return "$this->firstname, $this->lastname";
            }

            function getFullName (){
                return $this->fullName;
            }

            // function setFirstName($value){
            //     $this->firstname = $value;
            //     $this->fullName = $this->firstname.' '.$this->lastname;
            // }

            // function getFirstName (){
            //     return $this->firstname;
            // }

            // function getLastName (){
            //     return $this->lastname;
            // }
            
        }
        // echo $user->getFullName();
        // echo '</br>';
        // $user = new User2('Jean', 'ValJean');
        // echo '</br>';
        // $user->setFirstName('Toti');
        // echo $user->getFullName();
        // echo '</br>';

        $user = new User2('Jean', 'ValJean');
        echo $user;
    

    ?>
<pre>
