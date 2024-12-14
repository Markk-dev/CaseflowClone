document.addEventListener('DOMContentLoaded', () => {
    const searchField = document.getElementById('searchField');
    const filterPriority = document.getElementById('filterPriority');
    const tableRows = document.querySelectorAll('tbody tr');
    const tableBody = document.querySelector('tbody'); 

    function filterTable() {
        const searchValue = searchField.value.toLowerCase();
        const priorityValue = filterPriority.value;
        let visibleRows = 0; 

        tableRows.forEach(row => {
            const description = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            const location = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
            const priority = row.querySelector('td:nth-child(5)').textContent;
            const case_type = row.querySelector('td:nth-child(2)').textContent.toLowerCase();

            // Properly combine the conditions for matchesSearch
            const matchesSearch =
                description.includes(searchValue) || 
                location.includes(searchValue) || 
                case_type.includes(searchValue);
            

            if (
                matchesSearch &&
                (priorityValue === '' || priority.includes(priorityValue))
            ) {
                row.style.display = '';
                visibleRows++;
            } else {
                row.style.display = 'none';
            }
        });

        // Handle no matching rows
        if (visibleRows === 0) {
            if (!document.getElementById('noCasesMessage')) {
                const noCasesRow = document.createElement('tr');
                noCasesRow.id = 'noCasesMessage';
                noCasesRow.innerHTML = `
                    <td colspan="6" class="text-center text-muted">No cases found</td>
                `;
                tableBody.appendChild(noCasesRow);
            }
        } else {
            const noCasesMessage = document.getElementById('noCasesMessage');
            if (noCasesMessage) noCasesMessage.remove(); 
        }
    }

    // Attach event listeners
    searchField.addEventListener('input', filterTable);
    filterPriority.addEventListener('change', filterTable);
});
