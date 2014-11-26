<?php include($_SERVER['DOCUMENT_ROOT'] . '/library/includes/header.php'); 


    // Set our vars
	echo "one";
	
    // Error Array
    $errors = array();

    // Super basic validation - check if each var exists
    $pdo = db_connect();
        $sql = 'SELECT * FROM book_attributes WHERE isbn IN  (SELECT DISTINCT(ISBN) FROM book b) WHERE 1 = 1';
        $request = $pdo->prepare($sql);
        $request->execute();
		echo "two";

        if($request->rowCount() > 0){
            // There are books found
			$result = $request->fetchAll();
			print_r($result);
			die();
			foreach($row in $result)
			 	$display_message = $display_message+ '<p class="alert alert-danger"> '.$row.' </p>';
        }
		else
		{
			echo "error";
		}
    }

    if(has_errors($errors)){
        $display_message = '<p class="alert alert-danger">' . build_errors($errors) . '</p>';
    }else{
        // Validated, login user & set display message

//        Todo: Login user here
        $display_message = '<p class="alert alert-success">You have been successfully logged in!</p>';
    }


?>
<h1>Demo page for books</h1>




<p>
	List all books available for checkout, here
	
	<?=$display_message; ?>
</p>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/library/includes/footer.php'); ?>