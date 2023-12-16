<?php 

    require('config/config.php');
    require('config/db.php');

    $error = false;
    $nameErr = $emailErr = $passErr = "";

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function create_userid() {
        $length = rand(4,20);
        $number = "";

        for($i = 0; $i < $length; $i++) {
            $new_rand = rand(0,9);
            $number = $number . $new_rand;
        }

        return $number;
    }

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        
        if (empty($_POST["firstname"])) {
            $fnameErr = "First name is required";
            $error = true;
        } else {
            $arr['firstname'] = $mysqli -> real_escape_string(test_input($_POST['firstname']));

            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$arr['firstname'])) {
                $fnameErr = "Only letters and white space allowed";
                $error = true;
            }
        }

        if (empty($_POST["lastname"])) {
            $lnameErr = "Last name is required";
            $error = true;
        } else {
            $arr['lastname'] = $mysqli -> real_escape_string(test_input($_POST['lastname']));

            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$arr['lastname'])) {
                $lnameErr = "Only letters and white space allowed";
                $error = true;
            }
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
            $error = true;
        } else {
            $arr['email'] = $mysqli -> real_escape_string(test_input($_POST['email']));

            // check if e-mail address is well-formed
            if (!filter_var($arr['email'], FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
                $error = true;
            }
        }

        if (empty($_POST["password"])) {
            $passErr = "Password is required";
            $error = true;
        } else {
            $arr['password'] = hash('sha1', ($mysqli -> real_escape_string(test_input($_POST['password']))));
        }

        $arr['rank'] = "user";

        $arr['userid'] = create_userid();
        $condition = true;
        while($condition) {
            $query = "SELECT * FROM users WHERE UserID = ? LIMIT 1";
            $stm = $mysqli -> prepare($query);

            if($stm) {
                $stm -> bind_param("s", $arr['userid']);
            
                if($stm -> execute()) {
                    $result = $stm -> get_result();
                    $data = $result -> fetch_all(MYSQLI_ASSOC);
                    if(is_array($data) && count($data) > 0) {
                        $arr['userid'] = create_userid();
                        continue;
                    }
                }
            }
            $condition = false;
        }
        
        $query = "INSERT INTO users (UserID,FirstName,LastName,Email,`Password`,Rank) VALUES (?,?,?,?,?,?)";
        $stm = $mysqli -> prepare($query);

        if($stm && $error === false) {
            $stm -> bind_param("ssssss", $arr['userid'], $arr['firstname'], $arr['lastname'], $arr['email'], $arr['password'], $arr['rank']);
            if($stm -> execute()) {
                header("Location: login.php");
                die;
                
            } else {
                echo "Could not save to database";
            }
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <h1>Signup</h1>

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

    <input class="input" type="text" name="firstname" placeholder="First Name" value="<?php echo (!empty($arr['firstname'])) ? $arr['firstname'] : ""; ?>"> <?php if(!empty($fnameErr)) { echo '<p style="color: red;">' . $fnameErr . '</p>';} ?><br>
    <input class="input" type="text" name="lastname" placeholder="Last Name" value="<?php echo (!empty($arr['lastname'])) ? $arr['lastname'] : ""; ?>"> <?php if(!empty($lnameErr)) { echo '<p style="color: red;">' . $lnameErr . '</p>';} ?><br>
    <input class="input" type="email" name="email" placeholder="Email" value="<?php echo (!empty($arr['email'])) ? $arr['email'] : ""; ?>"> <?php if(!empty($emailErr)) { echo '<p style="color: red;">' . $emailErr . '</p>';} ?><br>
    <input class="input" type="password" name="password" placeholder="Password" value="<?php echo (!empty($_POST['password'])) ? $_POST['password'] : ""; ?>"> <?php if(!empty($passErr)) { echo '<p style="color: red;">' . $passErr . '</p>';} ?><br>
    <br>
    <input class="button" type="submit" value="Signup"> <br>
    </form>

    <br> 
    <a href="login.php">Login</a>

    <?php include 'footer.php'; ?>
</body>
</html>

   