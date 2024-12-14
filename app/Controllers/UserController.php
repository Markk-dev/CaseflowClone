<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    public function getUserData()
    {
        $userModel = new UserModel();
        $userId = session()->get('user_id');  
        $userData = $userModel->find($userId);  
    
        return $this->response->setJSON($userData);
    }
    
}
 