<?php
namespace App\Libraries;

class DataTableComponent {

    /**
     * Generate table rows dynamically based on case data.
     *
     * @param array $cases
     * @return string
     */
    public function generateTableRows(array $cases): string
    {
        if (empty($cases)) {
            return '<tr><td colspan="5" class="text-center">No cases found</td></tr>';
        }
    
        $counter = 1;
        $rows = '';
    
        // Get the logged-in user's ID from the session
        $loggedInUserId = session()->get('user_id');
    
        foreach ($cases as $case) {
            $priorityComponent = $this->getPriorityComponent($case['case_priority']);
    
            // Check if the logged-in user created the case (now using user_id)
            $isCreator = $loggedInUserId == $case['user_id'];  // Switch to user_id
    
            $editButton = $isCreator
                ? '<a href="' . base_url('cases/edit/' . $case['id']) . '" class="editBtn" style="color: var(--highlightGreen); cursor: pointer;">Edit</a>'
                : '<span class="editBtn" style="color: slategray; cursor: not-allowed;">Edit</span>';
    
            $rows .= '
                <tr>
                    <td>' . esc($counter++) . '</td>
                    <td>' . esc($case['case_type']) . '</td>
                    <td class="DescConst">' . esc($case['description']) . '</td>
                    <td class="locationVar">' . esc(data: $case['location']) . '</td>
                    <td>' . $priorityComponent . '</td>
                    <td>
                        <div class="actionBtns">' . $editButton . '</div>
                    </td>
                </tr>
            ';
        }
    
        return $rows;
    }
    

    /**
     * Get the priority capsule component based on the priority level.
     *
     * @param string $priority
     * @return string
     */
    private function getPriorityComponent(string $priority): string
    {
        switch (strtolower($priority)) {
            case 'high':
                return '
                    <div class="HighCapsule">
                        <span class="material-symbols-outlined" style="color: var(--red); font-size: 1rem">warning</span>
                        <p class="highPriority">High</p>
                    </div>
                ';
            case 'medium':
                return '
                    <div class="MediumCapsule">
                        <span class="material-symbols-outlined" style="color: var(--blue); font-size: 1rem">error</span>
                        <p class="mediumPriority">Medium</p>
                    </div>
                ';
            case 'low':
                return '
                    <div class="LowCapsule">
                        <span class="material-symbols-outlined" style="color: var(--green); font-size: 1rem">priority_high</span>
                        <p class="lowPriority">Low</p>
                    </div>
                ';
            default:
                return '<p>Unknown Case Priority</p>';
        }
    }
}
