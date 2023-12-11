<?php

namespace App\DesignPatterns\Users;

class WriterUserTYpe implements BaseUserType
{

    public function getInformation():array
    {
        return [
            'type'=>'writer'
        ];
    }

    public function display_user_type()
    {
        return 'writer';
    }
}
