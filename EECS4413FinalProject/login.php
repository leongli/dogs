<?php

session_start();

require_once('backend/config/config.php');
require('backend/config/db.php');

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $arr['email'] = $mysqli->real_escape_string(test_input($_POST['email']));
    $arr['password'] = $mysqli->real_escape_string(hash('sha1', test_input($_POST['password'])));

    $query = "SELECT * FROM users WHERE Email = ? && `Password` = ? LIMIT 1";
    $stm = $mysqli->prepare($query);

    if ($stm) {
        $stm->bind_param("ss", $arr['email'], $arr['password']);
        // $check = $stm -> execute($arr);

        if ($stm->execute()) {
            $result = $stm->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            if (is_array($data) && count($data) > 0) {
                $_SESSION['myid'] = $data[0]['UserID'];
                $_SESSION['myname'] = ($data[0]['FirstName'] . ' ' . $data[0]['LastName']);
                $_SESSION['myrank'] = $data[0]['Rank'];
                $result->free_result();
            } else {
                $error = "Wrong username or password";
            }
        }

        if ($error == "") {
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">

</head>

<body>
    <div class="container pt-5 text-center"  style="font-family: 'Open Sans', sans-serif;">
        <div class="pt-5">
            <a href="<?php echo 'index.php'; ?> "><img src="images/logo_v2.png" alt="Logo" style="height:10vh;"></a>
            <h1 class="text-center pt-3" >Login</h1>

            <?php

            if ($error != "") {
                echo "<br><span style=\"color:red\">" . $error . "</span><br><br>";
            }

            ?>
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
                <div class="text-center">
                    <input class="input" type="text" name="email" placeholder="Email" required> <br>
                </div>
                <div class="form-outlint mb-4">
                    <input class="input" type="password" name="password" placeholder="Password" required > <br>
                </div>
                
                <input class="button" type="submit" value="Login"> <br>


            </form>

            <br>
            <a href="signup.php">Sign-up</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>