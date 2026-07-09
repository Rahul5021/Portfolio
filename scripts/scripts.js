const menuToggle = document.getElementById('menuToggle');
const navLinks = document.getElementById('navLinks');

menuToggle.addEventListener('click', () => {
    navLinks.classList.toggle('active');
    menuToggle.classList.toggle('active'); // Toggle the cross appearance
    const isExpanded = navLinks.classList.contains('active');
    menuToggle.setAttribute('aria-expanded', isExpanded);
});
const contactForm = document.getElementById('contactForm');

contactForm.addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent default form submission

    const form = event.target;
    const formData = new FormData(form);
    const inputs = form.querySelectorAll('.item'); // Select all input and textarea fields
    let isValid = true; // Flag to check if the form is valid

    // Validate each input field
    inputs.forEach((input) => {
        const errorText = input.nextElementSibling; // Get the corresponding error message
        if (!input.value.trim()) {
            // If the field is empty, show the error and apply styles
            input.style.borderColor = 'red';
            errorText.style.display = 'block';
            isValid = false;
        } else {
            input.style.borderColor = '#28a745';
            errorText.style.display = 'none';
        }
    });

    // If all fields are valid, proceed with form submission
    if (isValid) {
        fetch(form.action, {
            method: form.method,
            body: formData,
            headers: {
                'Accept': 'application/json'
            }
        }).then(response => {
            if (response.ok) {
                // Show the Bootstrap modal on success
                const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
                form.reset(); // Optional: Clear the form fields
            } else {
                alert('There was a problem with the form submission. Please try again.');
            }
        }).catch(error => {
            console.error('Error:', error);
            alert('There was an error submitting the form. Please try again.');
        });
    }
});

// Real-time validation: Reset or apply errors as the user types in an input
const inputs = contactForm.querySelectorAll('.item');
inputs.forEach((input) => {
    input.addEventListener('input', () => {
        const errorText = input.nextElementSibling;

        if (input.value.trim()) {
            // Reset error styles if the input is not empty
            input.style.borderColor = '#28a745'; // Reset to original color
            errorText.style.display = 'none';
        } else {
            // If the input is empty again, reapply error styles
            input.style.borderColor = 'red';
            errorText.style.display = 'block';
        }
    });
});

document.querySelector('footer p').innerHTML = `&copy; ${new Date().getFullYear()} Rahul Agrawal. All Rights Reserved.`;
