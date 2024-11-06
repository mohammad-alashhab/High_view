document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('reset-password-form');
    const emailInput = document.getElementById('email');
    const emailError = document.getElementById('emailError');

    // Regular expression for email validation
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    // Validate email function
    function validateEmail() {
        const email = emailInput.value.trim();
        
        if (email === '') {
            setError(emailError, 'Email is required');
            return false;
        } else if (!emailRegex.test(email)) {
            setError(emailError, 'Please enter a valid email address');
            return false;
        } else {
            setError(emailError, '');
            return true;
        }
    }

    // Function to set error message
    function setError(element, message) {
        element.textContent = message;
        element.style.display = message ? 'block' : 'none';
    }

    // Real-time email validation
    emailInput.addEventListener('input', validateEmail);

    // Form submission handler
    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        // Perform validation
        if (!validateEmail()) {
            return;
        }

        // Show loading indicator
        Swal.fire({
            title: 'Sending...',
            text: 'Please wait while we send the verification code.',
            didOpen: () => Swal.showLoading(),
            allowOutsideClick: false,
        });

        try {
            const formData = new FormData();
            formData.append('action', 'send_code');
            formData.append('email', emailInput.value.trim());

            const response = await fetch('controllers/controllerUserData.php', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'A verification code has been sent to your email.',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    window.location.href = '/resetcode';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message || 'Something went wrong!',
                    confirmButtonColor: '#3085d6'
                });
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred. Please try again later.',
                confirmButtonColor: '#3085d6'
            });
        }
    });
});
