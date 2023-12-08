<?php
require_once('conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT passwords FROM users WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($hashedPassword);

    if ($stmt->fetch() && password_verify($password, $hashedPassword)) {
        session_start();
        $_SESSION['username'] = $username;

        $auth_token = bin2hex(random_bytes(32));
        setcookie('user_id', $user_id, time() + 86400 * 30, '/');
        setcookie('auth_token', $auth_token, time() + 86400 * 30, '/');

        header("Location: home.php");
        exit();
    } else {
        $errorMessage = "Invalid username or password";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body {
        background-color: #fafafa;
    }

    body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: linear-gradient(rgba(0, 0, 0, 0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(0, 0, 0, 0.1) 1px, transparent 1px);
            background-size: 20px 20px;
            z-index: -1;
        }

    .container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 30px;
        max-width: 400px;
        margin: auto;
        margin-top: 100px;
    }

    h2 {
        text-align: center;
        color: #FF1493;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        color: #333;
    }

    .btn-primary {
        background-color: #FF1493;
        border: none;
        width: 100%;
    }

    .btn-primary:hover {
        background-color: #34495e;
    }

    p {
        text-align: center;
        margin-top: 15px;
    }

    a {
        color: #3498db;
    }

    a:hover {
        text-decoration: underline;
    }

    .alert {
        margin-top: 20px;
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
    }
</style>
</head>

<body>
    <div class="container mt-5">
        <h2>Login</h2>

        <?php if (isset($errorMessage)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>

        <form id="login-form" action="login.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a>.</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
