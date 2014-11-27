<?php include($_SERVER['DOCUMENT_ROOT'] . '/library/includes/header.php'); 

$pdo = db_connect();
$sql = 'SELECT * FROM book_attributes WHERE isbn IN  (SELECT DISTINCT(ISBN) FROM book b)';
$request = $pdo->prepare($sql);
$request->execute();
$result = $request->fetchAll();

?>

<div class="container">
	<div class="row">
		<div class="col-md-12" >
			<h1>Books available for checkout</h1>
			<table class="table table-striped">
				<tr>
					<th>Title</th>
					<th>Author</th>
					<th>Publisher</th>
					<th>ISBN</th>
					<th># Avail.</th>
					<th>Reserve</th>
				</tr>
				<?php
				foreach($result as $key=>$value): 
		
					?>
					<? 
					$pdo = db_connect();
					$sql = 'SELECT (SELECT count(isbn) FROM book b WHERE isbn = :isbn) - (SELECT count(isbn) FROM reservations WHERE isbn = :isbn AND (CURDATE() > reservations.start_date AND CURDATE() < reservations.end_date) OR (CURDATE() = reservations.start_date AND isbn = :isbn))';
					$request = $pdo->prepare($sql);
					$isbn = $value['isbn'];
					$request->execute(array(':isbn' => $isbn));
					$result1 = $request->fetchColumn();
					?>
					<?php if(intval($result1) > 0) : ?>
					<tr>
						<td><?=$value['title']?></td>
						<td><?=$value['author']?></td>
						<td><?=$value['publisher']?></td>
						<td><?=$value['isbn']?></td>
						<td><?=$result1?></td>
							<td><a class="btn btn-success" href="/books/reserve/?isbn=<?=$value['isbn'];?>">Reserve</a><a class="btn btn-success" href="/books/view/?isbn=<?=$value['isbn'];?>">View Information</a></td> 
						</tr>
					<?php endif;?>	
					<?php endforeach; ?>
				</table>
			</div>
		</div>
	</div>


	<?php include($_SERVER['DOCUMENT_ROOT'] . '/library/includes/footer.php'); ?>