<?php

namespace App\Models;


class InteractionType
{
    const IN_PERSON = 'in_person';
    const EMAIL     = 'email';
    const PHONE     = 'phone';
    const SMS       = 'sms';

    public static function all()
    {
        return [
            self::IN_PERSON,
            self::EMAIL,
            self::PHONE,
            self::SMS
        ];
    }

}
