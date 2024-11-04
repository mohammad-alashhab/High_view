logoutButton.addEventListener("click", async function () {
    try {
        const response = await fetch('/logout', { method: 'POST' });
        if (response.ok) {
            const data = await response.json(); // Parse JSON response
            if (data.success) {
                isLoggedIn = false; // Update login status
                updateButtonVisibility(); // Update button visibility
                window.location.reload(); // Refresh the page
            } else {
                console.error("Logout failed:", data.message);
            }
        } else {
            console.error("Logout failed");
        }
    } catch (error) {
        console.error("Error during logout:", error);
    }
});
