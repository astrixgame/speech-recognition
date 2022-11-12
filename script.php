<?php

    if(isset($_POST["data"][1])) {
        $data = strtolower($_POST["data"][0] . " " . $_POST["data"][1]);
    } else {
        $data = strtolower($_POST["data"][0]);
    }
    echo $data;

    //Write there you question and responge function
    //For example "turn;off;light"=>"light_off"
    //Replace spaces with ";"
    //Don't forget to add comma if next line is next varriable :)
    $arr = [
        "turn;off;light"=>"off_light",
        "turn;on;light"=>"on_light"
    ];

    function callBack($word) {
        switch($word) {
            case "off_light"://This will be called by "Turn off light"
                say("en", "Turning light off");//Define language and text to speech as responge
                //Some next command
            break;
            case "on_light":
                say("en", "Turning light on");
            break;
        }
    }

    //This is testing if spooken word defined in callBack words
    foreach($arr as $word=>$w) {
        if(str_contains($word, ";")) {
            //Multiple words
            $isExist = true;
            foreach(explode(";", $word) as $words) {
                if($data != $words && !str_contains($data, $words)) {
                    $isExist = false;
                }
            }
            if($isExist) {
                callBack($w);
            }
        } else {
            //Single word
            if($data == $word || str_contains($data, $word)) {
                callBack($w);
            }
        }
    }

    //This function will generate mp3 file with responge by python gTTS
    //and start PlaySound.exe made in C#, first argument is path to sound
    function say($language, $text) {
        shell_exec('py speech.py ' . $language . ' "' . $text . '"');
        exec('start PlaySound.exe "C:/xampp/htdocs/rp.mp3"');
    }
    
?>