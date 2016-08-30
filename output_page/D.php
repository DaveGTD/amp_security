<?php

$query_given = $_POST["hidden_query"];
$tag_given = $_POST["tag"];

$servername = "localhost";
$username = "amp";
$password = "amp";
$dbname = "amp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO calls (tag, query) VALUES ('$tag', '$query_given')";

if ($conn->query($sql) === TRUE) 
{
   // echo "New record created successfully";
} 
else 
{
   // echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

// run mongo query and return output 

$cmd = "mongoexport -h ds011298.mlab.com:11298 -d amp -c emp -u amp -p amp -q '".$query_given."'";

exec($cmd, $output, $return_var);

$data = json_decode($output);

var_dump($data);

if (count($data->stand)) {
        // Open the table
        echo "<table>";

        // Cycle through the array
        foreach ($data->stand as $idx => $stand) {

            // Output a row
            echo "<tr>";
            echo "<td>$stand->afko</td>";
            echo "<td>$stand->positie</td>";
            echo "</tr>";
        }

        // Close the table
        echo "</table>";
    }









// var_dump($output);

/*
echo "<table>";
$row_count = 0;
foreach ($output as $row)
{
	if($row_count == 0)
	{
		//header row 
		$cells = explode(",", $row);
		echo "<thead>";
		echo "<tr>";
		foreach ($cells as $cell) 
		{
			echo "<th>" . $cell . "</th>";
		}
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
	}
	else
	{
		// data rows 
		$cells = explode(",", $row);
		echo "<tr>";
		foreach ($cells as $cell) 
		{
			echo "<td>" . $cell . "</td>";
		}
		echo "</tr>";
	}
	$row_count++;
}
echo "</tbody>";
echo "</table>";
*/



?>

