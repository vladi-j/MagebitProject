<?php
ob_start();
require_once('core/init.php');
new Validation();
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>
    <link rel="stylesheet" href="View/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;700&display=swap" rel="stylesheet">
    <script src="View/js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Background -->
            <div class="authentication-background col-lg-8 mx-auto"></div>
            <!-- Inactive SIGNUP part -->
            <div class="container position-absolute col-lg-4 offset-lg-2">
                <div class="inactive-section">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <h2 class="inactive-header">Don't have an account?</h2>
                        </div>
                    </div>
                    <div class="offset-lg-2 pl-2">                    
                        <hr class="line-divisor">
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <p class="inactive-section-abstract">
                                Lorem ipsum dolor sit amet,
                                <br>
                                 consectetur adipiscing elit, sed do
                                 <br>
                                 eiusmod tempor incididunt ut labore et
                                 <br>
                                  dolore magna aliqua.
                            </p>
                        </div>
                    </div>
                    <div class="offset-lg-2 pl-2">
                        <button type="submit" class="btn btn-lg inactive-button inactive-signup-button" onclick="signUpClick()">SIGN UP</button>
                    </div>
                </div>  
            </div>  
            <div id="active-login-section" class="container position-absolute col-lg-4 offset-lg-6"><!--Change to col-lg-4 offset-lg-2-->
                <div id="active-box" class="ml-lg-n3">
                    <div id="login-box" class="ml-lg-n2 position-absolute col-lg-12"> <!--Change to ml-lg-2-->
                        <!-- Active LOGIN section -->
                        <div class="row justify-content-center">
                            <div class="col-lg-3">
                                <h2 class="login-header">Login</h2>
                            </div> 
                            <div class="col-lg-2 offset-lg-3">
                                <img class="float-right" src="View/img/logo.jpg" alt="MAGEBIT">
                            </div> 
                        </div>
                        <div class="offset-lg-2 pl-2">                    
                            <hr class="line-divisor">
                        </div>
                        <form id="login-form" action="auth.php" method="post">
                            <!--Display errors -->
                            <?php include('Controller/loginErrors.php'); ?>
                            <div class="row justify-content-center">
                                <div class="col-lg-3 email-header">
                                    <label for="login-email-input">Email <span class="red-star">*</span></label>
                                </div>
                                <div class="col-lg-2 offset-lg-3">
                                    <img class="float-right email-img" src="View/img/email-img.png" alt="E-mail">
                                </div> 
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <input type="email" name="login-email" class="login-email-input" value="<?php echo Validation::$loginEmail;?>">
                                </div>
                            </div>
                            <div class="row justify-content-center password-section">
                                <div class="col-lg-4 password-header">
                                    <label for="login-password-input">Password <span class="red-star">*</span></label>
                                </div>
                                <div class="col-lg-2 offset-lg-2">
                                    <img class="float-right password-img" src="View/img/password-img.png" alt="E-mail">
                                </div> 
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <input type="password" name="login-password" class="login-password-input" value="">
                                </div>                        
                            </div>
                            <div class="row justify-content-center button-section">
                                <div class="col-lg-4">
                                    <button type="submit" class="btn btn-lg login-button" name="login-form">LOGIN</button>
                                </div>
                                <div class="col-lg-2 offset-lg-2 forgot-link">
                                    <h7>Forgot?</h7>
                                </div>
                            </div> 
                        </form>                        
                    </div>
                    <!-- Active SIGNUP section -->
                    <div id="signup-box" class="ml-lg-n2 position-absolute col-lg-12 hide"> <!--Change to ml-lg-2-->
                        <div class="row justify-content-center">
                            <div class="col-lg-4">
                                <h2 class="signup-header">Sign Up</h2>
                            </div> 
                            <div class="col-lg-2 offset-lg-2">
                                <img class="float-right" src="View/img/logo.jpg" alt="MAGEBIT">
                            </div> 
                        </div>
                        <div class="offset-lg-2 pl-2">                    
                            <hr class="line-divisor">
                        </div>
                        <form id="signup-form" action="auth.php" method="post">
                            <!--Display errors-->
                            <?php include('Controller/signUpErrors.php'); ?>
                            <div class="row justify-content-center">
                                <div class="col-lg-3 name-header">
                                    <label for="name-input">Name <span class="red-star">*</span></label>
                                </div>
                                <div class="col-lg-2 offset-lg-3">
                                    <img class="float-right name-img" src="View/img/name-img.png" alt="Name">
                                </div> 
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <input type="text" name="signup-name" class="name-input" value="<?php echo Validation::$signUpName; ?>">
                                </div>                        
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-3 email-header">
                                    <label for="signup-email-input">Email <span class="red-star">*</span></label>
                                </div>
                                <div class="col-lg-2 offset-lg-3">
                                    <img class="float-right email-img" src="View/img/email-img.png" alt="E-mail">
                                </div> 
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <input type="email" name="signup-email" class="signup-email-input" value="<?php echo Validation::$signUpEmail; ?>">
                                </div>
                            </div>
                            <div class="row justify-content-center password-section">
                                <div class="col-lg-4 password-header">
                                    <label for="signup-password-input">Password <span class="red-star">*</span></label>
                                </div>
                                <div class="col-lg-2 offset-lg-2">
                                    <img class="float-right password-img" src="View/img/password-img.png" alt="E-mail">
                                </div> 
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <input type="password" name="signup-password" class="signup-password-input" value="<?php echo Validation::$signUpPassword; ?>">
                                </div>                        
                            </div>                        
                            <div class="row justify-content-center button-section">
                                <div class="col-lg-4">
                                    <button type="submit" class="btn btn-lg signup-button" name="sign-up">SIGN UP</button>
                                </div>
                                <div class="col-lg-2 offset-lg-2 forgot-link">
                                    <h7>Forgot?</h7>
                                </div>
                            </div> 
                        </form>   
                    </div>
                </div>

            </div>
            <!-- Inactive LOGIN section -->
            <div class="container position-absolute col-lg-4 offset-lg-6 inactive-section">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <h2 class="inactive-header">Have an account?</h2>
                        </div>
                    </div>
                    <div class="offset-lg-2 pl-2">                    
                        <hr class="line-divisor">
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <p class="inactive-section-abstract">
                                Lorem ipsum dolor sit amet consectetur
                                <br>
                                adipiscing elit.
                            </p>
                        </div>
                    </div>
                    <div class="offset-lg-2 pl-2">
                        <button type="submit" class="btn btn-lg inactive-button inactive-login-button" onclick="loginClick()">LOGIN</button>
                    </div>
            </div>
            <div id="upper-fold" class="position-absolute col-lg-1 offset-lg-5"></div> <!--Change to col-lg-2 ml-lg-3-->
            <div id="lower-fold" class="position-absolute col-lg-1 offset-lg-5"></div> <!--Change to col-lg-2 ml-lg-3-->
        </div>
    </div>   
    <footer class="page-footer">
        <div class="container">
            <p class="copyrights">
                ALL RIGHTS RESERVED "MEGABIT" 2016.
            </p>
        </div>
    </footer>
</body>