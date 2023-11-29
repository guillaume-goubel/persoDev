<pre>
    <?php
    
        interface FooInterface {
            function foo():void;
        }

        class Tete implements FooInterface {
            public function foo():void {
                echo "Toto";
            }
        }

        class TitTi implements FooInterface {
            public function foo():void {
                echo "Titi";
            }
        }

        class Tutu implements FooInterface {
            public function foo():void {
                echo "Tutu";
            }
        }

        class RenderService {
            public function render(FooInterface $entity):void {
                $entity->foo();
            }
        }

        $renderService = new RenderService();
        $renderService->render(new Tete());
        $renderService->render(new TitTi());
        $renderService->render(new Tutu());

    ?>
<pre>