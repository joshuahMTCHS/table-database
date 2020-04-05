<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        require_once('../../../etc/sqli_connect.php');
        
        function check_login($dbc, $user = '', $pass = ''){
            $errors = [];
            if(empty($user)){
                $errors[] = 'You forgot to enter a username';
            }else{
                $u = mysqli_real_escape_string($dbc, trim($user));
            }
            
            if(empty($pass)){
                $errors[] = 'You forgot to enter a password';
            }else{
                $p = mysqli_real_escape_string($dbc, trim($pass));
            }
            
            if(empty($errors)){
                $q = "SELECT username FROM users WHERE username = '$u' AND password = SHA2('$p', 512)";
                $r = mysqli_query($dbc, $q);
                if(mysqli_num_rows($r) == 1){
                    // login
                    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
                    session_start();
                    $_SESSION['user'] = $row['username'];
                    header('Location: table.php');
                    exit();
                }else{
                    $errors[] = 'Username and Password are not found';
                }
            }
            
            foreach ($errors as $e){
                echo $e . '<br>';
            }
        }
        check_login($dbc, $_POST['user'], $_POST['pass']);
    }
    
?>
<!doctype>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Login Page</title>
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
    <h1>Login</h1>
    <form action="index.php" method="post">
    <label>Username:</label><br><input type="text" name="user" size="20" maxlength="20"/><br><br>
    <label>Password:</label><br><input type="password" name="pass" size="20" maxlength="20"/><br><br>
    <input type="submit" name="submit" value="Login" id="sub"/>
    </form>
    </body>
</html>
