<?php
require __DIR__.'/../controler/users.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .signup-form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .signup-form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .signup-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .signup-form input[type="text"],
        .signup-form input[type="email"],
        .signup-form input[type="password"],
        .signup-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .signup-form button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: white;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .signup-form button:hover {
            background-color: #0056b3;
        }
        .signup-form .login-link {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }
        .signup-form .login-link a {
            color: #007bff;
            text-decoration: none;
        }
        .signup-form .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <form class="signup-form" action="sign_up.php" method="POST">
        <h2>Signup</h2>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required>
        
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>
        
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>
        
        <label for="bio">Bio</label>
        <textarea id="bio" name="bio" rows="4" placeholder="Ecrire le bio"></textarea>
        
        <button type="submit" name="submit">Sign Up</button>
        
        <div class="login-link">
            Already have an account? <a href="login.php">sign in</a>
        </div>
    </form>
    <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__.'/../controler/users.php';
    $response = UsersController::signup($_POST);
    echo $response;
}
?>
</body>
</html>
