<?php 

    require('config/config.php');
    require('config/db.php');

    $error = false;
    $nameErr = $emailErr = $passErr = "";

    /**
     * Sanitize and validate user input
     * @param string $data - the data to be sanitized
     * @return string - the sanitized data
     */
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    /**
     * Creates a random user id
     * @return string - the user id
     */
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
        // Validate the provided first name
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

        // Validate the provided last name
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

        // Validate the provided email
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

        // Validate the provided password
        if (empty($_POST["password"])) {
            $passErr = "Password is required";
            $error = true;
        } else {
            $arr['password'] = hash('sha1', ($mysqli -> real_escape_string(test_input($_POST['password']))));
        }

        // Validate the provided billing address
        if (empty($_POST["billingaddress"])) {
            // $bAddErr = "Billing address is required";
            // $error = true;
        } else {
            $arr['billingaddress'] = $mysqli -> real_escape_string(test_input($_POST['billingaddress']));

            // check if address only contains words, whitespace, comma & period
            if (!preg_match("/^[\w\s ,.]+$/",$arr['billingaddress'])) {
                $bAddErr = "Invalid billing address: only accepts words, whitespace, comma & period";
                $error = true;
            }
        }
        
        // Validate the provided shipping address
        if (empty($_POST["shippingaddress"])) {
            // $sAddErr = "Shipping address is required";
            // $error = true;
        } else {
            $arr['shippingaddress'] = $mysqli -> real_escape_string(test_input($_POST['shippingaddress']));

            // check if address only contains words, whitespace, comma & period
            if (!preg_match("/^[\w\s ,.]+$/",$arr['shippingaddress'])) {
                $sAddErr = "Invalid shipping address: only accepts words, whitespace, comma & period";
                $error = true;
            }
        }

        // Set the default rank to be "user"
        $arr['rank'] = "user";

        // Generate a new user id until a unique one is obtained
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
        
        // Create the new user in the database
        $query = "INSERT INTO users (UserID,FirstName,LastName,Email,`Password`,Rank,Shipping,Billing) VALUES (?,?,?,?,?,?,?,?)";
        $stm = $mysqli -> prepare($query);

        if($stm && $error === false) {
            $stm -> bind_param("ssssssss", $arr['userid'], $arr['firstname'], $arr['lastname'], $arr['email'], $arr['password'], $arr['rank'], $arr['shippingaddress'], $arr['billingaddress']);
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
    <title>Sign up</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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

            <!-- Form with all sign up fields -->
            <form action="" method="post">
            <?php if($error) { }?>
            <input class="input" type="text" name="firstname" placeholder="First Name *" value="<?php echo (!empty($arr['firstname'])) ? $arr['firstname'] : ""; ?>"> <?php if(!empty($fnameErr)) { echo '<p style="color: red;">' . $fnameErr . '</p>';} ?><br>
            <input class="input" type="text" name="lastname" placeholder="Last Name *" value="<?php echo (!empty($arr['lastname'])) ? $arr['lastname'] : ""; ?>"> <?php if(!empty($lnameErr)) { echo '<p style="color: red;">' . $lnameErr . '</p>';} ?><br>
            <input class="input" type="email" name="email" placeholder="Email *" value="<?php echo (!empty($arr['email'])) ? $arr['email'] : ""; ?>"> <?php if(!empty($emailErr)) { echo '<p style="color: red;">' . $emailErr . '</p>';} ?><br>
            <input class="input" type="password" name="password" placeholder="Password *" value="<?php echo (!empty($_POST['password'])) ? $_POST['password'] : ""; ?>"> <?php if(!empty($passErr)) { echo '<p style="color: red;">' . $passErr . '</p>';} ?><br>
            <input class="input" type="text" name="billingaddress" placeholder="Billing Address" value="<?php echo (!empty($arr['billingaddress'])) ? $arr['billingaddress'] : ""; ?>"> <?php if(!empty($bAddErr)) { echo '<p style="color: red;">' . $bAddErr . '</p>';} ?><br>
            <input class="input" type="text" name="shippingaddress" placeholder="Shipping Address" value="<?php echo (!empty($arr['billingaddress'])) ? $arr['billingaddress'] : ""; ?>"> <?php if(!empty($sAddErr)) { echo '<p style="color: red;">' . $sAddErr . '</p>';} ?><br>
            <p>* indicates required fields</p>
            <br>
            <input class="button" type="submit" value="Sign-up"> <br>
            </form>

            <br> 
            <a href="login.php">Back to Login</a>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>

   