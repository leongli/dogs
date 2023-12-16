<?php 

    session_start(); 
    
    require_once('backend/config/config.php');
    require('backend/config/db.php');

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    $error = "";

    if($_SERVER['REQUEST_METHOD'] == "POST") { 
        
        $arr['email'] = $mysqli -> real_escape_string(test_input($_POST['email']));
        $arr['password'] = $mysqli -> real_escape_string(hash('sha1', test_input($_POST['password'])));
        
        $query = "SELECT * FROM users WHERE Email = ? && `Password` = ? LIMIT 1";
        $stm = $mysqli -> prepare($query);
        
        if($stm) {
            $stm -> bind_param("ss", $arr['email'], $arr['password']);
            // $check = $stm -> execute($arr);
            
            if($stm -> execute()) {
                $result = $stm -> get_result();
                $data = $result -> fetch_all(MYSQLI_ASSOC);
                if(is_array($data) && count($data) > 0) {
                    $_SESSION['myid'] = $data[0]['UserID'];
                    $_SESSION['myname'] = ($data[0]['FirstName'] . ' ' . $data[0]['LastName']);
                    $_SESSION['myrank'] = $data[0]['Rank'];
                    $result -> free_result();
                }
                else {
                    $error = "Wrong username or password";
                }
            }

            if($error == "") {
                header("Location: " . 'index.php');
                die;
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>
<body> 
    
    <a href="<?php echo 'index.php'; ?> ">Home</a>
    <h1>Login</h1>

    <?php   
    
    if($error != "") {
        echo "<br><span style=\"color:red\">" . $error . "</span><br><br>";
    }
    
    ?>
    <style>
        .input {
            border-radius: 5px;
            border: solid thin #aaa;
            padding: 10px;
            margin: 4px;
        }
        .button {
            border-radius: 5px;
            border: solid thin #aaa;
            padding: 10px;
            margin: 4px;
            cursor: pointer;
        }
    </style>

    <form action="" method="post">

    <input class="input" type="text" name="email" placeholder="Email" required> <br>
    <input class="input" type="password" name="password" placeholder="Password" required> <br>
    <br>
    <input class="button" type="submit" value="Login"> <br>
    </form>

    <br>
    <a href="signup.php">Sign-up</a>
    
</body>
</html>