<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Qasimabad Car Showroom Association (QCSA)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Header Styles */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            padding: 1rem 0;
        }

        .header.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #667eea !important;
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            height: 100px;
            width: auto;
            margin-right: 10px;
        }

        .nav-link {
            font-weight: 500;
            margin: 0 0.5rem;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: #667eea !important;
        }

        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white;
        }

        /* Parallax Sections */
        .parallax-section {
            position: relative;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .hero-section {
            background-image: linear-gradient(135deg, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.3) 100%), 
                              url('https://images.unsplash.com/photo-1563720223185-11003d516935?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
            color: white;
            text-align: center;
        }

        .features-section {
            background-image: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(248, 249, 250, 0.9) 100%);
            color: #333;
            min-height: 80vh;
            padding: 5rem 0;
        }

        .about-section {
            background-image: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            color: #333;
            min-height: 80vh;
            padding: 5rem 0;
        }

        .team-section {
            background-image: linear-gradient(135deg, rgba(248, 249, 250, 0.9) 0%, rgba(255, 255, 255, 0.9) 100%);
            color: #333;
            min-height: 50vh;
            padding: 3rem 0;
        }

        .contact-section {
            background-image: linear-gradient(135deg, rgba(51, 51, 51, 0.9) 0%, rgba(73, 73, 73, 0.9) 100%);
            color: white;
            min-height: 60vh;
            padding: 5rem 0;
        }

        /* Content Styles */
        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero-content p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .btn-hero {
            background: white;
            color: #667eea;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-hero:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            color: #667eea;
        }

        /* Feature Cards */
        .feature-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .feature-icon {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 1.5rem;
        }

        .feature-card h3 {
            color: #333;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .feature-card p {
            color: #666;
            line-height: 1.6;
        }

        /* Team Cards */
        .team-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
        }

        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .team-image {
            margin-bottom: 1rem;
        }

        .team-image img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #667eea;
            transition: all 0.3s ease;
        }

        .team-card:hover .team-image img {
            border-color: #764ba2;
            transform: scale(1.05);
        }

        .team-info h4 {
            color: #667eea;
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .team-info .designation {
            color: #999;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0;
        }

        .team-info .bio {
            color: #666;
            line-height: 1.6;
            font-size: 0.95rem;
        }

        /* Section Headers */
        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-header h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #333;
        }

        .section-header p {
            font-size: 1.1rem;
            color: #666;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Contact Form */
        .contact-form {
            background: rgba(255, 255, 255, 0.1);
            padding: 2rem;
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }

        .contact-form .form-control {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
        }

        .contact-form .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .btn-contact {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-contact:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white;
        }

        /* Footer */
        .footer {
            background: #333;
            color: white;
            text-align: center;
            padding: 2rem 0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }

            .hero-content p {
                font-size: 1rem;
            }

            .section-header h2 {
                font-size: 2rem;
            }

            .parallax-section {
                background-attachment: scroll;
            }
        }

        /* Smooth Scrolling */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg header" id="header">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="<?= base_url('public/assets/images/car-logo.png') ?>" alt="QCSA Logo">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#team">Team</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('showrooms') ?>">Showrooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('showrooms') ?>">Election Commision</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <div class="container mt-5 pt-5">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
    </div>

    <!-- Hero Section -->
    <section id="home" class="parallax-section hero-section">
        <div class="container">
            <div class="hero-content">
                <h1>Welcome to Qasimabad Car Showroom Association</h1>
                <p>Your premier destination for quality vehicles and exceptional automotive services in Qasimabad.</p>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section">
        <div class="container">
            <div class="section-header">
                <h2>Why Choose QCSA?</h2>
                <p>Discover the exceptional services and benefits that make Qasimabad Car Showroom Association the perfect choice for your automotive needs.</p>
            </div>
            
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3>Quality Vehicles</h3>
                        <p>We offer a wide selection of high-quality, inspected vehicles from trusted dealers and showrooms.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <h3>Expert Services</h3>
                        <p>Professional automotive services including maintenance, repairs, and consultation from certified technicians.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3>Member Benefits</h3>
                        <p>Exclusive member benefits including discounts, priority service, and access to special events.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h3>Trusted Network</h3>
                        <p>Connect with a network of trusted showrooms and verified dealers in the Qasimabad area.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>Latest Inventory</h3>
                        <p>Stay updated with the latest vehicle inventory and new arrivals from our member showrooms.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h3>Customer Support</h3>
                        <p>Dedicated customer support to help you find the perfect vehicle and answer all your questions.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container">
            <div class="section-header">
                <h2>About QCSA</h2>
                <p>Learn more about Qasimabad Car Showroom Association and how we serve the automotive community.</p>
            </div>
            
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4">
                    <h3>Our Mission</h3>
                    <p>Qasimabad Car Showroom Association is dedicated to providing quality vehicles and exceptional automotive services to our community. We bring together the best showrooms and dealers in the area to serve your automotive needs.</p>
                    
                    <h3 class="mt-4">Member Showrooms</h3>
                    <p>Our association includes carefully selected showrooms and dealers who meet our high standards for quality, service, and customer satisfaction. Each member is committed to providing the best automotive experience.</p>
                    
                    <h3 class="mt-4">Community Focus</h3>
                    <p>We are more than just a car association - we are a community of automotive enthusiasts and professionals working together to serve the people of Qasimabad and surrounding areas.</p>
                </div>
                
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <div class="text-center p-3 bg-white rounded shadow-sm">
                                <i class="fas fa-user-plus fa-2x text-primary mb-2"></i>
                                <h5>Easy Membership</h5>
                                <p class="text-muted">Simple and quick membership registration</p>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="text-center p-3 bg-white rounded shadow-sm">
                                <i class="fas fa-cogs fa-2x text-success mb-2"></i>
                                <h5>Flexible Services</h5>
                                <p class="text-muted">Wide range of automotive services</p>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="text-center p-3 bg-white rounded shadow-sm">
                                <i class="fas fa-database fa-2x text-warning mb-2"></i>
                                <h5>Vehicle Database</h5>
                                <p class="text-muted">Comprehensive vehicle inventory management</p>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="text-center p-3 bg-white rounded shadow-sm">
                                <i class="fas fa-lock fa-2x text-danger mb-2"></i>
                                <h5>Trust & Quality</h5>
                                <p class="text-muted">Verified dealers and quality assurance</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section id="team" class="team-section">
        <div class="container">
            <div class="section-header" style="margin-bottom: 2rem;">
                <h2>Our Team</h2>
                <p>Meet the dedicated professionals who make Qasimabad Car Showroom Association a trusted name in the automotive industry.</p>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-2 col-md-3 col-sm-6 mb-4">
                    <div class="team-card">
                        <div class="team-image">
                            <img src="<?= base_url('public/assets/team/1.jpeg') ?>"  alt="Team Member" class="img-fluid">
                        </div>
                        <div class="team-info">
                            <h4>Muhammad Yaseen Beharn</h4>
                            <p class="designation">PRESIDENT</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-3 col-sm-6 mb-4">
                    <div class="team-card">
                        <div class="team-image">
                            <img src="<?= base_url('public/assets/team/4.jpeg') ?>" alt="Team Member" class="img-fluid">
                        </div>
                        <div class="team-info">
                            <h4>Zuhaib Jakhro</h4>
                            <p class="designation">VICE PRESIDENT</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-3 col-sm-6 mb-4">
                    <div class="team-card">
                        <div class="team-image">
                            <img src="<?= base_url('public/assets/team/2.jpeg') ?>" alt="Team Member" class="img-fluid">
                        </div>
                        <div class="team-info">
                            <h4>Syed Zulfiqar Ali Shah</h4>
                            <p class="designation">Chairman</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-3 col-sm-6 mb-4">
                    <div class="team-card">
                        <div class="team-image">
                            <img src="<?= base_url('public/assets/team/3.jpeg') ?>" alt="Team Member" class="img-fluid">
                        </div>
                        <div class="team-info">
                            <h4>Gullam Shabeer Memon</h4>
                            <p class="designation">Vice Chairman</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-3 col-sm-6 mb-4">
                    <div class="team-card">
                        <div class="team-image">
                            <img src="<?= base_url('public/assets/team/5.jpeg') ?>" alt="Team Member" class="img-fluid">
                        </div>
                        <div class="team-info">
                            <h4>Kashif Khaskheli</h4>
                            <p class="designation">GENERAL SECRETARY</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-2 col-md-3 col-sm-6 mb-4">
                    <div class="team-card">
                        <div class="team-image">
                            <img src="<?= base_url('public/assets/team/8.jpeg') ?>" alt="Team Member" class="img-fluid">
                        </div>
                        <div class="team-info">
                            <h4>Imran Bhatti</h4>
                            <p class="designation">INFORMATION SECRETARY</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-3 col-sm-6 mb-4">
                    <div class="team-card">
                        <div class="team-image">
                            <img src="<?= base_url('public/assets/team/7.jpeg') ?>" alt="Team Member" class="img-fluid">
                        </div>
                        <div class="team-info">
                            <h4>Anil Behrani</h4>
                            <p class="designation">OFFICE SECRETARY</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-3 col-sm-6 mb-4">
                    <div class="team-card">
                        <div class="team-image">
                            <img src="<?= base_url('public/assets/team/6.jpeg') ?>" alt="Team Member" class="img-fluid">
                        </div>
                        <div class="team-info">
                            <h4>Abdul Waheed (Paali)</h4>
                            <p class="designation">JOINT SECRETARY</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-3 col-sm-6 mb-4">
                    <div class="team-card">
                        <div class="team-image">
                            <img src="<?= base_url('public/assets/team/9.jpeg') ?>" alt="Team Member" class="img-fluid">
                        </div>
                        <div class="team-info">
                            <h4>Manshad Burdi                             </h4>
                            <p class="designation">FINANCE SECRETARY</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section">
        <div class="container">
            <div class="section-header">
                <h2>Get In Touch</h2>
                <p>Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="contact-form">
                        <form>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" placeholder="Your Name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="email" class="form-control" placeholder="Your Email" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Subject" required>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" rows="5" placeholder="Your Message" required></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-contact">
                                    <i class="fas fa-paper-plane me-2"></i>Send Message
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-car me-2"></i>Qasimabad Car Showroom Association</h5>
                    <p>Your trusted automotive partner in Qasimabad.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p>&copy; <?= date('Y') ?> Qasimabad Car Showroom Association. All rights reserved.</p>
                    <div class="social-links">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-github"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Header scroll effect
        window.addEventListener('scroll', function() {
            const header = document.getElementById('header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Parallax effect for mobile devices
        if (window.innerWidth <= 768) {
            document.querySelectorAll('.parallax-section').forEach(section => {
                section.style.backgroundAttachment = 'scroll';
            });
        }
    </script>
</body>
</html>
