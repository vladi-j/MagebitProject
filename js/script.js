function signUpClick(){
    document.getElementById("active-login-section").classList.remove("offset-lg-6");
    document.getElementById("upper-fold").classList.remove("col-lg-1");
    document.getElementById("upper-fold").classList.remove("offset-lg-5");
    document.getElementById("lower-fold").classList.remove("col-lg-1");
    document.getElementById("lower-fold").classList.remove("offset-lg-5");
    document.getElementById("login-box").classList.remove("ml-lg-n3");

    document.getElementById("active-login-section").classList.add("offset-lg-2");
    document.getElementById("upper-fold").classList.add("col-lg-2");
    document.getElementById("upper-fold").classList.add("ml-lg-3");
    document.getElementById("lower-fold").classList.add("col-lg-2");
    document.getElementById("lower-fold").classList.add("ml-lg-3");
    document.getElementById("login-box").classList.remove("ml-lg-2");
    console.log("In function")
}