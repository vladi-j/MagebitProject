
$(document).ready(function() {
    $('.signup-button').click(function(e){
        var name = $('#signup-name').val();
        var email = $('#signup-email').val();
        var password = $('#signup-password').val();
        var isError = false;

        //Check if name was entered and if it is >2 characters
        if(!name){
            $('#nameError').show();
            $('#nameError').css('display', 'inline-block');
            $('#nameLengthError').css('display', 'none');
            isError = true;
        } else if(name.length < 2){
            $('#nameLengthError').show();
            $('#nameLengthError').css('display', 'inline-block');
            $('#nameError').css('display', 'none');
            isError = true;
        }else {
            $('#nameError').hide();
            $('#nameLengthError').hide();
        }
        if(!email){
            $('#emailSignupError').show();
            $('#emailSignupError').css('display', 'inline-block');
            isError = true;
        } else {
            $('#emailSignupError').hide();
        }

        //Check if password was entered and if it was >6 characters
        if(!password){
            $('#passwordSignupError').show();
            $('#passwordSignupError').css('display', 'inline-block');
            $('#passwordLengthError').css('display', 'none');
            isError = true;
        } else if(password.length < 6){
            $('#passwordLengthError').show();
            $('#passwordLengthError').css('display', 'inline-block');
            $('#passwordSignupError').css('display', 'none');
            isError = true;
        }else {
            $('#passwordSignupError').hide();
            $('#passwordLengthError').hide();
        }
        if(isError == true){
            return false;
        } else {
            $.ajax
            ({
            type: "POST",
            url: "Model/Validation.php",
            data: "name="+name+"&email="+email+"&password="+password
            });
        }
    })

    
    $('.login-button').click(function(e){
        var email = $('#login-email').val();
        var password = $('#login-password').val();
        var isError = false;
        if(!email){
            $('#emailLoginError').show();
            $('#emailLoginError').css('display', 'inline-block');
            isError = true;
        } else {
            $('#emailLoginError').hide();
        }
        if(!password){
            $('#passwordLoginError').show();
            $('#passwordLoginError').css('display', 'inline-block');
            isError = true;
        } else {
            $('#passwordLoginError').hide();
        }
        if(isError == true){
            return false;
        } else {
            $.ajax
            ({
            type: "POST",
            url: "Model/Validation.php",
            data: "email="+email+"&password="+password
            });
        }
    })

//Login email animation
var loginEmailInput = document.getElementById("login-email");
var loginEmailHeader = document.getElementById("loginEmailHeader");
var loginEmailHeaderStyle = loginEmailHeader.innerHTML;
var loginEmailIcon = document.getElementById("login-email-img");
loginEmailInput.addEventListener("focus", function () {
    loginEmailHeader.style.fontSize = "10px";
    loginEmailHeader.style.fontWeight = "700";
    loginEmailHeader.innerHTML = loginEmailHeader.innerHTML.toUpperCase();
    loginEmailIcon.src= "View/img/email-img-active.png";
});

loginEmailInput.addEventListener("blur", function () {
    loginEmailHeader.style.fontSize = "1rem";
    loginEmailHeader.style.fontWeight = "400";
    loginEmailHeader.innerHTML = loginEmailHeaderStyle;
    loginEmailIcon.src = "View/img/email-img.png";
});

//Login passsword animation
var loginPasswordInput = document.getElementById("login-password");
var loginPasswordHeader = document.getElementById("loginPasswordHeader");
var loginPasswordHeaderStyle = loginPasswordHeader.innerHTML;
var loginPasswordIcon = document.getElementById("login-password-img");
loginPasswordInput.addEventListener("focus", function () {
    loginPasswordHeader.style.fontSize = "10px";
    loginPasswordHeader.style.fontWeight = "700";
    loginPasswordHeader.innerHTML = loginPasswordHeader.innerHTML.toUpperCase();
    loginPasswordIcon.src= "View/img/password-img-active.png";
});

loginPasswordInput.addEventListener("blur", function () {
    loginPasswordHeader.style.fontSize = "1rem";
    loginPasswordHeader.style.fontWeight = "400";
    loginPasswordHeader.innerHTML = loginPasswordHeaderStyle;
    loginPasswordIcon.src = "View/img/password-img.png";
});

//Signup name animation
    var nameInput = document.getElementById("signup-name");
    var nameHeader = document.getElementById("nameHeader");
    var nameHeaderStyle = nameHeader.innerHTML;
    var nameIcon = document.getElementById("name-img");
    nameInput.addEventListener("focus", function () {
        nameHeader.style.fontSize = "10px";
        nameHeader.style.fontWeight = "700";
        nameHeader.innerHTML = nameHeader.innerHTML.toUpperCase();
        nameIcon.src= "View/img/name-img-active.png";
    });

    nameInput.addEventListener("blur", function () {
        nameHeader.style.fontSize = "1rem";
        nameHeader.style.fontWeight = "400";
        nameHeader.innerHTML = nameHeaderStyle;
        nameIcon.src = "View/img/name-img.png";
    });

    //Signup email animation
    var emailInput = document.getElementById("signup-email");
    var emailHeader = document.getElementById("signupEmailHeader");
    var emailHeaderStyle = emailHeader.innerHTML;
    var emailIcon = document.getElementById("signup-email-img");
    emailInput.addEventListener("focus", function () {
        emailHeader.style.fontSize = "10px";
        emailHeader.style.fontWeight = "700";
        emailHeader.innerHTML = emailHeader.innerHTML.toUpperCase();
        emailIcon.src= "View/img/email-img-active.png";
    });

    emailInput.addEventListener("blur", function () {
        emailHeader.style.fontSize = "1rem";
        emailHeader.style.fontWeight = "400";
        emailHeader.innerHTML = emailHeaderStyle;
        emailIcon.src = "View/img/email-img.png";
    });

    //Signup passsword animation
    var passwordInput = document.getElementById("signup-password");
    var passwordHeader = document.getElementById("signupPasswordHeader");
    var passwordHeaderStyle = passwordHeader.innerHTML;
    var passwordIcon = document.getElementById("signup-password-img");
    passwordInput.addEventListener("focus", function () {
        passwordHeader.style.fontSize = "10px";
        passwordHeader.style.fontWeight = "700";
        passwordHeader.innerHTML = passwordHeader.innerHTML.toUpperCase();
        passwordIcon.src= "View/img/password-img-active.png";
    });

    passwordInput.addEventListener("blur", function () {
        passwordHeader.style.fontSize = "1rem";
        passwordHeader.style.fontWeight = "400";
        passwordHeader.innerHTML = passwordHeaderStyle;
        passwordIcon.src = "View/img/password-img.png";
    });
});




