<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashbroad</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2 class="pull-left">Books Information</h2>
                    <a href="create.php" class="btn btn-success pull-right">Add new book</a>
                </div>
                <?php
                require_once 'config.php';
                //attempt select query execution
                $sql = "SELECT * FROM books";
                if ($result = mysqli_query($link, $sql)){
                    if(mysqli_num_rows($result)> 0){
                        echo"<table class = 'table table-bordered table-striped'>";
                        echo "<thead>";
                        echo"<tr>";
                        echo "<th>#</th>";
                        echo "<th>Name</th>";
                        echo "<th>Author</th>";
                        echo "<th>Price</th>";
                        echo "<th>Action</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while ($row = mysqli_fetch_array($result)){
                            echo "<tr>";
                            echo "<td>".$row['id']."</td>";
                            echo "<td>".$row['name']."</td>";
                            echo "<td>".$row['author']."</td>";
                            echo "<td>".$row['price']."</td>";
                            echo "<td>";
                            echo "<a href='read.php?id=".$row['id']."'title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                            echo "<a href='update.php?id=".$row['id']."'title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-plus'></span></a>";
                            echo "<a href='delete.php?id=".$row['id']."'title='delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        //free result set
                        mysqli_free_result($result);
                    }else{
                        echo "<p class='lead'><em>No records were found</em></p>";
                    }
                }else{
                    echo "ERROR: Could not able to excute $sql. " .mysqli_error($link);
                }

                //close connection
                mysqli_close($link);
                ?>
            </div>
        </div>
    </div>
</div>
</body>
