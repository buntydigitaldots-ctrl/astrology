<?php
session_start();

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

$ADMIN_USERNAME = 'DigitalDots';
$ADMIN_PASSWORD_HASH = password_hash('DigitalDots@001', PASSWORD_DEFAULT);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    
    if ($username === $ADMIN_USERNAME && password_verify('DigitalDots@001', $ADMIN_PASSWORD_HASH) && $password === 'DigitalDots@001') {
        session_regenerate_id(true);
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - AstroVastu Academy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="login-page">
        <div class="login-box">
            <div class="logo-icon">
                <i class="fas fa-om"></i>
            </div>
            <h2>Admin Panel</h2>
            <p>AstroVastu Academy Bathinda</p>
            
            <?php if ($error): ?>
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i>
                <span><?php echo $error; ?></span>
            </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required placeholder="Enter password">
                </div>
                <button type="submit" class="submit-btn">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>
            
            <p style="margin-top: 30px; color: var(--text-light); font-size: 14px;">
                <a href="../index.php" style="color: var(--primary-color);">
                    <i class="fas fa-arrow-left"></i> Back to Website
                </a>
            </p>
        </div>
    </div>
</body>
</html>
