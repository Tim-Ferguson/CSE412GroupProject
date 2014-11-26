<?php include($_SERVER['DOCUMENT_ROOT'] . '/library/includes/header.php'); 

$display_message = '';

$isbn= '';
$hello = '123';
$isbn = $_GET['isbn'];
	
$user_id = $_SESSION['user_id'];

$pdo = db_connect();
    $sql = 'INSERT INTO `reservations`(`isbn`, `user_id`, `start_date`, `end_date`) VALUES (:isbn, :user_id, CURDATE() ,DATE_ADD(CURDATE(),INTERVAL 2 WEEK))';
    $request = $pdo->prepare($sql);
    $request->execute(array(':isbn' => $isbn, ':user_id' => $user_id));
	$result = $request->fetchAll();

?>


<div class="container">
<div class="col-md center">
	<h1>Congrats, you have checked out the following book!</h1>
	<table class="table table-striped">
		<tr>
			<th>Title</th>
			<th>Author</th>
			<th>Publisher</th>
			<th>ISBN</th>
		</tr>
	<?php
	$pdo = db_connect();
	    $sql = 'SELECT * FROM book_attributes WHERE isbn = :isbn';
	    $request = $pdo->prepare($sql);
	    $request->execute(array(':isbn' => $isbn));
		$result = $request->fetchAll();
	foreach($result as $key=>$value): ?>
		<tr>
			<td><?=$value['title']?></td>
			<td><?=$value['author']?></td>
			<td><?=$value['publisher']?></td>
			<td><?=$value['isbn']?></td>
		</tr>
	<?php endforeach; ?>
	</table>
	<a class="btn btn-success" href="../">Back To Books!</a>
</div>"
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/library/includes/footer.php'); ?>