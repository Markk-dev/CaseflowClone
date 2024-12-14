
const sidebarToggle = document.getElementById('sidebarToggle');
const sidePanel = document.querySelector('.side-panel');

sidebarToggle.addEventListener('click', () => {
    sidePanel.classList.toggle('active');
});

const closePanelBtn = document.getElementById('closePanelBtn');

closePanelBtn.addEventListener('click', () => {
    sidePanel.classList.remove('active');
});

 
