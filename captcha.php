<?php
session_start();

class Captcha
{
    public function generateCaptcha(): bool
    {
        $_SESSION['captcha'] = mt_rand(1000,9999);
        $img = imagecreate(65,30);
        $font = './assets/Destroy.ttf';

        $bg = imagecolorallocate($img,255,255,255);
        $textColor = imagecolorallocate($img, 0, 0, 0);

        imagettftext($img, 23, 0, 3, 30, $textColor, $font, $_SESSION['captcha']);

        return imagejpeg($img);
    }

    public function checkCaptcha($captcha): bool
    {
        if($captcha == $_SESSION['captcha'])
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}