<pre>
<?php

    class FullInfos {

        // public string $nationality;
        // public string $genre;
        
        // public function __construct($nationality, $genre)
        // {
        //     $this->nationality = $nationality;
        //     $this->genre = $genre;
        // }

        // OU

        public function __construct(public ?string $nationality, public string $genre)
        {

        }

        public function toDoSomething(){
            echo "I'm doing something";
        } 
 
    }


    class User {

        public FullInfos $fullInfos;
        
        public function __construct(public string $firstname, public string $lastname)
        {
            
        }

        public function setFullInfos(FullInfos $fullInfos): void
        {
            $this->fullInfos = $fullInfos;
        }

        public function getFullInfos(): FullInfos
        {
            return $this->fullInfos;
        }

    }

    $user = new User('Jean', 'ValJean');
    $user->setFullInfos(new FullInfos(NULL, 'Homme'));
    $user->getFullInfos()->toDoSomething();
    
    var_dump($user->fullInfos->nationality);

?>
<pre>