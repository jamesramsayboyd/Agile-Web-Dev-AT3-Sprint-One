<!DOCTYPE html>

<!--
 * Zac Purkiss 
 * P444025
 * 09.08.2022
-->
 
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Index</title>
	<link rel="stylesheet" type="text/css" href="index_files/style.css">
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

	<?php
		include_once('nav.php');
	?>
	
	<div class="container">
    
    	<?php
            include_once('connection.php');

            $database = new Connection();
            $db = $database->open();
            $query = $_GET['q'];
            try{	
              $sql = 'SELECT * FROM content WHERE title=\''.$query.'\'';
              foreach ($db->query($sql) as $row) {
                echo '<td>' .
            	    	'<center><img src = "data:image/png;base64,' . $row['image'] . '"/></center>'
            	    	. '</td>';
              }
        ?>
	  <table class="table">
	    <thead>
		  <th>ID</th>
		  <th>Title</th>
		  <th>The Year</th>
		  <th>Media</th>
		  <th>Artist</th>
		  <th>Style</th>
	    </thead>
		<tbody>
		  <?php
			  foreach ($db->query($sql) as $row) {
				echo '<tr> <form action="update.php">';
					echo '<div class=form-group">';
					echo '<td> <input type="search" readonly=true size=1 id="myid" name="id" value="' . $row['id'] . '"/> </td>';
            		echo '<td> <input type="text" size=10 id="mytitle" name="title" value="' . $row['title'] . '"/> </td>';
            		echo '<td> <input type="text" size=10 id="myyear" name="year" value="' . $row['year'] . '"/> </td>';
            		echo '<td> <input type="text" size=10 id="mymedia" name="media" value="' . $row['media'] . '"/> </td>';
            		echo '<td> <input type="text" size=10 id="myartist" name="artist" value="' . $row['artist'] . '"/> </td>';
            		echo '<td> <input type="text" size=10 id="mystyle" name="style" value="' . $row['style'] . '"/> </td></div>';
					echo '<td> <button type="submit" class="btn btn-default">Update</button></form> </td>';	
            	echo '</tr>';
				
				echo '<tr> <form action="delete.php">';
					echo '<div class=form-group">';
					echo '<td> <input type="search" hidden=true size=1 id="myid" name="id" value="' . $row['id'] . '"/> </td>';
            		echo '<td> </td>';
            		echo '<td> </td>';
            		echo '<td> </td>';
            		echo '<td> </td>';
            		echo '<td> </td></div>';
					echo '<td> <button type="submit" class="btn btn-default">Delete</button></form> </td>';			
            	echo '</tr>';
			  }
			}
			catch(PDOException $e){
			  echo "'ruh roh' - scooby doo";
			}

			$database->close();
		  ?>
		</tbody>
	  </table>
	</div>
</body>
</html>