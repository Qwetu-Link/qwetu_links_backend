@extends('layout.app')

@section('title', $seo['title'])

@section('meta')
    <meta name="description" content="{{ $seo['description'] }}">
    <meta name="keywords" content="{{ $seo['keywords'] }}">
    <meta property="og:title" content="{{ $seo['og_title'] }}">
    <meta property="og:description" content="{{ $seo['og_description'] }}">
@endsection

@section('content')

    <!-- Fixed Navbar -->
    <div class="navbar">
        <div class="container">
            <a href="#home" style="display: flex; align-items: center;">
                <img class="logo-img" src="image/qwetu_link_rent.png" alt="Qwetu Link Rental Management Logo">
            </a>
            <div class="nav-links">
                <a href="#home">Home</a>
                <a href="#about-us">About Us</a>
                <a href="#features">Features</a>
                <a href="#pricing-plans">Pricing</a>
                <a href="#why">Why Us</a>
                <a href="#contact">Contact</a>
                <a href="#" class="btn-outline">Login / Sign Up</a>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container hero-grid">
            <div class="hero-content fade-up">
                <div class="hero-badge"><i class="fas fa-building"></i> All-in-One Property Management</div>
                <h1>Qwetu Link Rental Management</h1>
                <h2>Streamline Properties, Simplify Tenancy</h2>
                <p>Centralize rent collection, maintenance, leases, and financial reporting. The smart platform for
                    landlords, property managers, and tenants.</p>
                <div class="hero-stats">
                    <div class="stat-item">
                        <h3>10k+</h3>
                        <p>units managed</p>
                    </div>
                    <div class="stat-item">
                        <h3>98%</h3>
                        <p>on-time rent</p>
                    </div>
                </div>
                <button class="btn-primary"
                    onclick="document.getElementById('contact').scrollIntoView({behavior:'smooth'})">Request Demo <i
                        class="fas fa-arrow-right"></i></button>
            </div>
            <div class="hero-image fade-up">
                <i class="fas fa-building"></i>
            </div>
        </div>
    </section>

    <!-- About Us Section (Mission & Vision) -->
    <div class="container" id="about-us">
        <div class="section-title">About Us</div>
        <div class="about-us-grid fade-up">
            <div class="mission-vision-card">
                <i class="fas fa-bullseye"></i>
                <h3>Our Mission</h3>
                <p>To empower property owners and managers with an intuitive, automated rental platform that reduces
                    vacancies, streamlines operations, and maximizes returns.</p>
            </div>
            <div class="mission-vision-card">
                <i class="fas fa-eye"></i>
                <h3>Our Vision</h3>
                <p>To become the leading rental management ecosystem in Africa, creating seamless connections between
                    landlords and tenants through innovative technology.</p>
            </div>
        </div>
        <div class="about-wrapper fade-up" style="margin-top: 0;">
            <div class="about-text">
                <h3 style="margin-bottom: 16px; color: var(--rental-primary);">Who We Are</h3>
                <p>Qwetu Link Rental Management is part of Qwetu Links, dedicated to transforming the real estate
                    sector. We combine local market understanding with world-class technology to help you manage
                    properties effortlessly — from a single unit to hundreds.</p>
            </div>
            <div class="about-image">
                <img src="image/qwetu_link_rent.png" alt="Team Qwetu Rental Management">
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="container" id="features">
        <div class="section-title">Powerful Features</div>
        <div class="features-grid fade-up">
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-hand-holding-usd"></i></div>
                <h4>Automated Rent Collection</h4>
                <p>Online payments, auto-reminders, and late fee tracking – never chase rent again.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-tools"></i></div>
                <h4>Maintenance Portal</h4>
                <p>Tenants submit requests, assign vendors, track status – all in one place.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-file-signature"></i></div>
                <h4>Digital Lease Management</h4>
                <p>E-signatures, lease renewals, document storage – paperless and secure.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-chart-pie"></i></div>
                <h4>Financial Dashboards</h4>
                <p>Real-time P&L, expense tracking, and tax-ready reports.</p>
            </div>
        </div>
    </div>

    <!-- ========== NEW PRICING PLANS SECTION: 4 PACKAGES (cheapest → most expensive) ========== -->
    <div class="container" id="pricing-plans">
        <div class="section-title">Transparent Rental Plans</div>
        <div class="pricing-grid fade-up">
            <!-- PACKAGE 1: BASIC (Cheapest) -->
            <div class="pricing-card">
                <h3>Starter</h3>
                <div class="pricing-price">$29<span>/month</span></div>
                <div class="pricing-description">Perfect for small landlords starting out</div>
                <ul class="feature-list">
                    <li><i class="fas fa-check-circle"></i> Up to 15 rental units</li>
                    <li><i class="fas fa-check-circle"></i> Rent collection & reminders</li>
                    <li><i class="fas fa-check-circle"></i> Basic financial reports</li>
                    <li><i class="fas fa-check-circle"></i> Tenant database</li>
                    <li><i class="fas fa-times-circle"></i> Maintenance portal</li>
                    <li><i class="fas fa-times-circle"></i> Priority support</li>
                </ul>
                <button class="pricing-btn"
                    onclick="alert('✨ Starter plan: start managing your properties with ease. Contact us to activate.')">Get
                    Started →</button>
            </div>

            <!-- PACKAGE 2: STANDARD -->
            <div class="pricing-card">
                <h3>Professional</h3>
                <div class="pricing-price">$59<span>/month</span></div>
                <div class="pricing-description">Ideal for growing portfolios</div>
                <ul class="feature-list">
                    <li><i class="fas fa-check-circle"></i> Up to 50 rental units</li>
                    <li><i class="fas fa-check-circle"></i> Automated rent + late fees</li>
                    <li><i class="fas fa-check-circle"></i> Maintenance request portal</li>
                    <li><i class="fas fa-check-circle"></i> Digital lease templates</li>
                    <li><i class="fas fa-check-circle"></i> Email & chat support</li>
                    <li><i class="fas fa-times-circle"></i> Advanced analytics</li>
                </ul>
                <button class="pricing-btn"
                    onclick="alert('📈 Professional plan: unlock maintenance portal and leases. Get full control.')">Choose
                    Plan</button>
            </div>

            <!-- PACKAGE 3: PREMIUM (MOST POPULAR + RIBBON) -->
            <div class="pricing-card">
                <div class="popular-ribbon"><i class="fas fa-star"></i> Most Popular</div>
                <h3>Elite</h3>
                <div class="pricing-price">$99<span>/month</span></div>
                <div class="pricing-description">Everything you need to scale</div>
                <ul class="feature-list">
                    <li><i class="fas fa-check-circle"></i> Unlimited rental units</li>
                    <li><i class="fas fa-check-circle"></i> Full maintenance + vendor management</li>
                    <li><i class="fas fa-check-circle"></i> Advanced financial dashboard & P&L</li>
                    <li><i class="fas fa-check-circle"></i> Tenant mobile app access</li>
                    <li><i class="fas fa-check-circle"></i> Priority 24/7 support (Swahili/Eng)</li>
                    <li><i class="fas fa-check-circle"></i> E-sign & automated renewals</li>
                </ul>
                <button class="pricing-btn btn-premium"
                    onclick="alert('🔥 Elite plan (Most Popular) – unlimited units + premium support. Get the best value!')">Upgrade
                    Now</button>
            </div>

            <!-- PACKAGE 4: ENTERPRISE (Most expensive) -->
            <div class="pricing-card">
                <h3>Enterprise</h3>
                <div class="pricing-price">$179<span>/month</span></div>
                <div class="pricing-description">Custom solutions for large estates</div>
                <ul class="feature-list">
                    <li><i class="fas fa-check-circle"></i> Unlimited units + multi-property</li>
                    <li><i class="fas fa-check-circle"></i> Dedicated account manager</li>
                    <li><i class="fas fa-check-circle"></i> API access & custom integrations</li>
                    <li><i class="fas fa-check-circle"></i> White-glove onboarding & training</li>
                    <li><i class="fas fa-check-circle"></i> SLA-based support 24/7</li>
                    <li><i class="fas fa-check-circle"></i> Bulk tenant SMS & email campaigns</li>
                </ul>
                <button class="pricing-btn"
                    onclick="alert('🏢 Enterprise plan: contact our team for custom deployment & premium features.')">Contact
                    Sales</button>
            </div>
        </div>
    </div>

    <!-- Why Choose Us Section -->
    <div class="container" id="why">
        <div class="section-title">Why Qwetu Link Rental Management?</div>
        <div class="why-grid fade-up">
            <div class="why-card"><i class="fas fa-shield-alt"></i>
                <h4>Secure & Compliant</h4>
                <p>Bank-grade security, data encryption, and compliance with local tenancy laws.</p>
            </div>
            <div class="why-card"><i class="fas fa-charging-station"></i>
                <h4>Automated Workflows</h4>
                <p>Reduce manual work with automated rent reminders, invoice generation, and late fee calculation.</p>
            </div>
            <div class="why-card"><i class="fas fa-mobile-alt"></i>
                <h4>Tenant & Owner Apps</h4>
                <p>Dedicated mobile apps for tenants to pay rent and report issues, and for owners to track performance.
                </p>
            </div>
            <div class="why-card"><i class="fas fa-headset"></i>
                <h4>Local Support</h4>
                <p>24/7 customer support in English and Swahili, plus dedicated account managers for large portfolios.
                </p>
            </div>
        </div>
    </div>

    <!-- Pricing CTA (original early access) -->
    <div class="container">
        <div class="pricing-cta fade-up">
            <i class="fas fa-gem" style="font-size: 3rem; color: var(--rental-primary); margin-bottom: 16px;"></i>
            <h3>Launching Soon – Be Among the First</h3>
            <p>Sign up for early access and get 3 months free + premium onboarding.</p>
            <button class="btn-large"
                onclick="document.getElementById('contact').scrollIntoView({behavior:'smooth'})">Reserve Your Spot <i
                    class="fas fa-calendar-check"></i></button>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="container" id="contact">
        <div class="section-title">Get In Touch</div>
        <div class="contact-wrapper fade-up">
            <div class="contact-info">
                <h3>Let’s discuss your properties</h3>
                <p>Need help managing your rentals? Our team is ready to show you how Qwetu Link Rental Management can
                    save you time and increase your profits.</p>
                <div class="contact-details">
                    <p><i class="fas fa-envelope"></i> rentals@qwetulinks.com</p>
                    <p><i class="fas fa-phone-alt"></i> +254 700 123 456</p>
                    <p><i class="fas fa-map-marker-alt"></i> Nairobi, Kenya · Westlands Rd</p>
                </div>
                <div class="social-icons" style="justify-content: flex-start; margin-top: 20px;">
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="contact-form">
                <form id="contactForm">
                    <input type="text" placeholder="Full name" required>
                    <input type="email" placeholder="Email address" required>
                    <input type="text" placeholder="Phone number">
                    <textarea rows="3" placeholder="Tell us about your properties or inquiry..."></textarea>
                    <button type="submit">Send Message <i class="fas fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </div>

    <!-- Newsletter -->
    <div class="container">
        <div class="newsletter fade-up">
            <i class="fas fa-envelope-open-text"
                style="font-size: 2.5rem; color: var(--rental-primary); margin-bottom: 12px;"></i>
            <h3>Get rental management updates & offers</h3>
            <p>Subscribe to receive product news, landlord tips, and exclusive launch discounts.</p>
            <form class="news-form" id="subscribeForm">
                <input type="email" placeholder="Your email address" required id="subEmail">
                <button type="submit">Notify Me <i class="fas fa-bell"></i></button>
            </form>
        </div>
    </div>


@endsection
