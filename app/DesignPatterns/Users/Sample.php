<?php

namespace App\DesignPatterns\Users;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class Sample
{
    public function showUserInformation($user_type)
    {
/*        $types = [
            'admin'=>AdminUserType::class,
            'writer'=>WriterUserTYpe::class,
            'manager'=>ManagerUserType::class,
        ];
        try {
            return (new $types[$user_type])->getInformation();
        }catch (\Exception $exception){
            throw new \Exception('Invalid User Type');
        }*/

        $type = 'App\DesignPatterns\Users\\' . ucfirst($user_type) . "UserType";
        if (class_exists($type)){
            try {
                return (new $type)->getInformation();
            }catch (\Exception $exception){
                throw new \Exception('Invalid User Type');
            }
        }else{
            throw new \Exception('Invalid User Type');
        }
    }
}
