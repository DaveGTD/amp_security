<?php 
// echo $_POST["hidden_query"]; 
// echo "<br>";
// echo $_POST["tag"];

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

$mongo_shell = "db.emp.find( $query_given ).pretty()";
// $cmd = "mongo ds011298.mlab.com:11298/amp -u amp -authenticationDatabase amp -p amp amp --eval '".$mongo_shell."'";

$cmd = "mongo ds011298.mlab.com:11298/amp -u amp -authenticationDatabase amp -p amp amp --eval 'db.emp.find( {"$and":[{"Age":{"$gt":20}},{"Office":"London"},{"$and":[{"Name":"Bradley Greer"}]}]}  ).sort({"Age":1}).pretty()'";

exec($cmd, $output, $return_var);

echo $output;
echo "<br><br>";
echo $return_var;


?>