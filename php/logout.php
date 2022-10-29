<?php

// logout session
session_start();

function logout()
{
    // check if user is logged in
    if(isset($_SESSION['username'])) {
        // delete user datails
        unset($_SESSION['username']);
        // destroy session
        session_destroy();
        // redirect user to login page
        header('location: ../forms/login.html');
    } 

    else {
        // destroy session
        session_destroy();
        // redirect user to login page
        header('location: ../forms/login.html');
    }
}

// call logout function
logout();
?>