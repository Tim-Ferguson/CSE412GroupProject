<?php include($_SERVER['DOCUMENT_ROOT'] . '/library/includes/header.php'); 

$display_message = '';

$isbn= '';

$isbn = $_GET['isbn']);

$pdo = db_connect();
    $sql = 'SELECT * FROM book_attributes WHERE isbn IN  (SELECT DISTINCT(ISBN) FROM book b)';
    $request = $pdo->prepare($sql);
    $request->execute();
	$result = $request->fetchAll();
	

	
	foreach($result as $key=>$value)
	{
		
	}
		

?>




<div class="col-md center">
	<h1>Books available for checkout</h1>
	<table class="table table-striped">
		<tr>
			<th>Title</th>
			<th>Author</th>
			<th>Publisher</th>
			<th>ISBN</th>
			<th>Reserve</th>
		</tr>
	<?php
	foreach($result as $key=>$value): ?>
		<tr>
			<td><?=$value['title']?></td>
			<td><?=$value['author']?></td>
			<td><?=$value['publisher']?></td>
			<td><?=$value['isbn']?></td>
			<td><a class="btn btn-success" href="/books/reserve/?id=<?=$value['isbn'];?>">Reserve</a></td>
		</tr>
	<?php endforeach; ?>
	</table>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/library/includes/footer.php'); ?>