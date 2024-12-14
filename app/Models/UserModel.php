<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {
    protected $table = 'users';
    protected $allowedFields = ['lname', 'fname', 'email', 'password', 'role', 'profile_picture', 'email_preferences'];
}