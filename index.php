<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #a1c4fd, #c2e9fb);
            font-family: Arial, sans-serif;
        }
        .login-container {
            width: 400px;
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 20px;
            color: #333;
            font-weight: bold;
        }
        .logo {
            width: 100px;
            height: auto;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 25px;
        }
        .form-control {
            height: 45px;
            font-size: 16px;
            border-radius: 30px;
            padding: 10px 20px;
        }
        .btn-primary {
            background-color: #4a90e2;
            border: none;
            padding: 10px 20px;
            width: 100%;
            border-radius: 30px;
            font-size: 18px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #357ABD;
        }
        .form-control::placeholder {
            font-style: italic;
            color: #aaa;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Logo -->
        <img src="logo1.png" alt="Logo Roti Bakar Juara" class="logo">
        
        <h2>Login User</h2>
        <form action="login_process.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
