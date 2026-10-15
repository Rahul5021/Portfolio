// Main portfolio interactions. Loaded with defer.
document.addEventListener('DOMContentLoaded', () => {
    'use strict';

    // Navigation: toggle, dismissal, keyboard handling, and breakpoint reset.
    const menuToggle = document.getElementById('menuToggle');
    const navLinks = document.getElementById('navLinks');
    const setMenu = (open) => {
        if (!menuToggle || !navLinks) return;
        menuToggle.classList.toggle('active', open);
        navLinks.classList.toggle('active', open);
        menuToggle.setAttribute('aria-expanded', String(open));
    };
    if (menuToggle && navLinks) {
        setMenu(false);
        menuToggle.addEventListener('click', () => setMenu(!navLinks.classList.contains('active')));
        navLinks.querySelectorAll('a').forEach(link => link.addEventListener('click', () => setMenu(false)));
        document.addEventListener('keydown', event => {
            if (event.key === 'Escape' && navLinks.classList.contains('active')) {
                setMenu(false);
                menuToggle.focus();
            }
        });
        document.addEventListener('click', event => {
            if (!event.target.closest('.custom-navbar')) setMenu(false);
        });
        window.matchMedia('(min-width: 992px)').addEventListener('change', () => setMenu(false));
    }

    // Keep the copyright year current.
    const footer = document.querySelector('footer p');
    if (footer) footer.textContent = `© ${new Date().getFullYear()} Rahul Agrawal. All Rights Reserved.`;

    // Contact form: validation, submission, feedback, and CAPTCHA reset.
    const form = document.getElementById('contactForm');
    if (!form) return;
    const fields = [...form.querySelectorAll('.item')];
    const button = form.querySelector('button[type="submit"]');
    const errorBox = document.getElementById('formError');
    const successBox = document.getElementById('formResponse');
    const normalButtonText = button ? button.textContent : 'Send Message';
    let submitting = false;

    // Custom messages still use the browser's built-in email validity check.
    form.noValidate = true;
    const display = (box, message) => {
        if (!box) return;
        box.textContent = message;
        box.hidden = !message;
        box.setAttribute('role', box === errorBox ? 'alert' : 'status');
    };
    const validate = field => {
        const empty = !field.value.trim();
        const valid = !empty && field.validity.valid;
        const error = field.nextElementSibling;
        field.classList.toggle('is-invalid', !valid);
        field.classList.toggle('is-valid', valid);
        field.setAttribute('aria-invalid', String(!valid));
        if (error && error.classList.contains('error-txt')) {
            error.id = `${field.id}-error`;
            field.setAttribute('aria-describedby', error.id);
            error.textContent = empty ? `Please enter your ${field.name}.` : 'Please enter a valid email address.';
            error.hidden = valid;
        }
        return valid;
    };
    fields.forEach(field => field.addEventListener('input', () => {
        if (field.hasAttribute('aria-invalid')) validate(field);
    }));

    form.addEventListener('submit', async event => {
        event.preventDefault();
        if (submitting) return;
        display(errorBox, '');
        display(successBox, '');
        fields.forEach(field => { field.value = field.value.trim(); });
        const results = fields.map(validate);
        if (results.includes(false)) {
            fields[results.indexOf(false)].focus();
            return;
        }
        const payload = new FormData(form);
        submitting = true;
        form.setAttribute('aria-busy', 'true');
        if (button) { button.disabled = true; button.textContent = 'Sending…'; }
        const controller = new AbortController();
        const timer = window.setTimeout(() => controller.abort(), 20000);
        try {
            const response = await fetch(form.action, {
                method: form.method || 'POST', body: payload,
                headers: { Accept: 'application/json' }, signal: controller.signal
            });
            const result = await response.json();
            if (!response.ok || result.success !== true) throw new Error('Submission rejected');
            form.reset();
            fields.forEach(field => {
                field.classList.remove('is-valid', 'is-invalid');
                field.removeAttribute('aria-invalid');
                const error = field.nextElementSibling;
                if (error && error.classList.contains('error-txt')) error.hidden = true;
            });
            display(successBox, 'Thank you! Your message has been sent successfully.');
            const modal = document.getElementById('successModal');
            if (modal && window.bootstrap && window.bootstrap.Modal) {
                window.bootstrap.Modal.getOrCreateInstance(modal).show();
            }
        } catch (error) {
            display(errorBox, error.name === 'AbortError'
                ? 'The request timed out, so delivery could not be confirmed. Please check your connection before trying again.'
                : 'Your message could not be confirmed as sent. Please try again or email agrawal.rahul.1025@gmail.com.');
        } finally {
            window.clearTimeout(timer);
            // A CAPTCHA response is single-use; obtain a fresh one for another submission.
            if (window.hcaptcha && typeof window.hcaptcha.reset === 'function') {
                try { window.hcaptcha.reset(); } catch (_) { /* Widget may not yet be ready. */ }
            }
            submitting = false;
            form.removeAttribute('aria-busy');
            if (button) { button.disabled = false; button.textContent = normalButtonText; }
        }
    });
});
