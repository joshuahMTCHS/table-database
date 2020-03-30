<!doctype html>

<html lang = en>
    <head>
    <title>Delete App Data</title>
    <meta charset="utf-8">
    <style type="text/css">
        table{
            width: 100%;
            text-align: left;
            border-collapse: collapse;
        }
        body{
            background-color: #008080;
        }
        td{
            text-align: left;
        }
        th{
            text-align: left;
        }
        tr:nth-child(even) {background-color: #f2f2f2;}
        #sub{
            border-top: ridge 3px white;
            border-left: ridge 3px white;
            border-bottom: ridge 2px black;
            border-right: ridge 2px grey;
            background-color: rgb(192,192,192);
            color: black;
            padding: 3px;
        }
        </style>
        </head>
    <body>
        <h1>Delete a Character</h1>
        <?php
        ini_set('display_errors', 1);
        require('../../../etc/sqli_connect.php');
        
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        elseif (isset($_POST['id'])){
            $id = $_POST['id'];
        }
        else {
            echo "You should not be here. GO AWAY!";
        }
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $q = "DELETE FROM `Play Store` Where `id` = $id";
            $r = @mysqli_query($dbc, $q);
            if(mysqli_affected_rows($dbc) == 1) {
                echo '<p>The App data has been deleted!</p>';
            }
            else{
                '<p>The App data will not be deleted!</p>';
            }
        }
        else{
            $q = "SELECT `App` from `Play Store` Where `id` = $id";
            $r = @mysqli_query($dbc, $q);
            $row = mysqli_fetch_array($r, MYSQLI_BOTH);
            echo '<h3>App Name: ' . $row['App'] . '</h3>';
        }
        
        
        ?>
        
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <input type="submit" value="delete" id="sub"/>
        </form>
        <p><a href="index.php">Home</a></p>
    </body>
    