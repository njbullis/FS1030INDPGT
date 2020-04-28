<?php
if(isset($_POST["id"]) && !empty($_POST['id'])){
    require_once "config.php";

    $sql = "DELETE FROM radio WHERE id = ?";

    if($stmt = mysql_prepare($link, $sql)){
mysqli_stmt_bind_param($stmt, "i", $param_id);

$param_id = trim($_POST["id"]);

if(mysqli_stmt_execute($stmt)){
    header("location: players.php");
exit();
} else{
    echo "Oops! Something went wrong. Please try again later.";
}

}

mysqli_stmt_close($stmt);
mysqli_close($link);
} else {
    if(empty(trim($_GET["id"]))){
        header("location: errorradio.php");
        exit();
    }
}
?>    
<!DOCTYPE html>
<html lang="en">
<head>Delete Radio Program</head>
    <body>
        <div>
        <h1>Delete Radio Program</h1>
        </div>
        <div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="alert alert-danger fade in">
            <input type="hidden" name="id" value="<?php echo trim($GET["id"]); ?>"/>
            <p> Are you sure you want to delete this player?</p><br>
            <p>
                <input type="submit" value="Yes" class="btn btn-danger">
                <a href="radio.php" class="btn btn-default">No</a>
            </p>
        </form>
    </div>
</body>
</html>
       
           