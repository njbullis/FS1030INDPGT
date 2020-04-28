<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$publication = $publisher = $type = $role = "";
$publication_err = $publisher_err = $type_err = $role_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $input_publication = trim($_POST["publication"]);
    if(empty($input_publication)){
        $publication_err = "Please enter a title.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $publication_err = "Please enter a valid publiation.";
    } else{
        $publication = $input_publication;
    }
    

    $input_publisher = trim($_POST["publisher"]);
    if(empty($input_publisher)){
        $publisher_err = "Please enter a publisher.";     
    } else{
        $publisher = $input_publisher;
    }
    

    $input_type = trim($_POST["type"]);
    if(empty($input_type)){
        $type_err = "Please enter the type of publication.";     
    } else{
        $type = $input_type;
    }

        // Validate jersey number
        $input_role = trim($_POST["role"]);
        if(empty($input_role)){
            $role_err = "Please enter a role.";
        }  else{
            $role = $input_role;
        }

    // Check input errors before inserting in database
    if(empty($publication_err) && empty($publisher_err) && empty($type_err) && empty($role_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO  (publication, publisher, type, role) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssi", $param_publication, $param_publisher, $param_type, $param_role);
            
            // Set parameters
            $param_publication = $publication;
            $param_publisher = $publisher;
            $param_type = $type;
            $param_role = $role;
            
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
                    <p>Please fill this form and submit to add a publication to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($publication_err)) ? 'has-error' : ''; ?>">
                            <label>Publication</label>
                            <input type="text" name="publication" class="form-control" value="<?php echo $publication; ?>">
                            <span class="help-block"><?php echo $publication_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($publisher_err)) ? 'has-error' : ''; ?>">
                            <label>Publisher</label>
                            <textarea name="publisher" class="form-control"><?php echo $publisher; ?></textarea>
                            <span class="help-block"><?php echo $publisher_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($type_err)) ? 'has-error' : ''; ?>">
                            <label>Type</label>
                            <textarea name="type" class="form-control"><?php echo $type; ?></textarea>
                            <span class="help-block"><?php echo $type_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($role_err)) ? 'has-error' : ''; ?>">
                            <label>Role</label>
                            <input type="text" name="role" class="form-control" value="<?php echo $role; ?>">
                            <span class="help-block"><?php echo $role_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>