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


