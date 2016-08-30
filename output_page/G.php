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

$cmd = "mongoexport -h ds011298.mlab.com:11298 -d amp -c amp_cus -u amp -p amp --csv -f CustomerAccountId,City,Area,SystemName,SystemPackageName,CreditScore,StatusID,MonthlyMonitoringRate,QualityScore -q '".$query_given."'";

exec($cmd, $output, $return_var);









// var_dump($output);

/*
echo "<table>";
$row_count = 0;
foreach ($output as $row)
{
	if($row_count == 0)
	{
		//header row 
		// $cells = explode(",(?=(?:[^\"]*\"[^\"]*\")*[^\"]*$)", $row);
		// $p = '#(?<=\d|"),#'; 
		// $cells = preg_split($p, $row);
		$cells = str_getcsv($row);
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
		
		$cells = str_getcsv($row);
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

<html>
<head>
  <title> TermX </title>

</head>

<body>
<script src="jquery-1.12.3.js"></script>
<script src="jquery.dataTables.min.js"></script>

<link rel="stylesheet" href="jquery.dataTables.min.css">

<script>

  $(document).ready(function()
  {
    $('#example').DataTable();
  } );

</script>


<table id="example" class="display" cellspacing="0" width="100%">
<?php
$row_count = 0;
foreach ($output as $row)
{
	if($row_count == 0)
	{
		//header row 
		// $cells = explode(",(?=(?:[^\"]*\"[^\"]*\")*[^\"]*$)", $row);
		// $p = '#(?<=\d|"),#'; 
		// $cells = preg_split($p, $row);
		$cells = str_getcsv($row);
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
		
		$cells = str_getcsv($row);
		echo "<tr>";
		foreach ($cells as $cell) 
		{
			echo "<td>" . $cell . "</td>";
		}
		echo "</tr>";
	}
	$row_count++;
}
echo "</tbody>"
?>
</table>

</body>

</html>

