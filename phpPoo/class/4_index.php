<pre>
    <?php

        class Wallet
        {

            public function __construct(public ?int $amount)
            {
                
            }

        }

        class User2 
        {
            public Wallet $wallet;
            public $firstName;

            public function setWallet(Wallet $wallet): void
            {
                $this->wallet = $wallet;
            }

            public function getWallet(): Wallet
            {
                return $this->wallet;
            }
            
        }

        $user = new User2();
        $user->setWallet(new Wallet(100));
        var_dump($user->wallet->amount);

        $user->setWallet(new Wallet(null));
        var_dump($user->wallet?->amount);

    ?>
<pre>