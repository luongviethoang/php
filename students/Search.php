<html>
<head>
    <title>Search Student</title>
</head>
<body>
<?php
    $name ='';
    if (!empty($_POST['name'])){
        $name = $_POST['name'];
        echo "finding record, {$_POST['name']}, and Result";
    }?>
    <form  action = "<?php echo $_SERVER['PHP_SELF']; ?>"method="post">
        Enter student name: <input type = "text" name = "name"/>
        <input type="submit" value="Search"/>
    </form>

    <?php
    $myDB = new mysqli('localhost', 'root','','Students');
    if ($myDB->connect_errno){
        die('Connect Error ('. $myDB->connect_errno.')'. $myDB->connect_error);
    }

    if ($name != ''){
        $sql = "SELECT * FROM student
        WHERE name LIKE '%{$name}%'
        ORDER BY  name";
    }else{
        $sql = "SELECT * FROM student
         ORDER BY name";
    }
    $result = $myDB->query($sql);
    ?>
    <table cellspacing="2" cellpadding="6" align="center" border="1">
        <tr>
            <td colspan="4">
                <h3 align="center"> Student List</h3>
            </td>
        </tr>
        <tr>
            <td align="center">Name</td>
            <td align="center">Class</td>
            <td align="center">Email</td>
        </tr>
        <?php
        while ($row = $result -> fetch_assoc()){
            echo "<tr>";
            echo "<td>";
                echo stripslashes($row["name"]);
            echo "</td><td align='center'>";
            echo $row["class"];
            echo "</td><td>";
            echo $row["email"];
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
