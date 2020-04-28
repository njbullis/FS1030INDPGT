<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $work = $date = $broadcast = "";
$name_err = $work_err = $date_err = $broadcast_err = "";
 
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
    $input_work = trim($_POST["work"]);
    if(empty($input_club)){
        $work_err = "Please enter the guest's work such as book or CD title.";     
    } else{
        $work = $input_work;
    }
    
    // Validate date
    $input_date = trim($_POST["date"]);
    if(empty($input_date)){
        $date_err = "Please enter the date.";     
    } else{
        $date = $input_date;
    }

        // Validate broadcast
        $input_broadcast = trim($_POST["broadcast"]);
        if(empty($input_broadcast)){
            $broadcast_err = "Please enter type of broadcast";    
        } else{
            $broadcast = $input_broadcast;
        }

    // Check input errors before inserting in database
    if(empty($name_err) && empty($work_err) && empty($date_err) && empty($broadcast_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO  (name, work, date, broadcast) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssds", $param_name, $param_work, $param_date, $param_broadcast);
            
            // Set parameters
            $param_name = $name;
            $param_work = $work;
            $param_date = $date;
            $param_broadcast = $broadcast;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: publications.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
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
    //document is not defined
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
                    <p>Please fill this form and submit to add radio show to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($work_err)) ? 'has-error' : ''; ?>">
                            <label>Work</label>
                            <textarea name="work" class="form-control"><?php echo $work; ?></textarea>
                            <span class="help-block"><?php echo $work_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($date_err)) ? 'has-error' : ''; ?>">
                            <label>Date</label>
                            <textarea name="date" class="form-control"><?php echo $date; ?></textarea>
                            <span class="help-block"><?php echo $date_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($broadcaster_err)) ? 'has-error' : ''; ?>">
                            <label>Broadcaster</label>
                            <input type="text" name="broadcaster" class="form-control" <?php echo $broadcaster; ?>/>
                            <span class="help-block"><?php echo $broadcaster_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="radio.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>