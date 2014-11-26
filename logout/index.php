<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/library/config/top_includes.php');

unset($_SESSION['name']);
unset($_SESSION['logged']);
unset($_SESSION['user_type']);
unset($_SESSION['user_id']);

include($_SERVER['DOCUMENT_ROOT'] . '/library/includes/header.php');
?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>You have successfully been logged out.</h1>

        </div>
    </div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/library/includes/footer.php'); ?>