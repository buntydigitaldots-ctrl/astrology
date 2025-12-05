<?php
$page_title = "Contact Us - AstroVastu Academy Bathinda | Admission Inquiry";
$page_description = "Contact AstroVastu Academy Bathinda for admission inquiries. Fill the form for Vastu, Astro-Vastu & Astrology course enrollment. Call us today!";
include 'includes/header.php';

$success = isset($_GET['success']) ? true : false;
?>

<section class="page-banner page-banner-contact">
    <div class="container">
        <h1>Contact Us</h1>
        <p>Get in Touch for Admission Inquiries</p>
        <div class="breadcrumb">
            <a href="index.php">Home</a>
            <i class="fas fa-chevron-right"></i>
            <span>Contact</span>
        </div>
    </div>
</section>

<section class="section contact-section" style="background: white;">
    <div class="container">
        <div class="contact-grid" style="align-items: flex-start;">
            <div class="contact-info" style="color: var(--text-dark);">
                <h2 style="color: var(--text-dark);">Get In Touch</h2>
                <p style="color: var(--text-light);">Have questions about our courses? Ready to enroll? Contact us today and take the first step towards your new career in Vastu & Astrology.</p>
                
                <div class="contact-details" style="margin-top: 40px;">
                    <div class="contact-item" style="background: var(--bg-light);">
                        <i class="fas fa-map-marker-alt" style="background: var(--gradient-primary); color: white;"></i>
                        <div>
                            <h4 style="color: var(--text-light);">Our Location</h4>
                            <span style="color: var(--text-dark);">Mall Road, Near Mittal Mall, Bathinda, Punjab</span>
                        </div>
                    </div>
                    <div class="contact-item" style="background: var(--bg-light);">
                        <i class="fas fa-phone-alt" style="background: var(--gradient-primary); color: white;"></i>
                        <div>
                            <h4 style="color: var(--text-light);">Phone Number</h4>
                            <span style="color: var(--text-dark);">+91 XXXXX XXXXX</span>
                        </div>
                    </div>
                    <div class="contact-item" style="background: var(--bg-light);">
                        <i class="fas fa-envelope" style="background: var(--gradient-primary); color: white;"></i>
                        <div>
                            <h4 style="color: var(--text-light);">Email Address</h4>
                            <span style="color: var(--text-dark);">info@astrovastuacademy.com</span>
                        </div>
                    </div>
                    <div class="contact-item" style="background: var(--bg-light);">
                        <i class="fas fa-clock" style="background: var(--gradient-primary); color: white;"></i>
                        <div>
                            <h4 style="color: var(--text-light);">Working Hours</h4>
                            <span style="color: var(--text-dark);">Mon - Sat: 9:00 AM - 7:00 PM</span>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 40px;">
                    <h3 style="color: var(--text-dark); margin-bottom: 20px;">Follow Us</h3>
                    <div class="footer-social">
                        <a href="#" class="social-link" style="background: var(--gradient-primary); color: white;"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link" style="background: var(--gradient-primary); color: white;"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link" style="background: var(--gradient-primary); color: white;"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="social-link" style="background: var(--gradient-primary); color: white;"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="contact-form-box" id="admission-form" style="box-shadow: var(--shadow-lg);">
                <h3>Admission Inquiry Form</h3>
                
                <?php if($success): ?>
                <div class="success-message">
                    <i class="fas fa-check-circle"></i>
                    <span>Thank you! Your inquiry has been submitted successfully. We will contact you soon.</span>
                </div>
                <?php endif; ?>
                
                <form action="submit-inquiry.php" method="POST">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Full Name *</label>
                            <input type="text" id="name" name="name" required placeholder="Enter your full name">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" required placeholder="Your phone number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="Your email address">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" placeholder="Your city">
                        </div>
                        <div class="form-group">
                            <label for="occupation">Occupation</label>
                            <input type="text" id="occupation" name="occupation" placeholder="Your profession">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="course">Interested Course *</label>
                        <select id="course" name="course" required>
                            <option value="">Select a Course</option>
                            <option value="Vastu Course">Vastu Shastra Course</option>
                            <option value="Astro-Vastu Course">Astro-Vastu Course (Premium)</option>
                            <option value="Astrology Course">Astrology/Jyotish Course</option>
                            <option value="All Courses">All Courses Package</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="batch">Preferred Batch</label>
                        <select id="batch" name="batch">
                            <option value="">Select Preference</option>
                            <option value="Weekday">Weekday Batch</option>
                            <option value="Weekend">Weekend Batch</option>
                            <option value="Online">Online Classes</option>
                            <option value="Fast-Track">Fast-Track Batch</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message">Message / Questions</label>
                        <textarea id="message" name="message" placeholder="Any specific questions or requirements? Tell us about your background and goals..."></textarea>
                    </div>
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-paper-plane"></i> Submit Inquiry
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="section" style="background: var(--bg-light); padding: 60px 0;">
    <div class="container">
        <div class="section-header">
            <span class="section-badge"><i class="fas fa-map-marked-alt"></i> Our Location</span>
            <h2 class="section-title">Find <span>Us</span></h2>
        </div>
        <div style="background: white; border-radius: 20px; overflow: hidden; box-shadow: var(--shadow-md);">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d109744.22830073498!2d74.8829853!3d30.2109528!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39173283e23b0c9f%3A0x1d3e2d3e77c8c1e0!2sBathinda%2C%20Punjab!5e0!3m2!1sen!2sin!4v1635000000000!5m2!1sen!2sin" 
                width="100%" 
                height="400" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2>Ready to Start Your Journey?</h2>
            <p>Limited seats available. Enroll today!</p>
            <a href="tel:+91XXXXXXXXXX" class="cta-btn">
                <i class="fas fa-phone-alt"></i> Call Now
            </a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
