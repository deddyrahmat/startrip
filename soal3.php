<?php
$rows = 5;

for ($i=1; $i <= $rows ; $i++) { 
    for ($j=$rows; $j > $i ; $j--) { 
        echo "&nbsp;&nbsp;";
    }

    echo "*";

    for ($k=1; $k < 2 *($i - 1); $k++) { 
        echo "&nbsp;&nbsp;";
    }

    if ($i == 1) {
        echo "&nbsp;&nbsp;";
    }else{
        echo "*";
    }

    echo "<br>";
}

for ($i=$rows-1; $i >= 1 ; $i--) { 
    for ($j=$rows; $j > $i ; $j--) { 
        echo "&nbsp;&nbsp;";
    }

    echo "*";

    for ($k=1; $k < 2 *($i - 1); $k++) { 
        echo "&nbsp;&nbsp;";
    }

    if ($i == 1) {
        echo "&nbsp;&nbsp;";
    }else{
        echo "*";
    }

    echo "<br>";
}