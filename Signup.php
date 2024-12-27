<?php
include("connections.php");
$Username = $Firstname = $Lastname = $Email = $Password = $Confirmpassword = $Account_type = "";
$UsernameError = $FirstnameError = $LastnameError =  $EmailError = $PasswordError = $ConfirmpasswordError = $Account_typeError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["Username"])) {
        $UsernameError = "Username is required";
    } else {
        $Username = $_POST["Username"];
    }
    if (empty($_POST["Firstname"])) {
        $FirstnameError = "Firstname is required";
    } else {
        $Firstname = $_POST["Firstname"];
    }
    if (empty($_POST["Lastname"])) {
        $LastnameError = "Lastname is required";
    } else {
        $Lastname = $_POST["Lastname"];
    }
    if (empty($_POST["Email"])) {
        $EmailError = "Email is required";
    } elseif (!filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL)) {
        $EmailError = "Invalid email format";
    } else {
        $Email = $_POST["Email"];
    }
    if (empty($_POST["Password"])) {
        $PasswordError = "Password is required";
    } elseif (strlen($_POST["Password"]) < 6) {
        $PasswordError = "Password must be at least 6 characters";
    } else {
        $Password = $_POST["Password"];
    }
    if (empty($_POST["Confirmpassword"])) {
        $ConfirmpasswordError = "Confirm Password is required";
    } elseif ($_POST["Confirmpassword"] !== $_POST["Password"]) {
        $ConfirmpasswordError = "Passwords do not match";
    } else {
        $Confirmpassword = $_POST["Confirmpassword"];
    }
    if (empty($_POST["AccountType"])) {
        $Account_typeError = "Account type is required";
    } else {
        $Account_type = $_POST["AccountType"];
    }
    if (empty($UsernameError) && empty($FirstnameError) && empty($LastnameError) && empty($EmailError) && empty($PasswordError) && empty($ConfirmpasswordError) && empty($Account_typeError)) {
        $check_Email = mysqli_query($connections, "SELECT * FROM dimamaytb WHERE Email ='$Email'");
        $check_Email_row = mysqli_num_rows($check_Email);
        if ($check_Email_row > 0) {
            $EmailError = "Email is already Registered";
        } else {
            $query = mysqli_query($connections, "INSERT INTO dimamaytb (Username, Firstname, Lastname, Email, Password, Confirmpassword, Account_type) VALUES ('$Username', '$Firstname', '$Lastname', '$Email', '$Password', '$Confirmpassword', '$Account_type')");
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <style>
    .error {
      color: red;
    }
  </style>
  <title>Create An Account</title>
  <link rel="stylesheet" href="style.css"/>
  <link rel="icon" href="img/image.png">
</head>
<body>
  <form method="POST" action="create.php">
    <div class="container3">
      <h3>Create Account</h3>
      <div class="user-name">
        <input type="text" name="Username" placeholder="Username" value="<?php echo $Username; ?>">
        <span class="error"><?php echo $UsernameError; ?></span>
        <input type="text" name="Firstname" placeholder="Firstname" value="<?php echo $Firstname; ?>">
        <span class="error"><?php echo $FirstnameError; ?></span>
      </div>
      <div class="information">
        <input type="text" name="Lastname" placeholder="Lastname" value="<?php echo $Lastname; ?>">
        <span class="error"><?php echo $LastnameError; ?></span>
        <input type="email" name="Email" placeholder="Email" value="<?php echo $Email; ?>">
        <span class="error"><?php echo $EmailError; ?></span>
      </div>
      <div class="user-name">
        <input type="password" name="Password" placeholder="Password" value="<?php echo $Password; ?>">
        <span class="error"><?php echo $PasswordError; ?></span>
        <input type="password" name="Confirmpassword" placeholder="Confirmpassword" value="<?php echo $Confirmpassword; ?>">
        <span class="error"><?php echo $ConfirmpasswordError; ?></span>
      </div>
      <div class="user-name">
        <b class="type-form" for="accountType">Account Types:</b>
        <select class="account-type-btn" name="AccountType" id="accountType">
          <option class="user-option"  value="user">User</option>
          <option class="user-option" value="admin">Admin</option>
        </select>
      </div>
      <div class="check-box-for-agreement">
        <input type="checkbox"><a id="agree">
        <label for="agree">Agreement</a></label>
      </div>
      <div class="sub-btn">
        <button type="submit">Submit</button>
      </div>
      <div class="check-box-for-agreement">
        <a id="back-tl" href="Signin.php">Back To Login</a>
      </div>
    </div>
  </form>
</body>
</html>