function fadeIn(el){
    el.classList.add('show');
    el.classList.remove('hide');  
}
  
function fadeOut(el){
    el.classList.add('hide');
    el.classList.remove('show');
}

function signUpClick(){
    document.getElementById("active-login-section").classList.remove("offset-lg-6");
    document.getElementById("upper-fold").classList.remove("col-lg-1");
    document.getElementById("upper-fold").classList.remove("offset-lg-5");
    document.getElementById("lower-fold").classList.remove("col-lg-1");
    document.getElementById("lower-fold").classList.remove("offset-lg-5");
    document.getElementById("active-box").classList.remove("ml-lg-n3");

    document.getElementById("active-login-section").classList.add("offset-lg-2");
    document.getElementById("upper-fold").classList.add("col-lg-2");
    document.getElementById("upper-fold").classList.add("ml-lg-3");
    document.getElementById("lower-fold").classList.add("col-lg-2");
    document.getElementById("lower-fold").classList.add("ml-lg-3");
    document.getElementById("active-box").classList.remove("ml-lg-0");

    document.getElementById("login-box").style.zIndex = "-1"
    document.getElementById("signup-box").style.zIndex = "1"

    fadeOut(document.getElementById("login-box"));
    fadeIn(document.getElementById("signup-box"));
}

function loginClick(){
    document.getElementById("active-login-section").classList.remove("offset-lg-2");
    document.getElementById("upper-fold").classList.remove("col-lg-2");
    document.getElementById("upper-fold").classList.remove("ml-lg-3");
    document.getElementById("lower-fold").classList.remove("col-lg-2");
    document.getElementById("lower-fold").classList.remove("ml-lg-3");

    document.getElementById("active-login-section").classList.add("offset-lg-6");
    document.getElementById("upper-fold").classList.add("col-lg-1");
    document.getElementById("upper-fold").classList.add("offset-lg-5");
    document.getElementById("lower-fold").classList.add("col-lg-1");
    document.getElementById("lower-fold").classList.add("offset-lg-5");
    document.getElementById("active-box").classList.add("ml-lg-n3");

    document.getElementById("login-box").style.zIndex = "1"
    document.getElementById("signup-box").style.zIndex = "-1"

    fadeOut(document.getElementById("signup-box"));
    fadeIn(document.getElementById("login-box"));
}


