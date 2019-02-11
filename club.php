<?php 
require('includes/header.php');

echo '<div class="clubdb">
<h1> Climbing Club Database!</h1>
<a href="index.php">Add A New Member</a>'; 

ob_start();

try {
	// cnnect to the database
	require('includes/db.php');

	// set up our sql query
	$sql = "SELECT * FROM climbingclub;";

	// prepare
	$cmd= $conn->prepare($sql);

	// execute the query
	$cmd->execute();

	// use fetchAll to store our results
	$club = $cmd->fetchAll();

	echo '<table class="table">
			<thead>
				<th> Name </th>
				<th> Email </th>
				<th> city </th>
				<th> skill </th>
				<th> experience </th>
				<th> Edit? </th>
				<th> Delete? </th>
			</thead>
			<tbody>';

	// loop thrugh the data anad create a new rw fr each recrd

	foreach ($club as $cclub) {
		echo '<tr><td>' . $cclub['name'] . '</td>';
		echo '<td>' . $cclub['email'] . '</td>';
		echo '<td>' . $cclub['city'] . '</td>';
		echo '<td>' . $cclub['skill'] . '</td>';
		echo '<td>' . $cclub['experience'] . '</td>';
		echo '<td> <a href="index.php?id=' . $cclub['id']. '"> Edit </a></td>';
		echo '<td> <a href="delete.php?id=' . $cclub['id']. '"onclick="return confirm(\'Are yu susre?\');"> Delete </a></td></tr>';
	}
	echo '</tbody></table>';

	// clse the db cnnectin

	$cmd->closeCursor();

}
catch(PDOException $e){
	header('location:error.php');
	mail('200397841@student.georgianc.on.ca', 'cclub Database Problems', $e);
}



ob_flush();

echo '</div>'; 

require('includes/footer.php') 
?>