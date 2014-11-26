<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/library/config/top_includes.php');

$display_message ='';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	//stuff here for the edit
	
}

$res_id = $_GET['id'];
print_r($res_id);
?>

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			hiiii
			<?php
			if($_SESSION['user_type'] == "librarian" || $_SESSION['user_type'] == "master")
			{
				echo 'hiii2';
				die();
				$sql = 'SELECT * FROM reservations WHERE reservation_id = :res_id ORDER BY end_date';
				$reservations = $pdo->prepare($sql);
				$reservations->execute(array('res_id' => $res_id));

				$reservations = $reservations->fetchAll();?>
				<?php if($reservations) : ?>
					<h2>Reservations to edit</h2>
					<table class="table table-striped">
						<tr>
							<th>ISBN</th>
							<th>Title</th>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Edit</th>
						</tr>
						<?php

						foreach($reservations as $key=>$reservation):

							$sql = 'SELECT * FROM book_attributes WHERE isbn = (SELECT isbn FROM book WHERE book_id = :book_id)';
							$books = $pdo->prepare($sql);
							$books->execute(array('book_id' => $reservation['book_id']));
							$book = $books->fetch();
							?>
							<tr>
								<td><input type="text" value="<?=$book['isbn']?>"></input></td>
								<td><?=$book['title']?></td>
								<td><?=$reservation['start_date']?></td>
								<td><?=$reservation['end_date']?></td>
								<td><a class="btn btn-warning" href="/account/admin/edit_reservation.php?id=<?=$reservation['reservation_id']?>">Edit</a></td>
							</tr>
						<?php endforeach; ?>
					</table>
				<?php else : ?>
					<p>No reservations have been made.</p>
				<?php endif; ?>
			</div>
		</div>
	</div>


	<?php include($_SERVER['DOCUMENT_ROOT'] . '/library/includes/footer.php'); ?>