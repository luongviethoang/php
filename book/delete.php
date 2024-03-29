<?php
//process delete operation after confirmation
if (isset($_POST["id"]) && !empty($_POST["id"])){
    // Include config file
    require_once 'config.php';

    //prepare a select statement
    $sql = "DELETE FROM books WHERE  id = ?";

    if ($stmt = mysqli_prepare($Link, $sql)){
        //Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        //Set parameters
        $param_id = trim($_POST["id"]);

        //Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)){
            //Records deleted successfully. Redirect to landing page
            header("location: index. php");
            exit();
        }else{
            echo"Oops! Something went wrong. Please try again later.";
        }
    }
    //close statement
    mysqli_stmt_close($stmt);
    //close Connection
    mysqli_close($Link);
}else{
    //check existence of id parameter
    if (empty(trim($_GET["id"]))){
        //URL doesn't cotain id parameter. Edirect to error page
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
        <div class="container-fuild">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Delete Record</h1>
                    </div>
                    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>"method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Are you sure you want to delete this record?</p>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="index.php" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>
<?php
