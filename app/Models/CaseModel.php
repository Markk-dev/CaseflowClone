<?php

namespace App\Models;

use CodeIgniter\Model;

class CaseModel extends Model
{
    
    protected $table = 'offense';  
    protected $primaryKey = 'id';

    
    protected $allowedFields = [
        'offense_type', 'name', 'description', 'severity', 'progress', 'location', 
        'user_id', 'created_by', 'created_at', 'updated_at'
    ];

    
    protected $useTimestamps = true;

    
    protected $validationRules = [
        'offense_type'    => 'required|max_length[100]',  
        'name'            => 'required|max_length[255]',  
        'description'     => 'required',  
        'severity'        => 'required|in_list[1st,2nd,3rd]',  
    ];

    
    protected $validationMessages = [
        'offense_type' => [
            'required' => 'Offense type is required.',
            'max_length' => 'Offense type must not exceed 100 characters.',
        ],
        'name' => [
            'required' => 'Offense name is required.',
            'max_length' => 'Offense name must not exceed 255 characters.',
        ],
        'description' => [
            'required' => 'Description is required.',
        ],
        'severity' => [
            'required' => 'Severity is required.',
            'in_list' => 'Severity must be one of: 1st, 2nd, 3rd.',
        ],
    ];

    
    public function getOffenseWithCreator($id)
    {
        return $this->where('id', $id)->first();
    }

    
    public function isCreator($offenseId, $userId)
    {
        $offense = $this->getOffenseWithCreator($offenseId);
        return $offense && $offense['user_id'] == $userId;  
    }

    
    public function countCompletedOffenses()
    {
        return $this->where('progress', 'Complete')->countAllResults();
    }

    
    public function getOffensesBySeverity()
    {
        return $this->orderBy('FIELD(severity, "1st", "2nd", "3rd")', 'ASC')->findAll();
    }

    public function getTotalOffenses()
    {
        return $this->countAllResults(); 
    }

    public function getHighOffenses()
    {
        return $this->where('severity', '1st')->countAllResults(); 
    }
}
