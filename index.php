<?php 

require_once __dir__.'/conn.php';

$users = array();

if($conn->connect_error){
	die('Connection falied : '.$conn->connect_error);
} else {
	$sql ="select * from tbluser";
	$result = $conn->query($sql);

	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			// echo $row['name'];
			$users[$row['id']]=array(
				'id' 	=> 	$row['id'],
				'name'	=>	$row['name'],
				'email' => 	$row['email']
			);
		}

	}

	echo(json_encode($users));
}

// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// } else {
	// $sql = "SELECT * FROM tbluser";
	// $result = $conn->query($sql);
	// var_dump($result);

	// if ($result->num_rows > 0) {
	//   echo "<table><tr><th>ID</th><th>Name</th></tr>";
	//   // output data of each row
	//   while($row = $result->fetch_assoc()) {
	//     echo "<tr><td>".$row["id"]."</td><td>".$row["firstname"]." ".$row["lastname"]."</td></tr>";
	//   }
	//   echo "</table>";
	// } else {
	//   echo "0 results";
	// }	
// }



$conn->close();





?>