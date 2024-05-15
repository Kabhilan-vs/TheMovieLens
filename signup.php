<!DOCTYPE html>
<html lang="en">
<head>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      color: chartreuse;
      background-image: linear-gradient(to right, rgb(35, 71, 75), rgb(6, 6, 104));
    }
    
    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    
    .form-container {
      background-image: linear-gradient(to right , rgb(7, 84, 68),rgb(2, 2, 84));
      padding: 50px;
      transition: 0.8s;
      padding-right: 70px;
      border-radius: 5px;
      box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.864);
    }
    .form-container:hover{
      box-shadow: 10px 10px 10px rgb(0, 96, 128);
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    label {
      display: block;
      font-weight: bold;
    }
    
    input[type="email"],
    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    
    .btn {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 5px;
      background-color: #007bff;
      color: #ffffff;
      cursor: pointer;
    }
    
    .message {
      text-align: center;
    }
    
    .message a {
      color: #00f2ff;
      text-decoration: none;
    }
    
    .message a:hover {
      text-decoration: underline;
    }
  </style>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page - Sign Up</title>
</head>
<body>
  <div class="container">
    <form id="signupForm" class="form-container" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <h2>Sign Up</h2>
      <div class="form-group">
        <label for="signupEmail">Email address</label>
        <input type="email" id="signupEmail" name="signupEmail" placeholder="Enter email" required>
      </div>
      <div class="form-group">
        <label for="signupUsername">Username</label>
        <input type="text" id="signupUsername" name="signupUsername" placeholder="Enter username" pattern="^(?=.*[A-Z])(?!.*\s).*$" title="Username must contain at least one capital letter and no whitespaces" required>
      </div>
      <div class="form-group">
        <label for="signupPassword">Password</label>
        <input type="password" id="signupPassword" name="signupPassword" placeholder="Password" required>
      </div>
      <div class="form-group">
        <label for="confirmPassword">Confirm Password</label>
        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
      </div>
      <button type="submit" class="btn" name="signup">Sign Up</button>
      <p id="errorMessage" class="message" style="color: red; display: none;"></p>
      <p class="message">Already registered? <a href="signin.php" class="message">Sign In</a></p>
    </form>
  </div>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
      $signupEmail = $_POST['signupEmail'];
      $signupUsername = $_POST['signupUsername'];
      $signupPassword = $_POST['signupPassword'];
      $confirmPassword = $_POST['confirmPassword'];

      if ($signupPassword !== $confirmPassword) {
          echo "<script>document.getElementById('errorMessage').innerText = 'Passwords do not match'; document.getElementById('errorMessage').style.display = 'block';</script>";
      } else {
  
          $file = fopen("WP Project/users.txt", "a");

          fwrite($file, $signupEmail . "," . $signupUsername . "," . $signupPassword . "\n");

          // Close the file
          fclose($file);

          // Redirect to index.html
          header("Location: WP Project/index.html");
          exit;
      }
  }
  ?>
</body>
</html>
