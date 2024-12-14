<?php

namespace App\Models;

use CodeIgniter\Model;

class CompleteCasesModel extends Model
{
    protected $table = 'complete_cases'; 
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'case_id', 'completed_at'];
}