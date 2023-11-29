<pre>
    <?php

    //== NE PAS TOUCHER
    $cours = ['TTTE', 'TEEE', 'TETE', 'EEEE', 'EEPT', 'EEEP', 'PPED', 'ETTT', 'ETET', 'ETEE', 'EETD', 'TETE', 'TEPE', 'ETEE', 'TTTT', 'ETEE', 'TTTE'];
    //== NE PAS TOUCHER
    $childrenNbr = strlen($cours[0]);

    $childrenArray = [];
    for( $i = 0; $i < $childrenNbr; $i++ ){
        $fooArray = [];
        array_push($childrenArray, $fooArray);
    }

    $noteClasse = 0;
    foreach ($childrenArray as $keyChild => $child){ 

        foreach($cours as $keyCours => $coursInLoop){
            $titi = substr($coursInLoop, $keyChild, 1); 
            array_push($childrenArray[$keyChild], $titi);
        }

        $noteArray = $childrenArray[$keyChild];
        // var_dump($noteArray);

        $note = 12;
        foreach ($noteArray as $key => $value) {
                   
            if($value === 'T'){
                if ($note < 20){
                    $note ++;
                }
            }
            else if($value === 'E'){
                if ($note < 20){
                    $note ++;
                }
            }
            else if($value === 'P'){
                if ($note > 0){
                    $note -= 1;
                }
            }
            else if($value == 'D'){
                if ($note > 0){
                    $note -= 2;
                }
            }
            
        }

        if($note < 10){
            $note = 10;
        }

        echo($note.PHP_EOL);
        $noteClasse += $note;
    }

    $noteFloat = floatval($noteClasse / $childrenNbr);
    $average = round($noteFloat, 1);
    // echo($average);

    ?>
</pre>


