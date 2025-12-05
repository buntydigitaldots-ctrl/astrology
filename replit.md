# AstroVastu Academy Website

## Overview
A professional PHP-based website for AstroVastu Academy Bathinda - an institute offering Vastu, Astro-Vastu & Astrology courses. The website showcases courses, provides information about the academy, and includes an admission inquiry system.

## Project Structure
```
public/                     # Document root (upload this to Hostinger's public_html)
├── index.php              # Home page
├── about.php              # About Us page
├── contact.php            # Contact page with admission form
├── submit-inquiry.php     # Form submission handler
├── vastu-course.php       # Vastu Shastra course details
├── astro-vastu-course.php # Astro-Vastu course details
├── astrology-course.php   # Astrology course details
├── includes/              # Header and footer components
│   ├── header.php         # Site header with navigation
│   └── footer.php         # Site footer
├── assets/
│   ├── css/
│   │   └── style.css      # All styles
│   ├── js/
│   │   └── main.js        # JavaScript functionality
│   └── images/            # All images including banners
├── admin/                 # Admin panel for managing inquiries
│   ├── index.php          # Admin login
│   ├── dashboard.php      # Inquiry management
│   └── logout.php         # Logout handler
└── data/                  # JSON storage for inquiries (created automatically)
```

## Hostinger Deployment Instructions
1. Download the `public` folder contents
2. Upload all files from `public/` to your Hostinger `public_html` folder
3. The structure should be:
   ```
   public_html/
   ├── index.php
   ├── about.php
   ├── contact.php
   ├── includes/
   ├── assets/
   ├── admin/
   └── ... (all other files)
   ```
4. Ensure PHP is enabled on your Hostinger hosting
5. Set proper file permissions (755 for folders, 644 for files)

## Features
- Modern responsive design with gradient themes
- Beautiful banner images on all pages
- Course information with detailed curriculum
- Admission inquiry form with admin panel
- Mobile-friendly navigation
- Animated elements and smooth scrolling

## Admin Panel
- URL: `/admin/`
- Default credentials: `DigitalDots` / `DigitalDots@001`
- Features: View and manage admission inquiries

## Technologies
- PHP 8.x
- HTML5/CSS3
- JavaScript (Vanilla)
- Font Awesome Icons
- Google Fonts (Poppins, Playfair Display)

## Recent Changes
- December 2024: Added beautiful generated banner images to all pages
- Restructured project for Hostinger deployment compatibility
- Updated path handling for subdirectory access
