<?php
include_once "autoloader.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $token = DB::getInstance()->signIn($_POST['email'],$_POST['password']);
    if ($token){
        setcookie("session_token",$token,time()+60*60*24*365);
        echo "Success!";
    } else {
        echo "Bad";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Login</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<?php
$token = $_COOKIE['session_token'];

if (isset($token)){
    $user = DB::getInstance()->checkToken($token);
    if ($user){
        echo "Hello, ".$user->name;
    }
}
?>
<h1>Log in</h1>
<form method="post">
    <div>
        <input placeholder="email" name="email" value="test@ya.ru">
    </div>
    <div>
        <input placeholder="password" name="password" type="password" value="test" >
    </div>
    <div>
        <button type="submit">Enter</button>
    </div>
</form>

</body>
</html>