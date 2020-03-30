<!doctype html>

<html lang = en>
    <head>
    <title>Play Store App Data</title>
    <meta charset="utf-8">
    <style type="text/css">
        body{
            background-color: #008080;
        }
        table{
            width: 100%;
            text-align: left;
            border-collapse: collapse;
            
            border-top: ridge 3px white;
            border-left: ridge 3px white;
            border-bottom: ridge 2px black;
            border-right: ridge 2px grey;
            background-color: rgb(192,192,192);
            color: black;
            padding: 3px;
        }
        a:link{
            text-decoration-color: none;
            color: white;
        }
        a:visited{
            text-decoration-color: none;
            color: white;
        }
        td{
            text-align: left;
        }
        th{
            text-align: left;
        }
        
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
        <form action="" method="post">
            <label>Search</label>
            <input type="text" name="search" value="<?php if(isset($_POST['search'])) echo $_POST['search']; ?>"/>
            <input type="submit" value="Submit" id="sub"/>
        </form>
        <p><a href="add.php">Add your own App!</a></p>
        <?php
        require_once('../../../etc/sqli_connect.php');
        
        $display = 200;
        // Gets a count of all the items in the database
        if (isset($_GET['p']) && is_numeric($_GET['p'])) {
            $pages = $_GET['p'];
        }
        else{
            $q = "SELECT COUNT(id) FROM `Play Store`";
            $r = @mysqli_query($dbc, $q);
            $row = @mysqli_fetch_array($r, MYSQLI_NUM);
            $records = $row[0];
            
            //Calculates them pages
            if ($records > $display) {
                $pages = ceil ($records/$display);
            }
            else{
                $pages = 1;
            }
            // p IF ended
        }
        
        // Determine starting point
        if (isset($_GET['s']) && is_numeric($_GET['s'])){
            $start = $_GET['s'];
        }
        else{
            $start = 0;
        }
        if(isset($_POST['search'])){
            $start = 0;
        }
        // Creates the links for other pages
        if ($pages > 1) {
            // Spacing and p tag
            echo '<br><p>';
                
            // Determine current page
            $current_page = ($start/$display) + 1;
            
            // If not the first page, make a prev link
            if ($current_page != 1) {
                echo '<a href="index.php?s=' . ($start - $display) . '&p=' . $pages . '">Previous &nbsp;</a>';
            }
            
            // Make all the numbered pages
            for ($i = 1; $i <= $pages; $i++) {
                if($i != $current_page) {
                    echo '<a href="index.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '">' . $i . '</a> ';
                }
                else{
                    echo $i . ' ';
                }
            }// end of FOR loop
            
            // if not the last page, make a NEXT button
            if ($current_page != $pages) {
                echo '<a href="index.php?s=' . ($start + $display) . '&p=' . $pages . '">Next</a>';
            }
            
            echo '</p>'; // Close of p tag
            
        } // End of the links section
        
        $order_by = 'id ASC';
        $sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'idSort';
        
        switch ($sort) {
            case 'catSort':
                $order_by = 'Category DESC';
                break;
            case 'revSort';
                $order_by = 'Reviews DESC';
                break;
            case 'idSort';
                $order_by = 'id ASC';
                break;
        }
        
        
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $s = $_REQUEST['search'];
            $q = "SELECT `id`, `App`, `Category`, `Rating`, `Reviews`, `Type`, `Price` FROM `Play Store` WHERE `App` LIKE '%$s%' OR `Category` LIKE '%$s%' ORDER BY $order_by LIMIT $start, $display";
        }
        else{
            $q = "SELECT `id`, `App`, `Category`, `Rating`, `Reviews`, `Type`, `Price` FROM `Play Store` ORDER BY $order_by LIMIT $start, $display";
        }
        $r = @mysqli_query ($dbc, $q);
        if($r) {
            echo '<table><tr>
            <th>Edit</th>
            <th>Delete</th>
            <th><a href="index.php?sort=idSort">App</a></th>
            <th><a href="index.php?sort=catSort">Category</a></th>
            <th>Rating</th>
            <th><a href="index.php?sort=revSort">Reviews</a></th>
            <th>Type</th>
            <th>Price</th></tr>';
            while ($row = mysqli_fetch_array($r, MYSQLI_BOTH)) {
                echo '<tr><td><a href="edit.php?id=' . $row[0] . '">edit</a></td><td><a href="delete.php?id=' . $row[0] . '">delete</a></td><td>' . $row[1] . '</td><td>' . $row[2] . '</td><td>' . $row[3] . '</td><td>' . $row[4] . '</td><td>' . $row[5] . '</td><td>' . $row[6] . '</td></tr>';
            }
            echo '</table>';
        }
        else{
            echo mysqli_error($dbc);
        }
        
        ?>
        
    </body>
    