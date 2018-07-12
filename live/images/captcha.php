<?php
 session_start();

  // Set some important CAPTCHA constants
  define('CAPTCHA_NUMCHARS', 6);  // number of characters in pass-phrase
  define('CAPTCHA_WIDTH', 100);   // width of image
  define('CAPTCHA_HEIGHT', 25);   // height of image

  // Generate the random pass-phrase
  $pass_phrase = "";
  for ($i = 0; $i < CAPTCHA_NUMCHARS; $i++) {
    $pass_phrase .= chr(rand(97, 122));
  }
 
 
 // Create the Image
 $img = imagecreatetruecolor(CAPTCHA_WIDTH, CAPTCHA_HEIGHT);
				
 // Set a white background with black text and gray text
 $bg_color = imagecolorallocate($img, 0, 0, 0);
 $text_color = imagecolorallocate($img, 237, 0, 0);
 $graphic_color = imagecolorallocate($img, 64, 64, 64);
				
 // Fill the background
 imagefilledrectangle($img, 0, 0, CAPTCHA_WIDTH, CAPTCHA_HEIGHT, $bg_color);
 
  // Draw the pass-phrase string
 imagettftext($img, 18, 0, 5, CAPTCHA_HEIGHT - 5, $text_color, "Acquaintance.ttf", $pass_phrase);
				
 // Draw random lines
 for ($i = 0; $i < 5; $i++) {
   imageline($img, 0, rand() % CAPTCHA_HEIGHT, CAPTCHA_WIDTH,
	  rand() % CAPTCHA_HEIGHT, $graphic_color);
   }
				 
 //Sprinkle random dots
 for ($i = 0; $i < 50; $i++) {
 imagesetpixel($img, rand() % CAPTCHA_WIDTH,
    rand() % CAPTCHA_HEIGHT, $graphic_color);
 }			  

				 
 //Output image as a PNG using a header
 header("Content-type: image/png");
 imagepng($img);
 
 //store encrypted pass-phrase in session variable
 $_SESSION['pass_phrase'] = sha1($pass_phrase);

 //Clean up
 imagedestroy($img);

?>