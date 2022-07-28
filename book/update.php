<?php
//include config file
require_once 'config.php';

//define variables and initialize with empty values

$name = $author = $price = "";
$name_err = $author_err = $price_err = "";

// Processing form data when form is submitted

if (isset($_POST["id"]) && !empty($_POST["id"])){
    //get hidden input value
    $id = $_POST["id"];
    //validate name

    $input_name = trim($_POST["name"]);
    if (empty($input_name)){
        $name_err = "please enter a name. ";
    }elseif (!filter_var(trim($_POST["name"]), FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^[a-zA-Z'.\s]+$/")))){
        $name_err = 'please enter a valid name.';
    }else{
        $name = $input_name;
    }
    //validate author author
    $input_author = trim($_POST["author"]);
    if (empty($input_author)){
        $author_err = 'Please enter an author';
    }else{
        $author = $input_author;
    }
    //validate price
    $input_price = trim($_POST["price"]);
    if(empty($input_price)){
        $price_err = "Please enter the price amount. ";
    }elseif(!ctype_digit($input_price)){
        $price_err = 'Please enter a positive integer value.';
    }else{
        $price = $input_price;
    }
    // check input errors before inserting in database
    if (empty($name_err)&& empty($author_err) && empty($price_err)) {
        //prepare an insert statement
        $sql = "UPDATE books SET name=?, author=?, price=? WHERE id=?";

        if ($stmt = mysqli_prepare($Link, $sql)){
            //Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt,"sssi",$param_name, $param_author, $param_price, $param_id);

            // Set parameters
            $param_name = $name;
            $param_author = $author;
            $param_price = $price;
            $param_id = $id;

            //attempt tp execute the prepared statement
            if (mysqli_stmt_execute($stmt)){
                //records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            }else{
                echo "Something went wrong. Please try againt later.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }
    //close connection
    mysqli_close($Link);
}else{
    //check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        //Get URL parameter
        $id = trim($_GET["id"]);

        //Prepare a select statement
        $sql = "SELECT * FROM books WHERE id=?";
        if ($stmt = mysqli_prepare($Link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            //Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement;
            if (mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $name = $row["name"];
                    $author = $row["author"];
                    $price = $row["price"];
                }else{
                    //URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
            }else{
                echo "Oops! something went wrong. Please try again later.";
            }
        }
        //close statement
        mysqli_stmt_close($stmt);
        //close connection
        mysqli_close($Link);
    }else{
        //URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
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
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h2>Update Record</h2>
                </div>
                <p>Please edit the input values and submit to update the record.</p>
                <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group <?php echo (!empty($name_err)) ? 'has-error': '';?>">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                        <span class="help-block"><?php echo $name_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($author_err)) ? 'has-error': '';?>">
                        <label>Author</label>
                        <input type="text" name="author" class="form-control" value="<?php echo $author; ?>">
                        <span class="help-block"><?php echo $author_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($price_err)) ? 'has-error': '';?>">
                        <label>Price</label>
                        <input type="text" name="price" class="form-control" value="<?php echo $price; ?>">
                        <span class="help-block"><?php echo $price_err;?></span>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="index.php" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
    </html><?php
