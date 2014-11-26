<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/library/config/top_includes.php');

$display_message = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // Set our vars
    $vars = $_POST;

    // Error Array
    $errors = array();

    // Super basic validation - check if each var exists
    $errors['Email']            = validate_exists($vars['email']);
    $errors['Password']         = validate_exists($vars['password']);

    if($vars['email'] && $vars['password']){
        $pdo = db_connect();
        $sql = 'SELECT * FROM users WHERE email = :email';
        $request = $pdo->prepare($sql);
        $request->execute(array('email' => $vars['email']));

        if($request->rowCount() > 0){
            // We have a user with that email
            $user = $request->fetch();

            if($user['password'] != md5($vars['password'])){
                $errors['Password'] = ' does not match';
            }
        }else{
            $errors['User'] = ' does not exist';
        }
    }

    if(has_errors($errors)){
        $display_message = '<p class="alert alert-danger">' . build_errors($errors) . '</p>';
    }else{
        // Validated, login user & set display message
        login_user($user['user_id']);
        $display_message = '<p class="alert alert-success">You have been successfully logged in!</p>';
    }
}
include($_SERVER['DOCUMENT_ROOT'] . '/library/includes/header.php');
?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Login</h1>
            <?=$display_message; ?>

            <form role="form" method="post" action="">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>

    </div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/library/includes/footer.php'); ?>