<?php
require_once "config.php";

$name = $club = $position = $number = "";
$name_err = $club_err = $position_err = $number_err = "";

if(isset($_POST["id"]) && !empty($_POST['id'])){
    require_once "config.php";

   $id = $_POST["id"]
     
     $input_name = trim($_POST["name"])
     if(empty($input_name)){
        $name_err = "Please enter a name.";
    }  else{
            $name = $input_name; 
            
        $input_club = trim($_POST["club"])
            if(empty($input_club)){
               $name_err = "Please enter a hockey club.";
            } else{
                   $club = $input_club;
                 } 

                 $input_position = trim($_POST["position"])
                 if(empty($input_position)){
                    $name_err = "Please enter a position.";
                 } else{
                        $position = $input_position;
                      }
                      $input_number = trim($_POST["number"])
                      if(empty($input_number)){
                         $number_err = "Please enter a jersey number.";
                      } else{
                             $number = $input_number;
                           }    
         if(empty ($name_err) && ($club_err) && ($position_err) && ($number_err)){
                $sql = "UPDATE hockey_player_list SET name=?, club=?, position=?, number=? WHERE id=?";
                if(stmt = mysqli_prepare($link, $sql)){
                    mysqli_stmt_bind_param($stmt, "sssii", $param_name, $param_club, $param_position, $param_number, $param_id);        
$param_name = $name;
$param_club = $club;
$param_position = $position;
$param_number = $number;
$param_id = $id;

if(mysqli_stmt_execute($stmt)){
    header("location: players.php");
exit();
} else{
    echo "Oops! Something went wrong. Please try again later.";
}

}

mysqli_stmt_close($stmt);
         }
mysqli_close($link);
} else {
if(isset($GET["id"]) && !empty(trim($_GET["id"]))){
    $id = trim($_GET["id"]);

$sql = "SELECT * FROM players WHERE id = ?"

if($stmt = mysqli_prepare($link, $sql)){
    mysqli_stmt_bind_param($stmt, "i", $param_id);

    $para_id = $id;
    if(mysqli_num_rows($result) == 1){
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $name = $row["name"];
    $club = $row["club"];
    $position = $row["position"];
    $number = $row["number"];
    } else {
        header("location: errorplayers.php");
        exit();
    }

} else{
    echo "Oops! Something went wrong. Please try again later.";
}
}

mysqli_stmt_close($stmt);

mysqli_close($link);
} else {
    header("location: errorplayers.php")
exit();
}

?>    
<!DOCTYPE html>
<html lang="en">
<head>Update Player</head>
    <body>
        <div>
        <h1>Update Player</h1>
        <p>Please edit the input values and submit to update the player.</p>
        <form action="<?php echo htmlspecialchars(basename$_SERVER['REQUEST_URI'])); ?>" method="post">
<div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
<label>name</label>
<input type="text" name="name" class="form-control" value="<?php echo $name;?>">
<span class="help-block"><?php echo $name;?></span>
</div>
<div class="form-group <?php echo (!empty($club_err)) ? 'has-error' : ''; ?>">
<label>club</label>
<input type="text" name="club" class="form-control" value="<?php echo $club;?>">
<span class="help-block"><?php echo $club;?></span>
</div>
<div class="form-group <?php echo (!empty($position_err)) ? 'has-error' : ''; ?>">
<label>position</label>
<input type="text" name="position" class="form-control" value="<?php echo $position;?>">
<span class="help-block"><?php echo $position;?></span>
</div>
<div class="form-group <?php echo (!empty($number_err)) ? 'has-error' : ''; ?>">
<label>number</label>
<input type="text" name="number" class="form-control" value="<?php echo $number;?>">
<span class="help-block"><?php echo $number;?></span>
</div>
<input type="hidden" name="id" value="<?php echo $id;?>"/>
<input type="submit" class="btn btn-primary" value="Submit">
<a href="players.php" class ="btn btn-default">Cancel</a>
</form>
    </div>
</body>
</html>
       
           