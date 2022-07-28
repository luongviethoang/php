<?php
// Include config file

require_once 'config.php';

// Define variables and initialize with empty values
$name = $author = $price = "";
$name_err = $author_err = $price_err = "";

// Processing form data when form is submitted

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //validate name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)){
        $name_err = "please enter a name. ";
    }elseif (!filter_var(trim($_POST["name"]), FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^[a-zA-Z'.\s]+$/")))){
        $name_err = 'please enter a valid name.';
    }else{
        $name = $input_name;
    }
    //validate address
    $input_author = trim($_POST["author"]);
    if (empty($input_author)){
        $address_err = 'Please enter an author';
    }else{
        $author = $input_author;
    }

    //validate salary
    $input_price = trim($_POST["price"]);
    if(empty($input_price)){
        $price_err = "Please enter the price. ";
    }elseif(!ctype_digit($input_price)){
        $price_err = 'Please enter a positive integer value.';
    }else{
        $price = $input_price;
    }
    // check input errors before inserting in database
    if (empty($name_err) && empty($author_err) && empty($price_err)){
        //prepare an insert statement
        $sql = "INSERT INTO books (name, author, price) VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)){
            //Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt,"sss",$param_name, $param_author, $param_price);

            // Set parameters
            $param_name = $name;
            $param_author = $author;
            $param_price = $price;

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
    </head>
    <body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this from and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : '';?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($author_err))  ? 'has-error' : ''; ?>">
                            <label>Author</label>
                            <textarea name="address" class="form-control"><?php echo $author; ?></textarea>
                            <span class="help-block"><?php echo $author_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($price_err))  ? 'has-error' : ''; ?>">
                            <label>Price</label>
                            <input type="text" name="salary" class="form-control" value="<?php echo $price; ?>">
                            <span class="help-block"><?php echo $price_err; ?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value = "Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>
<?php
