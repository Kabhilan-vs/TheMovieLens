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
    input[type="password"],
    input[type="text"] {
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
  <title>Login Page - Sign In</title>
</head>
<body>
  <div class="container">
    <form id="loginForm" class="form-container" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <h2>Sign In</h2>
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" id="email" name="email" placeholder="Enter email" required>
      </div>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter username" required>
      </div>
    
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Password" required>
      </div>
      <button type="submit" class="btn" name="login">Sign In</button>
      <p id="errorMessage" class="message" style="color: red; display: none;"></p>
      <p class="message">Not registered? <a href="signup.php">Create an account</a></p>
    </form>
  </div>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
      $email = $_POST['email'];
      $username = $_POST['username'];
      $password = $_POST['password'];

      // Read user data from the file
      $file = fopen("WP Project/users.txt", "r");

      // Initialize flag for successful login
      $loginSuccessful = false;

      // Loop through each line in the file
      while (!feof($file)) {
          $line = fgets($file);
          $userData = explode(",", $line);

          // Check if email, username, and password match
          if (trim($userData[0]) == $email && trim($userData[1]) == $username && trim($userData[2]) == $password) {
              $loginSuccessful = true;
              break; // Exit the loop once a match is found
          }
      }

      // Close the file
      fclose($file);

      // If login is successful, redirect to index.html
      if ($loginSuccessful) {
          echo "<script>alert('Login successful!');</script>";
          header("Location: WP Project/index.html");
          exit;
      } else {
          // If login is unsuccessful, display error message
          echo "<script>document.getElementById('errorMessage').innerText = 'Invalid email, username, or password'; document.getElementById('errorMessage').style.display = 'block';</script>";
      }
  }
  ?>
</body>
</html>
