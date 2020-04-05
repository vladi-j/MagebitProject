
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
});

function signUpNameInput(){
    
}
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


