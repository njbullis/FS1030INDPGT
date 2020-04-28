<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $club = $position = $number = "";
$name_err = $club_err = $position_err = $number_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate club
    $input_club = trim($_POST["club"]);
    if(empty($input_club)){
        $club_err = "Please enter a hockey club.";     
    } else{
        $club = $input_club;
    }
    
    // Validate position
    $input_position = trim($_POST["position"]);
    if(empty($input_position)){
        $position_err = "Please enter the position.";     
    } else{
        $position = $input_position;
    }

        // Validate jersey number
        $input_number = trim($_POST["number"]);
        if(empty($input_number)){
            $number_err = "Please enter a jersey number.";
        } elseif(!ctype_digit($input_number)){
            $number_err = "Please enter just the jersey number.";     
        } else{
            $number = $input_number;
        }

    // Check input errors before inserting in database
    if(empty($name_err) && empty($club_err) && empty($position_err) && empty($number_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO  (name, club, position, number) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_club, $param_position, $param_number);
            
            // Set parameters
            $param_name = $name;
            $param_club = $club;
            $param_position = $position;
            $param_number = $number;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: players.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        //mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
    <script type="text/javascript">
$(document).ready(function(){
    $('data-toggle=["tooltip"]').tooltip()
});
</script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add player record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($club_err)) ? 'has-error' : ''; ?>">
                            <label>Club</label>
                            <textarea name="club" class="form-control"><?php echo $club; ?></textarea>
                            <span class="help-block"><?php echo $club_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($position_err)) ? 'has-error' : ''; ?>">
                            <label>Position</label>
                            <textarea name="position" class="form-control"><?php echo $position; ?></textarea>
                            <span class="help-block"><?php echo $position_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($number_err)) ? 'has-error' : ''; ?>">
                            <label>Number</label>
                            <input type="text" name="number" class="form-control" value="<?php echo $number; ?>">
                            <span class="help-block"><?php echo $number_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="players.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>