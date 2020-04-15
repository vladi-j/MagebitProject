<?php

Route::set('index.php', function(){
    Auth::CreateView('Auth');
});

Route::set('Validate', function(){
    Profile::Validate();
});

Route::set('saveAttributes', function(){
    Profile::CreateView('Profile');
    Attributes::saveAttributes();
});

Route::set('logout', function(){
    Session::logOut();
    Auth::CreateView('Auth');
});
