<?php include($_SERVER['DOCUMENT_ROOT'] . '/library/includes/header.php'); 

 $display_message = '';

 $user_id= '';

 $user_id = $_GET["user_id"];
 
if($user_id)
{
 	$pdo = db_connect();
 	$sql = 'SELECT * FROM users WHERE user_id = :user_id';
 	$request = $pdo->prepare($sql);
 	$request->execute(array('user_id' => $user_id));

 	$result = $request->fetch();
	
}
?>





<div class="container">
	<div class="row">
		<div class="col-md-9 offset-3">
			 <label>
				Name
				<p>
					<?=$_SESSION['name']?>
				</p>
			</label>
			<br>
			<label>
			<?
				if( $_SESSION['user_type'] == "customer")
				{
					echo '<a class="btn btn-success" href="/fees/?user_id='. $user_id  .'">Click to view account fees</a>';
				}
				else if($_SESSION['user_type'] == "librarian" || $_SESSION['user_type'] == "master")
				{
					echo '<br><a class="btn btn-success" href="/reservationviewer/">Click to view all reservations</a>';
				}
				if($_SESSION['user_type'] == "master")
				{
					echo '<br><a class="btn btn-success" href="/modificationviewer/">Click to view all modifications</a>';
				}

			?>
			</label>
		</div>
	</div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/library/includes/footer.php'); ?>