<?php include($_SERVER['DOCUMENT_ROOT'] . '/library/includes/header.php'); 

$display_message = '';

if($_SESSION['user_id']){
    $user_id = $_SESSION["user_id"];
}else{
    header('Location: /');
    exit;
}

 
if($user_id)
{
 	$pdo = db_connect();
 	$sql = 'SELECT * FROM users WHERE user_id = :user_id';
 	$request = $pdo->prepare($sql);
 	$request->execute(array('user_id' => $user_id));

 	$result = $request->fetchAll();
	
}
?>





<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
            <h1>My Account :: <span style="text-transform: capitalize;"><?=$_SESSION['user_type']; ?></span></h1>
			 <p><strong>Name:</strong> <?=$_SESSION['name']?></p>
			<?
				if( $_SESSION['user_type'] == "customer")
				{

                    $sql = 'SELECT * FROM customers WHERE user_id = :user_id';
                    $customer = $pdo->prepare($sql);
                    $customer->execute(array('user_id' => $user_id));

                    $customer = $customer->fetch();

                    $sql = 'SELECT * FROM reservations WHERE user_id = :user_id';
                    $reservations = $pdo->prepare($sql);
                    $reservations->execute(array('user_id' => $user_id));

                    $reservations = $reservations->fetchAll();?>

                    <p><strong>Balance Overdue:</strong> $<?=($customer['fees']) ? $customer['fees'] : '0.00'; ?></p>
                    <h2>My reservations</h2>
                    <?php if($reservations) : ?>
                        <table class="table table-striped">
                            <tr>
                                <th>ISBN</th>
                                <th>Title</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                            </tr>
                            <?php

                            foreach($reservations as $key=>$reservation):

                                $sql = 'SELECT * FROM book_attributes WHERE isbn = :isbn';
                                $books = $pdo->prepare($sql);
                                $books->execute(array('isbn' => $reservation['isbn']));

                                $book = $books->fetch();
                                ?>
                                <tr>
                                    <td><?=$book['isbn']?></td>
                                    <td><?=$book['title']?></td>
                                    <td><?=$reservation['start_date']?></td>
                                    <td><?=$reservation['end_date']?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php else :  ?>
                        <p>You do not have any reservations.</p>
                    <?php endif;
				}
				else if($_SESSION['user_type'] == "librarian" || $_SESSION['user_type'] == "master")
				{
                    $sql = 'SELECT * FROM reservations ORDER BY end_date';
                    $reservations = $pdo->prepare($sql);
                    $reservations->execute(array('user_id' => $user_id));

                    $reservations = $reservations->fetchAll();?>
                    <?php if($reservations) : ?>
                        <h2>Reservations in the System</h2>
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

                                $sql = 'SELECT * FROM book_attributes WHERE isbn = :isbn';
                                $books = $pdo->prepare($sql);
                                $books->execute(array('isbn' => $reservation['isbn']));

                                $book = $books->fetch();
                                ?>
                                <tr>
                                    <td><?=$book['isbn']?></td>
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
                    <p><a class="btn btn-success" href="/account/admin/edit_reservation.php">Add reservation</a></p>
                <?
				}
				if($_SESSION['user_type'] == "master")
				{
                    $sql = 'SELECT * FROM users';
                    $users = $pdo->prepare($sql);
                    $users->execute();

                    $users = $users->fetchAll();?>
                    <h2>Manage Users</h2>
                    <?php if($users) : ?>
                    <table class="table table-striped">
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Edit</th>
                        </tr>
                        <?php

                        foreach($users as $key=>$user):
                            ?>
                            <tr>
                                <td><?=$user['user_id']?></td>
                                <td><?=$user['name']?></td>
                                <td><?=$user['email']?></td>
                                <td><?=$user['email']?></td>
                                <td><a class="btn btn-warning" href="/account/admin/edit_user.php?id=<?=$user['user_id']?>">Edit</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php else :  ?>
                    <p>No users exist. UH OH...</p>
                <?php endif;



                    $sql = 'SELECT * FROM modifications';
                    $modifications = $pdo->prepare($sql);
                    $modifications->execute(array('user_id' => $user_id));

                    $modifications = $modifications->fetchAll();?>
                    <h2>System Modifications</h2>
                    <?php if($modifications) : ?>
                    <table class="table table-striped">
                        <tr>
                            <th>Librarian ID</th>
                            <th>Modification type</th>
                            <th>Notes</th>
							<th>Add/Edit Note</th>
                        </tr>
                        <?php

                        foreach($modifications as $key=>$modification):
                            ?>
                            <tr>
                                <td><?=$modification['librarian_user_id']?></td>
                                <td><?=$modification['modification_type']?></td>
                                <td><?=$modification['notes']?></td>
								<td><a class="btn btn-warning" href="admin/editnote.php?modification_id=<?=$modification['modification_id']?>">Edit Note</td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php else :  ?>
                    <p>No modifications have been made.</p>
                <?php endif;
				}

			?>
		</div>
	</div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/library/includes/footer.php'); ?>