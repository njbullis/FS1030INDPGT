<?php
require_once "config.php";

$name = $work = $date = $broadcast = "";
$name_err = $work_err = $date = $broadcast_err = "";

if(isset($_POST["id"]) && !empty($_POST['id'])){
   $id = $_POST["id"]
     
     $input_name = trim($_POST["name"])
     if(empty($input_name)){
        $name_err = "Please enter a name.";
     } 
    else{
            $name = $input_name;  
            
        $input_work = trim($_POST["work"])
            if(empty($input_work)){
               $work_err = "Please enter title of book or CD.";
            } else{
                   $work = $input_work;
                 } 

                 $input_date = trim($_POST["date"])
                 if(empty($input_date)){
                    $date_err = "Please enter a date.";
                 } else{
                        $date = $input_date;
                      }

                      $input_broadcast= trim($_POST["broadcast"])
                      if(empty($input_broadcast)){
                         $broadcast_err = "Please enter type of broadcast.";
                      } else{
                             $broadcast = $input_broadcast;
                           }    
         if(empty ($name_err) && ($work_err) && ($date_err) && ($broadcast_err)){
                $sql = "UPDATE radio SET name=?, work=?, date=?, broadcast=? WHERE id=?";
                if(stmt = mysqli_prepare($link, $sql)){
                    mysqli_stmt_bind_param($stmt, "ssdsi", $param_name, $param_work, $date, $param_broadcast, $param_id);        
$param_name = $name;
$param_work = $work;
$param_date = $date;
$param_broadcast = $broadcast;
$param_id = $id;
if(mysqli_stmt_execute($stmt)){
    header("location: index.php");
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

$sql = "SELECT * FROM radio WHERE id = ?"

if($stmt = mysqli_prepare($link, $sql)){
    mysqli_stmt_bind_param($stmt, "i", $param_id);

    $para_id = $id;
    if(mysqli_num_rows($result) == 1){
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $name = $row["name"]
    $work = $row["work"];
    $date = $row["date"];
    $broadcast = $row["broadcast"];
    }else {
        header("location: errorradio.php");
        exit();
    }

} else{
    echo "Oops! Something went wrong. Please try again later.";
}
}

mysqli_stmt_close($stmt);

mysqli_close($link);
} else {
    header("location: errorradio.php")
exit();
}

?>    
<!DOCTYPE html>
<html lang="en">
<head>Update Radio Program</head>
    <body>
        <div>
        <h1>Update Radio Program</h1>
        <p>Please edit the input values and submit to update the radio programs.</p>
        <form action="<?php echo htmlspecialchars(basename$_SERVER['REQUEST_URI'])); ?>" method="post">
<div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
<label>name</label>
<input type="text" name="name" class="form-control" value="<?php echo $name;?>">
<span class="help-block"><?php echo $name;?></span>
</div>
<div class="form-group <?php echo (!empty($work_err)) ? 'has-error' : ''; ?>">
<label>work</label>
<input type="text" name="work" class="form-control" value="<?php echo $work;?>">
<span class="help-block"><?php echo $work;?></span>
</div>
<div class="form-group <?php echo (!empty($date_err)) ? 'has-error' : ''; ?>">
<label>date</label>
<input type="text" name="date" class="form-control" value="<?php echo $date;?>">
<span class="help-block"><?php echo $date;?></span>
</div>
<div class="form-group <?php echo (!empty($broadcast_err)) ? 'has-error' : ''; ?>">
<label>broadcast</label>
<input type="text" name="broadcast" class="form-control" value="<?php echo $broadcast;?>">
<span class="help-block"><?php echo $broadcast;?></span>
</div>
<input type="hidden" name="id" value="<?php echo $id;?>"/>
<input type="submit" class="btn btn-primary" value="Submit">
<a href="radio.php" class ="btn btn-default">Cancel</a>
</form>
    </div>
</body>
</html>
       
           