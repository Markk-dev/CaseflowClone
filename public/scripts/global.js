document.addEventListener('DOMContentLoaded', () => {
    const dropdownItems = document.querySelectorAll('.dropdown-item');
    const button = document.querySelector('.dropdown-toggle');
  
    dropdownItems.forEach((item) => {
      item.addEventListener('click', (e) => {
        e.preventDefault(); // Prevent default anchor behavior
  
        // Update button text to selected value
        const selectedValue = item.getAttribute('data-value');
        button.textContent = selectedValue;
  
        // Perform any additional actions based on the selection
        console.log('Selected Time Range:', selectedValue);
      });
    });
  });
  
  document.addEventListener('DOMContentLoaded', () => {
    const mainContent = document.getElementById('main-content');
    mainContent.classList.add('page-transition', 'show');
});
