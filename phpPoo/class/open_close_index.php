<pre>
    <?php
    
        // class Categorie{
            
        //     public function __construct(public int $price)
        //     {
                
        //     }

        //     public function getPrice(): int
        //     {
        //         return $this->price;
        //     }
        // }
    
        // interface CalculRistourne {
        //     function setCalculByCategory(Categorie $categorie):int;
        // }

        // class ElectronicRistourne implements CalculRistourne {

        //     public function setCalculByCategory(Categorie $categorie):int
        //     {
        //         return $categorie->getPrice() * 0.2;
        //     }
        // }

        // class LivreRistourne implements CalculRistourne {

        //     public function setCalculByCategory(Categorie $categorie):int
        //     {
        //         return $categorie->getPrice() * 0.3;
        //     }
        // }

        // class FinalCount{

        //     public function __construct(public Categorie $categorie, public CalculRistourne $ristourne)
        //     {
                
        //     }

        //     public function getFinalPrice():int
        //     {
        //         return $this->categorie->getPrice() - $this->ristourne->setCalculByCategory($this->categorie);
        //     }

        // }

        // $categorie = new Categorie(100);
        // $ristourne = new ElectronicRistourne();
        // echo $ristourne->setCalculByCategory($categorie);

        // $categorie = new Categorie(100);
        // $ristourne = new LivreRistourne();
        // echo $ristourne->setCalculByCategory($categorie);

        // $final = new FinalCount(new Categorie(100), new ElectronicRistourne());
        // echo $final->getFinalPrice();

        // $final = new FinalCount(new Categorie(70), new LivreRistourne());
        // echo $final->getFinalPrice();

        interface NameableInterface {
            public function theName(): void;
        }
        
        class User implements NameableInterface
        {
            public $name;
            public $firstname;
        
            public function __construct(string $firstname, string $name)
            {
                $this->firstname = $firstname;
                $this->name = $name;
            }
        
            public function theName(): void
            {
                printf("Hello, %s %s", strtoupper($this->name), $this->firstname);
            }
        }
        
        class Customer implements NameableInterface
        {
            public $fullname;
        
            public function __construct(string $fullname)
            {
                $this->fullname = $fullname;
            }
        
            public function theName(): void
            {
                printf("Welcome again, dear %s\n", $this->fullname);
            }
        }
        
        class AccountDisplayerService
        {
            public function displayWelcomeMessage(NameableInterface $entity): void
            {
                $entity->theName();
            }
        }
        
        $user = new User('Lucien', 'Bramard');
        $customer = new Customer('Mr Elliot Alderson');
        
        $accountDisplayer = new AccountDisplayerService();
        
        $accountDisplayer->displayWelcomeMessage($user);
        $accountDisplayer->displayWelcomeMessage($customer);

    ?>
<pre>