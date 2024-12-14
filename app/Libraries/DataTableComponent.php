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
            return '<tr><td colspan="6" class="text-center">No cases found</td></tr>';
        }
    
        $counter = 1;
        $rows = '';
    
        // Get the logged-in user's ID from the session
        $loggedInUserId = session()->get('user_id');
    
        foreach ($cases as $case) {
            $severityComponent = $this->getSeverityComponent($case['severity']);  // Updated to use 'severity'
    
            // Check if the logged-in user created the case (now using user_id)
            $isCreator = $loggedInUserId == $case['user_id'];  // Switch to user_id
    
            $editButton = $isCreator
                ? '<a href="' . base_url('cases/edit/' . $case['id']) . '" class="editBtn" style="color: var(--highlightGreen); cursor: pointer;">Edit</a>'
                : '<span class="editBtn" style="color: slategray; cursor: not-allowed;">Edit</span>';
    
            // Here’s where the dynamic rows are generated for each offense
            $rows .= '
                <tr>
                    <td>' . esc($counter++) . '</td>
                    <td>' . esc($case['offense_type']) . '</td>
                    <td class="DescConst">' . esc($case['description']) . '</td>
                    <td class="locationVar">' . esc($case['location']) . '</td>
                    <td>' . $severityComponent . '</td> <!-- Updated to severity -->
                    <td>
                        <div class="actionBtns">
                            ' . $editButton . '
                            <a href="' . base_url('cases/delete/' . $case['id']) . '" class="deleteBtn" style="color: var(--red); cursor: pointer;">Delete</a>
                        </div>
                    </td>
                </tr>
            ';
        }
    
        return $rows;
    }
        
    /**
     * Get the severity capsule component based on the severity level.
     *
     * @param string $severity
     * @return string
     */
    private function getSeverityComponent(string $severity): string
    {
        switch (strtolower($severity)) {
            case '1st':
                return '
                    <div class="HighCapsule">
                        <span class="material-symbols-outlined" style="color: var(--red); font-size: 1rem">warning</span>
                        <p class="highPriority">1st Offense</p>
                    </div>
                ';
            case '2nd':
                return '
                    <div class="MediumCapsule">
                        <span class="material-symbols-outlined" style="color: var(--blue); font-size: 1rem">error</span>
                        <p class="mediumPriority">2nd Offense</p>
                    </div>
                ';
            case '3rd':
                return '
                    <div class="LowCapsule">
                        <span class="material-symbols-outlined" style="color: var(--green); font-size: 1rem">priority_high</span>
                        <p class="lowPriority">3rd Offense</p>
                    </div>
                ';
            default:
                return '<p>Unknown Case Severity</p>';
        }
    }
}
?>
