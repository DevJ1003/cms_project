<?php

class Config
{
    function __construct()
    {
        $provider = "gmail";

        if ($provider == "mailtrap") {
            $this->SMTP_HOST = 'smtp.mailtrap.io';

            $this->SMTP_PORT = '2525';

            $this->SMTP_USER = 'df02dc207b626e';

            $this->SMTP_PASSWORD = '85e269fd04668b';
        } else if ($provider == "gmail") {
            $this->SMTP_HOST = 'smtp.gmail.com';

            $this->SMTP_PORT = '587';

            $this->SMTP_USER = 'acmsexample7@gmail.com';

            $this->SMTP_PASSWORD = 'ACMSexample7';
        }
    }
}
