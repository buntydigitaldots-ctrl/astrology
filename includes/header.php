<?php
$base_path = dirname($_SERVER['SCRIPT_NAME']) === '/' ? '/' : dirname($_SERVER['SCRIPT_NAME']) . '/';
$base_path = str_replace('/admin', '', $base_path);
$base_path = rtrim($base_path, '/') . '/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo isset($page_description) ? $page_description : 'AstroVastu Academy Bathinda - Best Vastu, Astro-Vastu & Astrology Course. Become a Certified Consultant with Practical Training.'; ?>">
    <meta name="keywords" content="Vastu Course Bathinda, Astro-Vastu Course, Astrology Course Bathinda, Vastu Consultant Training, Vastu Institute Punjab, AstroVastu Academy">
    <meta name="author" content="AstroVastu Academy Bathinda">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="<?php echo isset($page_title) ? $page_title : 'AstroVastu Academy Bathinda'; ?>">
    <meta property="og:description" content="<?php echo isset($page_description) ? $page_description : 'Best Vastu, Astro-Vastu & Astrology Course in Bathinda'; ?>">
    <meta property="og:type" content="website">
    <title><?php echo isset($page_title) ? $page_title : 'AstroVastu Academy Bathinda - Best Vastu & Astrology Course'; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="<?php echo $base_path; ?>assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="logo">
                <div class="logo-icon">
                    <i class="fas fa-om"></i>
                </div>
                <div class="logo-text">
                    <span class="logo-main">AstroVastu</span>
                    <span class="logo-sub">Academy</span>
                </div>
            </a>
            <div class="nav-toggle" id="navToggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="nav-menu" id="navMenu">
                <li><a href="index.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="about.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>"><i class="fas fa-info-circle"></i> About Us</a></li>
                <li class="dropdown">
                    <a href="#" class="nav-link dropdown-toggle"><i class="fas fa-graduation-cap"></i> Courses <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="vastu-course.php"><i class="fas fa-compass"></i> Vastu Course</a></li>
                        <li><a href="astro-vastu-course.php"><i class="fas fa-star"></i> Astro-Vastu Course</a></li>
                        <li><a href="astrology-course.php"><i class="fas fa-moon"></i> Astrology Course</a></li>
                    </ul>
                </li>
                <li><a href="contact.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>"><i class="fas fa-envelope"></i> Contact</a></li>
                <li><a href="contact.php#admission-form" class="nav-link btn-enroll"><i class="fas fa-user-plus"></i> Enroll Now</a></li>
            </ul>
        </div>
    </nav>
    <div class="page-wrapper">
