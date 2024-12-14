<?php
namespace App\Libraries;

class CaseItem
{
    public function render($case, &$counter)
    {
        $priorityComponent = $this->getPriorityComponent($case['case_priority']);
        
        ob_start();
        ?>
         <link rel="stylesheet" href="<?= base_url('styles/global.css') ?>">
        <tr>
            <td><?= esc($counter++); ?></td>
            <td><?= esc($case['case_type']); ?></td>
            <td class="DescVar"><?= esc($case['description']); ?></td>
            <td class="locationVar"><?= esc($case['location']); ?></td>
            <td><?= $priorityComponent; ?></td>
        </tr>
        <?php
        
        return ob_get_clean();
    }

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
