<?php
$EmailError = $PasswordError = "";
$Email = $Password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["Email"])) {
        $EmailError = "Email is required";
    } else {
        $Email = $_POST["Email"];
    }
    if (empty($_POST["Password"])) {
        $PasswordError = "Password is required";
    } else {
        $Password = $_POST["Password"];
    }
    if ($Email && $Password) {
        include("connections.php");
        $check_Email = mysqli_query($connections, "SELECT * FROM dimamaytb WHERE Email = '$Email'");
        $check_Email_row = mysqli_num_rows($check_Email);
        if ($check_Email_row > 0) {
            while ($row = mysqli_fetch_assoc($check_Email)) {
                $db_password = $row["Password"];
                $db_account_type = $row["Account_type"];
                if ($Password == $db_password) {
                  
                    session_start();
                    $_SESSION['user_Email'] = $Email;
                    $_SESSION['user_account_type'] = $db_account_type;

                    if ($db_account_type == "admin") {
                        echo "<script>window.location.href='admin.php';</script>";
                    } else {
                        echo "<script>window.location.href='User.php';</script>";
                    }
                }
            }
        }else{
          $EmailError= "Email is not registered";
      }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <style>
        .error {
            color: red;
        }
    </style>
    <title>Login</title>
</head>
<body>
    <form method="POST" action="Signin.php">
        <div class="container1">
            <h1>Login</h1>
            <div class="user-name">
                <input type="Email" name="Email" placeholder="Email" value="<?php echo htmlspecialchars($Email); ?>">
                <span class="error"><?php echo $EmailError; ?></span>
                <input type="password" name="Password" placeholder="Password" value="<?php echo htmlspecialchars($Password); ?>">
                <span class="error"><?php echo $PasswordError; ?></span>
            </div>
            <div class="sub-btn">
                <button type="submit">Login</button>
            </div>
            <div class="check-box-for-agreement">
                <a id="back-tl" href="Create.php">Create Account</a>
            </div>
        </div>
    </form>
</body>
</html>
