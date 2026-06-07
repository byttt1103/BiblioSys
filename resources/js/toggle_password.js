document.getElementById('togglePassword').addEventListener('click', function () {
    const passwordInputs = document.querySelectorAll('.password');

    passwordInputs.forEach(input => {
        input.type = input.type === 'password' ? 'text' : 'password';
    });

    this.textContent = passwordInputs[0].type === 'password' ? '🙈' : '🙉';
});
