<?php

function db_connect(){
    $user = 'root';
    $pass = 'FixItTim';
    return new PDO('mysql:host=localhost;dbname=book5', $user, $pass);
}

// Functions for form validation

function validate_exists($variable){
    if(empty($variable) || $variable == ''){
        return ' is not set';
    }else{
        return '';
    }
}

function build_errors($errors){
    $message = '';

    foreach($errors as $key => $error){
        if(!empty($error)){
           $message .= $key . $error . '<br />';
        }
    }

    return $message;
}

function has_errors($errors){
    $has_errors = false;

    foreach($errors as $key => $error){
        if(!empty($error)){
           $has_errors = true;
        }
    }
    return $has_errors;
}