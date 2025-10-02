document.addEventListener('DOMContentLoaded', () => {

    const passwordInput = document.getElementById('password');
    const confirmationInput = document.getElementById('password_confirmation');
    const passwordRulesContainer = document.getElementById('password_rules');

    const checks =
    {
        length: document.getElementById('length'),
        uppercase: document.getElementById('uppercase'),
        lowercase: document.getElementById('lowercase'),
        number: document.getElementById('number'),
        symbol: document.getElementById('symbol')
    };

    const matchCheck = document.getElementById('match');

    passwordInput.addEventListener('focus', () => {
        passwordRulesContainer.style.display = 'block';
    });

    passwordInput.addEventListener('blur', () => {
        if (passwordInput.value.length === 0) {
            passwordRulesContainer.style.display = 'none';
        }
    });


    function validatePassword() {
        const password = passwordInput.value;
        const confirmation = confirmationInput.value;

        updateCheckUI(checks.length, password.length >= 8);
        updateCheckUI(checks.uppercase, /[A-Z]/.test(password));
        updateCheckUI(checks.lowercase, /[a-z]/.test(password));
        updateCheckUI(checks.number, /\d/.test(password));
        updateCheckUI(checks.symbol, /[\W_]/.test(password));

        if (confirmation.length > 0) {
            matchCheck.style.display = 'block';
            const passwordsMatch = password !== '' && password === confirmation;
            updateCheckUI(matchCheck, passwordsMatch, "The passwords match", "The passwords doesn't match");
        }
        else {
            matchCheck.style.display = 'none';
        }
    }

    function updateCheckUI(element, isValid, validText, invalidText) {
        const originalText = element.dataset.originalText || element.innerText;
        if (!element.dataset.originalText) {
            element.dataset.originalText = originalText;
        }

        const icon = isValid ? '<span>✓</span>' : '<span>✗</span>';
        element.className = isValid ? 'text-sprout/75' : 'text-red-500/50';

        if (isValid) {
            element.innerHTML = `${icon} ${validText || originalText}`;
        } else {
            element.innerHTML = `${icon} ${invalidText || originalText}`;
        }
    }

    passwordInput.addEventListener('input', validatePassword);
    confirmationInput.addEventListener('input', validatePassword);
});