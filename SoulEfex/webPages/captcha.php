<?php
    session_start();

    //set some important CAPTCHA constants
    define('CAPTCHA_NUMCHARS', 6);  // number of characters in pass-phrase
    define('CAPTCHA_WIDTH', 100);   // width of image
    define('CAPTCHA_HEIGHT', 30);   // height of image

    //generate the random pass-phrase
    $pass_phrase = "";
    for ($i = 0; $i < CAPTCHA_NUMCHARS; $i++) {
        $pass_phrase .= chr(rand(97, 122));
    }

    //store the encrypted pass-phrase in a session variable
    $_SESSION['pass_phrase'] = SHA1($pass_phrase);

    //create the image
    $img = imagecreatetruecolor(CAPTCHA_WIDTH, CAPTCHA_HEIGHT);

    //set a white background with black text and gray graphics
    $bg_color = imagecolorallocate($img, 255, 255, 255);     // white
    $text_color = imagecolorallocate($img, 70, 70, 70);         // gray
    $graphic_color = imagecolorallocate($img, 211, 211, 211);   // gray

    //fill the background
    imagefilledrectangle($img, 0, 0, CAPTCHA_WIDTH, CAPTCHA_HEIGHT, $bg_color);

    //sprinkle in some random dots
    for ($i = 0; $i < 100; $i++) {
        imagesetpixel($img, rand() % CAPTCHA_WIDTH, rand() % CAPTCHA_HEIGHT, $graphic_color);
    }

    //draw the pass-phrase string
    imagettftext($img, 18, 5, 5, CAPTCHA_HEIGHT - 5, $text_color, '../font/Courier New Bold.ttf', $pass_phrase);

    //output the image as a PNG using a header
    header("Content-type: image/png");
    imagepng($img);

    //clean up
    imagedestroy($img);
?>