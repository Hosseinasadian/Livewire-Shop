<?php

namespace App\DesignPatterns\Users;

class ManagerUserType implements BaseUserType
{

    public function getInformation():array
    {
        return [
            'type'=>'manager'
        ];
    }

    public function display_user_type()
    {
        return 'manager';
    }
}
