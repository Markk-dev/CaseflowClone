<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class CaseModel extends Model
    {
        protected $table = 'cases';
        protected $primaryKey = 'id';
        protected $allowedFields = ['case_type', 'description', 'case_priority', 'progress', 'location', 'user_id', 'created_by', 'created_at', 'updated_at'];
        protected $useTimestamps = true;

        protected $validationRules = [
            'case_type'    => 'required|max_length[100]',
            'description'  => 'required',
            'case_priority' => 'required|in_list[High,Medium,Low]',
        ];

        protected $validationMessages = [
            'case_type' => [
                'required' => 'Case type is required.',
                'max_length' => 'Case type must not exceed 100 characters.',
            ],
            'description' => [
                'required' => 'Description is required.',
            ],
            'case_priority' => [
                'required' => 'Priority is required.',
                'in_list' => 'Priority must be one of: High, Medium, Low.',
            ],
        ];

        public function getCaseWithCreator($id)
        {
            return $this->where('id', $id)->first();
        }

        public function isCreator($caseId, $userId)
        {
            $case = $this->getCaseWithCreator($caseId);
            return $case && $case['user_id'] == $userId;  // Check if the user is the creator
        }

        public function countCompletedCases()
        {
            return $this->where('progress', 'Complete')->countAllResults();
        }

        public function getCasesByPriority()
        {
            return $this->orderBy('FIELD(case_priority, "High", "Medium", "Low")', 'ASC')->findAll();
        }
    }
