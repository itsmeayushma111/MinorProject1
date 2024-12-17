document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('password');
    const showPasswordIcon = document.getElementById('showPassword');

    showPasswordIcon.onclick = function(){
        if(passwordInput.type == "password"){
            passwordInput.type = "text";
            showPasswordIcon.src ="eye-open.png";
        }else{
            passwordInput.type = "password";
            showPasswordIcon.src ="eye-closed.png";
        }
    }
});
