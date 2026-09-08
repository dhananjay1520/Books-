document.addEventListener('DOMContentLoaded', () => {
    // --- (Aapka pehle ka toggle-password wala code yahan rahega) ---
    const toggleIcons = document.querySelectorAll('.toggle-password');
    toggleIcons.forEach(icon => {
        icon.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const passwordInput = document.getElementById(targetId);
            if (passwordInput) {
                const isPassword = passwordInput.getAttribute('type') === 'password';
                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                this.classList.toggle('uil-eye-slash');
                this.classList.toggle('uil-eye');
            }
        });
    });

    // ==========================================
    // NAYA CODE: Password Validation Feature
    // ==========================================
    const passwordInput = document.getElementById('password');
    const ruleLength = document.getElementById('rule-length');
    const ruleCapital = document.getElementById('rule-capital');
    const ruleSpecial = document.getElementById('rule-special');
    const signupForm = document.getElementById('form');

    if (passwordInput) {
        // User jaise hi type karega, ye check karega
        passwordInput.addEventListener('input', function() {
            const val = this.value;

            // 1. Check Length (8 ya usse zyada characters)
            if (val.length >= 8) {
                ruleLength.className = 'valid';
                ruleLength.innerHTML = '✓ 8 characters';
            } else {
                ruleLength.className = 'invalid';
                ruleLength.innerHTML = '✗ 8 characters';
            }

            // 2. Check Capital Letter (A-Z)
            if (/[A-Z]/.test(val)) {
                ruleCapital.className = 'valid';
                ruleCapital.innerHTML = '✓ 1 Uppercase';
            } else {
                ruleCapital.className = 'invalid';
                ruleCapital.innerHTML = '✗ 1 Uppercase';
            }

            // 3. Check Special Character (@, #, $, etc.)
            if (/[!@#$%^&*(),.?":{}|<>]/.test(val)) {
                ruleSpecial.className = 'valid';
                ruleSpecial.innerHTML = '✓ 1 Special Char';
            } else {
                ruleSpecial.className = 'invalid';
                ruleSpecial.innerHTML = '✗ 1 Special Char';
            }
        });

        // Agar password galat hai toh form submit hone se rokna
        if (signupForm) {
            signupForm.addEventListener('submit', function(event) {
                const val = passwordInput.value;
                const isValid = val.length >= 8 && /[A-Z]/.test(val) && /[!@#$%^&*(),.?":{}|<>]/.test(val);
                
                if (!isValid) {
                    event.preventDefault(); // Form submit rok dega
                    alert("Please ensure your password meets all the security requirements (8 chars, 1 Capital, 1 Special).");
                }
            });
        }
    }
});

function checkPasswordMatch() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("cpassword").value;
    var errorMsg = document.getElementById("password-match-error");
    var confirmBox = document.getElementById("confirm-box");

    if (password !== confirmPassword && confirmPassword !== "") {
        // Triggers the styles already set up in auth-theme.css
        errorMsg.style.display = "block"; 
        confirmBox.classList.add("error-password-confirm"); 
    } else {
        errorMsg.style.display = "none";
        confirmBox.classList.remove("error-password-confirm"); 
    }
}