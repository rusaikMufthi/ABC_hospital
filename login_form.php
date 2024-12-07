<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - ABC Hospital</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap"
      rel="stylesheet"
    />
    <style>
      body {
        margin: 0;
        padding: 0;
        font-family: "Poppins", sans-serif;
        background: linear-gradient(to right, #ffdad6, #ffdace);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        color: #fff;
      }

      .login-container {
        background-color: #fff;
        color: #333;
        padding: 30px 40px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 400px;
        text-align: center;
      }

      .login-container h2 {
        margin-bottom: 20px;
        font-weight: 600;
        color: #ff6f61;
      }

      .form-group {
        margin-bottom: 20px;
        text-align: left;
      }

      .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 5px;
        font-size: 14px;
      }

      .form-group input {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ddd;
        border-radius: 5px;
      }

      .form-group input:focus {
        outline: none;
        border-color: #ff6f61;
        box-shadow: 0 0 5px rgba(255, 111, 97, 0.5);
      }

      .form-group button {
        width: 100%;
        background-color: #ff6f61;
        color: #fff;
        padding: 12px;
        font-size: 16px;
        font-weight: 600;
        border: none;
        border-radius: 5px;
        cursor: pointer;
      }

      .form-group button:hover {
        background-color: #ff9472;
      }

      .error {
        color: red;
        font-size: 12px;
        margin-top: -10px;
        margin-bottom: 10px;
      }

      .footer {
        margin-top: 20px;
        font-size: 14px;
        color: #aaa;
      }

      .footer a {
        color: #ff6f61;
        text-decoration: none;
      }

      .footer a:hover {
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
  <div class="login-container">
    <h2>Login to ABC Hospital</h2>
    <?php 
    session_start();
    if (!empty($_SESSION['error'])) {
        echo "<div style='color:red;'>" . $_SESSION['error'] . "</div>";
        unset($_SESSION['error']); // Clear the error after displaying it
    }
    ?>
    <form action="login.php" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required />
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required />
        </div>
        <div class="form-group">
            <button type="submit">Login</button>
        </div>
    </form>
</div>

  </body>
</html>
