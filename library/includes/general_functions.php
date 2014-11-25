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

function login_user($user_id){

    $user_type = 'customer';

    $pdo = db_connect();
    $sql = 'SELECT * FROM librarians WHERE user_id = :user_id';
    $request = $pdo->prepare($sql);
    $request->execute(array('user_id' => $user_id));

    if($request->rowCount() > 0){
        $user_type = 'librarian';
    }

    $sql = 'SELECT * FROM head_librarians WHERE user_id = :user_id';
    $request = $pdo->prepare($sql);
    $request->execute(array('user_id' => $user_id));

    if($request->rowCount() > 0){
        $user_type = 'master';
    }

    $sql = 'SELECT * FROM users WHERE user_id = :user_id';
    $request = $pdo->prepare($sql);
    $request->execute(array('user_id' => $user_id));

    $result = $request->fetch();

    if($result){
        $_SESSION['logged'] = true;
        $_SESSION['name'] = $result['name'];
        $_SESSION['user_type'] = $user_type;
    }

}