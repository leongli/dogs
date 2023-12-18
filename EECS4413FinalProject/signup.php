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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">

</head>
<body>
    <!-- ?php include 'header.php'; ? -->
    <div class="container pt-5 text-center" style="font-family: 'Open Sans', sans-serif;">
        <div class="pt-5">
            <a href="<?php echo 'index.php'; ?> "><img src="images/logo_v2.png" alt="Logo" style="height:10vh;"></a>
            <h1 class="text-center pt-3" >Sign-up</h1>

            <style>
                .input {
                    border-radius: 5px;
                    border: solid thin #aaa;
                    padding: 13px;
                    margin: 4px;
                    width:40%;
                    
                }
                .button {
                    border-radius: 5px;
                    border: solid thin #aaa;
                    padding: 10px;
                    margin: 4px;
                    cursor: pointer;
                    width:40%;
                }
            </style>

            <form action="" method="post">

            <input class="input" type="text" name="firstname" placeholder="First Name" value="<?php echo (!empty($arr['firstname'])) ? $arr['firstname'] : ""; ?>"> <?php if(!empty($fnameErr)) { echo '<p style="color: red;">' . $fnameErr . '</p>';} ?><br>
            <input class="input" type="text" name="lastname" placeholder="Last Name" value="<?php echo (!empty($arr['lastname'])) ? $arr['lastname'] : ""; ?>"> <?php if(!empty($lnameErr)) { echo '<p style="color: red;">' . $lnameErr . '</p>';} ?><br>
            <input class="input" type="email" name="email" placeholder="Email" value="<?php echo (!empty($arr['email'])) ? $arr['email'] : ""; ?>"> <?php if(!empty($emailErr)) { echo '<p style="color: red;">' . $emailErr . '</p>';} ?><br>
            <input class="input" type="password" name="password" placeholder="Password" value="<?php echo (!empty($_POST['password'])) ? $_POST['password'] : ""; ?>"> <?php if(!empty($passErr)) { echo '<p style="color: red;">' . $passErr . '</p>';} ?><br>
            <br>
            <input class="button" type="submit" value="Sign-up"> <br>
            </form>

            <br> 
            <a href="login.php">Back to Login</a>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>

   