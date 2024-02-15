<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Captcha_lib {

    public function generateCaptcha()
    {
        // Generate random string for captcha
        $captchaStr = $this->generateRandomString(5);

        // Store captcha string in session or database for validation
        $this->storeCaptchaInSession($captchaStr);

        return $captchaStr;
    }

    public function validateCaptcha($userInput)
    {
        // Retrieve captcha string from session or database for validation
        $storedCaptcha = $this->retrieveCaptchaFromSession();

        // Validate user input
        return ($userInput === $storedCaptcha);
    }

    private function generateRandomString($length)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    private function storeCaptchaInSession($captchaStr)
    {
        // Store captcha string in session (you may modify this based on your needs)
        $this->CI =& get_instance();
        $this->CI->session->set_userdata('captcha_str', $captchaStr);
    }

    private function retrieveCaptchaFromSession()
    {
        // Retrieve captcha string from session (you may modify this based on your needs)
        $this->CI =& get_instance();
        return $this->CI->session->userdata('captcha_str') ?? '';
    }
}
