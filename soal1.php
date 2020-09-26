<?php

    echo "<form action='' method='POST'>";
    echo "<input name='kata'>";
    echo "<button type='submit' name='simpan'>Simpan</button>";
    echo "</form>";
    echo "<br>";
    if (isset($_POST['simpan'])) {
        $kata = $_POST['kata'];

        for ($i=0; $i < strlen($kata); $i++) { 
            $biner = str_pad(decbin(ord($kata[$i])), 8,0, STR_PAD_LEFT);
            echo $biner."  ";
        }
    }