<?php
include_once("./php/login.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Login</title>
  <link rel="stylesheet" href="login.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body>
  <div class="login-container">
    <form class="login-box" action="" method="post">
      <h2><i class="fa-solid fa-user-shield"></i> Admin Login</h2>

      <div class="input-group">
        <label for="user_id"><i class="fa-solid fa-user"></i> UserID</label>
        <input
          type="text"
          id="user_id"
          name="user_id"
          placeholder="Enter your userID"
          required />
      </div>

      <div class="input-group">
        <label for="password"><i class="fa-solid fa-lock"></i> Password</label>
        <input
          type="password"
          id="password"
          name="password"
          placeholder="Enter your password"
          required />
      </div>

      <!-- <div class="options">
          <label><input type="checkbox" id="remember" /> Remember Me</label>
          <a href="#" class="forgot">Forgot Password?</a>
        </div> -->

      <button type="submit" class="login-btn">Login</button>
      <?php if ($error): ?>
        <p class="credentialError"><?php echo htmlspecialchars($error) ?></p>
      <?php endif; ?>
    </form>
  </div>
</body>

</html>