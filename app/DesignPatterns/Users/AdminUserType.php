<?php

namespace App\DesignPatterns\Users;

class AdminUserType implements BaseUserType
{

    public function getInformation():array
    {
        return [
            'type'=>'admin'
        ];
    }

    public function display_user_type()
    {
        return 'admin';
    }
}
