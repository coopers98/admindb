<?php

namespace App\Models;


class InteractionOutcome
{
    const CONTACTED   = 'contacted';
    const NOT_HOME    = 'not_home';
    const NO_ANSWER   = 'no_answer';
    const NO_RESPONSE = 'no_response';

    public static function all()
    {
        return [
            self::CONTACTED,
            self::NOT_HOME,
            self::NO_ANSWER,
            self::NO_RESPONSE
        ];
    }
}
