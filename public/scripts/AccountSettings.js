class AccountSettings {
    constructor(userData) {
        this.userData = userData; 
        this.accountSettingsSection = document.getElementById('accountSettingsSection');
    }

    populateAccountSettings() {
        const { fname, lname, email } = this.userData;

        this.accountSettingsSection.innerHTML = `
            <h5>Your Profile</h5>
            <p><strong>Name:</strong> ${fname} ${lname}</p>
            <p><strong>Email:</strong> ${email}</p>
            <p><strong>Total Cases Participated:</strong> Placeholder</p>
            <hr>
            <h5>Manage Account</h5>
            <button class="btn btn-sm btn-primary mt-2">Change Password</button>
            <button class="btn btn-sm btn-primary mt-2">Update Profile Picture</button>
            <button class="btn btn-sm btn-primary mt-2">Configure Email Preferences</button>
        `;
    }
}


document.addEventListener('DOMContentLoaded', async () => {
    const userData = await fetchUserData();

    
    const accountSettings = new AccountSettings(userData);

    
    const sidebarToggle = document.getElementById('sidebarToggle');
    sidebarToggle.addEventListener('click', () => {
        accountSettings.populateAccountSettings();
    });
});


async function fetchUserData() {
    const response = await fetch('/user/getUserData'); 
    return await response.json();
}
