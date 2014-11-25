<?php include($_SERVER['DOCUMENT_ROOT'] . '/library/includes/header.php');

$display_message = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // Set our vars
    $vars = $_POST;

    // Error Array
    $errors = array();

    // Super basic validation - check if each var exists
    $errors['Email']            = validate_exists($vars['email']);
    $errors['Name']             = validate_exists($vars['name']);
    $errors['Password']         = validate_exists($vars['password']);
    $errors['Password Repeat']  = validate_exists($vars['password2']);

    if($vars['password'] != $vars['password2']){
        $errors['Password repeat'] = ' does not match your password.';
    }

    if($vars['email']){
        $pdo = db_connect();
        $sql = 'SELECT * FROM users WHERE email = :email';
        $request = $pdo->prepare($sql);
        $request->execute(array('email' => $vars['email']));

        if($request->rowCount() > 0){
            $errors['Email:'] = ' this email already exists in our records.';
        }
    }

    if(has_errors($errors)){
        $display_message = '<p class="alert alert-danger">' . build_errors($errors) . '</p>';
    }else{
        // Validated, save new record & set display message
        $execution_values = array('name'        => $vars['name'],
                                  'email'       => $vars['email'],
                                  'password'    => md5($vars['password'])
                                );

        $pdo = db_connect();
        $sql = 'INSERT INTO users (name, email, password) values (:name, :email, :password)';
        $request = $pdo->prepare($sql);
        $request->execute($execution_values);


        $display_message = '<p class="alert alert-success">Your account has been successfully created!</p>';
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Register</h1>
            <?=$display_message; ?>
            <form role="form" method="post" action="/register/">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="name" name="name" class="form-control" id="name" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="password2">Password Repeat</label>
                    <input type="password" name="password2" class="form-control" id="password2" placeholder="Password repeat">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/library/includes/footer.php'); ?>