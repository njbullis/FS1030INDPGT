<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    <title>Publications</title>
    <script type="text/javascript">
$(document).ready(function(){
    $('data-toggle="tooltip"]').tooltip():
});
</script>
    <style>
        table, th, td 
            {
            padding: 10px;
            border: 1px solid black;
            border-collapse: collapse;
			background-color: #FCF3CF;
            }
		body{
		background-color: #00CED1;
		}
    </style>
	<link rel="stylesheet" href="nancywebsitestyles.css">
</head>

<body>
    <h1 align="center">Publications</h1>
    

    </html>
        <div>
               <p align = "right"> <a href="createpublication.php" class="btn btn-success pull-right">Add New Publication</a>        
       </div>
            <?php
            require_once "config.php";
$sql = "SELECT * FROM publications";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0) {
        echo "<table class='table table-bordered table-striped'>";
        echo "<thead>";
        echo "<tr>";
            echo "<th>#</th>";
            echo "<th>publication</th>";
            echo "<th>publisher</th>";
            echo "<th>type</th>";
            echo "<th>role</th>";
            echo "<th>actions</th>";
        echo "</tr>";
        echo "</thead>";
        echo "</tbody>";
        while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['publication'] . "</td>";
            echo "<td>" . $row['publisher'] . "</td>";
            echo "<td>" . $row['type'] . "</td>";
            echo "<td>" . $row['role'] . "</td>";
            echo "<a href='read.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
            echo "<a href='update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
            echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
        echo "</td>";
        
         echo "</tr>";
        }
        echo "</tbody>";
       echo "</table>";
        mysqli_free_result($result);
    } else {
        echo "<p class='lead'><em>ERROR: No records found.</em></p>";
    } 
    } else
     {
        echo "ERROR: Could not execute $sql. " . mysqli_error($link);
    }
    mysqli_close($link);
?>

    </body>
</html>

