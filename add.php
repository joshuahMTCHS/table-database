<!doctype html>

<html lang = en>
    <head>
    <title>Add App Data</title>
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
        require('../../../etc/sqli_connect.php');
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $newId = $_REQUEST['newId'];
            $app = $_REQUEST['app'];
            $category = $_REQUEST['category'];
            $rating = $_REQUEST['rating'];
            $reviews = $_REQUEST['reviews'];
            $type = $_REQUEST['type'];
            $price = $_REQUEST['price'];
            
            //SQL ZONE
            $q = "INSERT INTO `Play Store`(`id`, `App`, `Category`, `Rating`, `Reviews`, `Type`, `Price`) VALUES ('$newId', '$app', '$category', '$rating', '$reviews', '$type', '$price')";
            $r = @mysqli_query($dbc, $q);
            if($r){
                echo '<p>The App has been added</p>';
            }else{
                echo '<p>App has not been added</p>';
            }
        }
        echo '<form action="" method="POST">
        <h1>Add an App</h1>
        <p>Id:<input type="text" name="newId">Make ID above 11,000</p>
        <p>Name:<input type="text" name="app"></p>
        <p>Rating:<input type="text" name="rating"></p>
        <p>Category:<input type="text" name="category"></p>
        <p>Reviews:<input type="text" name="reviews"></p>
        <p>Type:<input type="text" name="type"></p>
        <p>Price:<input type="text" name="price"></p>
        <input type="submit" value="add" id="sub"/></form>';
        ?>
        
        <p><a href="index.php">Home</a></p>
    </body>
    