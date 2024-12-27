<?php
include("Connections.php");
if(isset($_POST['submit'])){
   
    $search = $_POST['Search'];

    $sql = "SELECT * FROM dimamaytb WHERE Username = ?";
    $stmt = $connections->prepare($sql);
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style1.css">

    <title>User</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-dark color-white p-0">
  <a class="navbar-brand text-light ml-2"  href="#">User</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <ul class="nav nav-pills mr-auto" id="pills-tab" role="tablist">
  <li class="nav-item nav-item">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Dashboard</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
  </li>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <li class="nav-item">
      </li>
    </ul>
    <form class="form-inline mr-3">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="img/image.png"class="rounded-circle mb-3 " width="30" height="30"id="Menu">
        </a>
        <div class="dropdown-menu bg-white " aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item text-dark " href="Signin.php">logout</a>
        </div>
      </li>
    </form>
  </div>
</nav>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
    <form class="form-inline ml-3 mt-5" method="post">
      <input name="Search" class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" name="submit">Search</button>
    </form>
    <div class="container my-5">
      <table class="table table-hover table-transparent text-white">
        <thead>
          <tr>
            <th scope="col">Username</th>
            <th scope="col">Firstname</th>
            <th scope="col">Lastname</th>
            <th scope="col">Email</th
          </tr>
        </thead>
        <tbody>
              <?php       
            if(isset($result) && $result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {   
                echo "<tr>";
                echo "<td>" . $row['Username'] . "</td>";
                echo "<td>" . $row['Firstname'] . "</td>";
                echo "<td>" . $row['Lastname'] . "</td>";
                echo "<td>" . $row['Email'] . "</td>";
                echo "</tr>";
              }
            } else {
              echo "<p>No results found.</p>";
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="tab-pane fade text-center text-white" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    <?php
      session_start();
      include("Connections.php");

      if (!isset($_SESSION['user_Email'])) {
        header("Location: Signin.php");
        exit();
      }

      $userEmail = $_SESSION['user_Email'];
      $sql = "SELECT * FROM dimamaytb WHERE Email = ?";
      $stmt = $connections->prepare($sql);
      $stmt->bind_param("s", $userEmail);
      $stmt->execute();
      $result = $stmt->get_result();
    ?>
    <section>
      <div class="card">
        <?php 
          if(isset($result) && $result->num_rows > 0) {
            while ($profileData = $result->fetch_assoc()) {
              echo "<div class='card_profile_img'></div>";
                echo "<div class='user_details'>";
                  echo "<h3>" . $profileData['Email'] . "</h3>";
                  echo "<p>Email</p>";
                echo "</div>"; 
                echo "<div class='card_count'>";
                  echo "<h3>" . $profileData['Username'] . "</h3>";
                  echo "<p>Username</p>";
                  echo "<h3>" . $profileData['Firstname'] . "</h3>";
                  echo "<p>Firstname</p>";
                  echo "<h3>" . $profileData['Lastname'] . "</h3>";
                  echo "<p>Lastname</p>";
                  echo "<h3 type>" . $profileData['Password'] . "</h3>";
                  echo "<p>Password</p>";
                  echo "<h3>" . $profileData['Confirmpassword'] . "</h3>";
                  echo "<p>Confirm Password</p>";

                  echo "<a class='btn btn-success btn-lg btn-block'href='updates.php?Email=" . $profileData['Email'] ."'>Edit</a>";
                echo "</div>";
            }
          } else {
            echo "<p>No results found.</p>";
          }
        ?>
      </div>
    </div>
  </section>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
       <script src="js/jquery.min.js"></script>
       <script src="js/bootstrap.min.js"></script>
</body>
</html>
