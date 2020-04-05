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
</head>
    <body>
    <h1>Login</h1>
    <form action="index.php" method="post">
    <label>Username:</label><input type="text" name="user" size="20" maxlength="20"/><br>
    <label>Password:</label><input type="password" name="pass" size="20" maxlength="20"/><br>
    <input type="submit" name="submit" value="Login" />
    </form>
    </body>
</html>