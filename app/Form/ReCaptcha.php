<?php 

namespace Framework\Form;

use Framework\FlashBag;

/**
 * @source 
 * https://developers.google.com/recaptcha/docs/verify
 * https://stevencotterill.com/articles/adding-google-recaptcha-v3-to-a-php-form
 */
class ReCaptcha
{

    /**
     * @internal Start reCAPTCHA test
     * @param 
     * @return bool
     */
    public function test()
    {
        // Check if form was submitted:
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response'])) {

            // Build POST request:
            $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
            $recaptcha_secret = $_ENV['API_KEY_RECAPTCHA'];
            $recaptcha_response = $_POST['recaptcha_response'];

            // Make and decode POST request:
            $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
            $recaptcha = json_decode($recaptcha);

            // Take action based on the score returned:
            if(isset($recaptcha->score)){
                if ($recaptcha->score >= 0.5) {
                    return true;
                } else {
                    FlashBag::getInstance()->add("red", "ReCAPTCHA detecte la présence d'un robot. Vous n'en êtes pas un ? êtes vous VRAIMENT sûr ? :). Rechargez la page");
                    return false;
                }
            }
            else{
                FlashBag::getInstance()->add("red", "ReCAPTCHA detecte la présence d'un robot. Vous n'en êtes pas un ? êtes vous VRAIMENT sûr ? :). Rechargez la page");
                return false;
            }            
        }
        return false;
    }

}