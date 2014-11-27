<?php include($_SERVER['DOCUMENT_ROOT'] . '/library/includes/header.php'); 

$display_message = '';

$isbn= '';
$hello = '123';
$isbn = $_GET['isbn'];
$user_id = $_SESSION['user_id'];

$pdo = db_connect();
$sql = 'SELECT * FROM book_attributes WHERE isbn = :isbn';
$request = $pdo->prepare($sql);
$request->execute(array(':isbn' => $isbn));
$result = $request->fetch();

?>


<div class="container">
	<div class="col-md-8 col-md-offset-2">
		<div class="row">
			<div class="row">
				<h2>Title</h2>
				<?=$result['title']?>
			</div>
			<div class="row">
				<h2>Author</h2>
				<?=$result['author']?>
			</div>
			<div class="row">
				<h2>Publisher</h2>
				<?=$result['publisher']?>
			</div>
			<div class="row">
				<h2>ISBN</h2>
				<?=$result['isbn']?>
			</div>
			<div class="row">
				<h2>ISBN</h2>
				<?=$result['isbn']?>
			</div>
			<div class="row">
				<?= (user_id) ? '<a class="btn btn-success" href="/book/reserve/?isbn=<?=$result[\'isbn\']?>">Reserve a copy!</a>' : '' ?>
			</div>
			
		</div>
	</div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/library/includes/footer.php'); ?>