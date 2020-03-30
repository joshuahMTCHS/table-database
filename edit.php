<!doctype html>

<html lang = en>
    <head>
    <title>Edit App Data</title>
    <meta charset="utf-8">
    <style type="text/css">
        table{
            width: 100%;
            text-align: left;
            border-collapse: collapse;
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
        body{
            background-color: #008080;
            color: white;
        }
        a:link{
            color: white;
        }
        a:visited{
            color: white;
        }
        </style>
        </head>
    <body>
        <?php
        ini_set('display_errors', 1);
        
        require('../../../etc/sqli_connect.php');
        
        // Checks to see if the id is valid, through GET or POST
        if( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) {
            $id = $_GET['id'];
        }
        elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ){
            $id = $_POST['id'];
        }
        else{ // Kills the script
            echo 'Leave this place for you do not belong!';
        }
        
        if($_SERVER['REQUEST_METHOD']=='POST'){
            
            $n = $_REQUEST['name'];
            $ra = $_REQUEST['rating'];
            $c = $_REQUEST['category'];
            
            $int = 0;
            
            if ($int == 0) {
                // Make the query
                $q = "UPDATE `Play Store` SET `App` = '$n', `Rating` = '$ra', `Category` = '$c' WHERE `id`=$id LIMIT 1";
                $r = mysqli_query($dbc, $q);
                $row = @mysqli_fetch_array($r, MYSQLI_ASSOC);
                if (mysqli_affected_rows($dbc) == 1) { // If it ran properly
                    // Print message
                    echo '<p>The App Data has been edited.</p>';
                }
                }else{
                    echo 'YOU HAVE ERRORS';
                
                }
                } // End of if empty($errors) IF
        
            // Create the from
        echo '<form action="edit.php" method="POST">
        <h1>Edit App Data</h1>
        <p>Name:<input type="text" name="name" value="' . $row['App'] . '"></p>
        <p>Rating:<input type="text" name="rating" value="' . $row['Rating'] . '"></p>
        <p>Category:<input type="text" name="category" value="' . $row['Category'] . '"></p>
        <input type="hidden" name="id" value="' . $id . '">
        <input type="submit" value="edit" id="sub"/></form>';
        
        ?>
        <p><a href="index.php">Home</a></p>
    </body>
</html>
    