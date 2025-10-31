<?php 
require 'connection/db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name'] ?? '');
    $email   = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (!$name || !$email || !$message) {
        $error = "Please complete the required fields.";
    } else {
        $stmt = $pdo->prepare(
            "INSERT INTO contact_messages (name, email, subject, message) VALUES (?,?,?,?)"
        );
        $stmt->execute([$name, $email, $subject, $message]);

        // Later: send email notifications via SMTP
        $success = "Thanks! Your message has been received.";
    }
}

include 'includes/header.php'; 

$enquiry     = $_GET['enquiry'] ?? null;
$enquiryList = $_SESSION['enquiry'] ?? [];
?> 

<main>
    <section class="page-header">
        <div class="container text-center">
            <h1 class="text-white">Get In Touch</h1>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <h2 class="section-title">Contact Information</h2>
                    <p class="mb-4">We're here to answer any questions you may have. Reach out to us and we'll respond as soon as we can.</p>
                    
                    <div class="contact-item">
                        <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div>
                            <h5>Our Office</h5>
                            <p>Your Company Address, Bhopal, Madhya Pradesh</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="icon"><i class="fas fa-envelope"></i></div>
                        <div>
                            <h5>Email Us</h5>
                            <p><a href="mailto:info@simption.com">info@simption.com</a></p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="icon"><i class="fas fa-phone"></i></div>
                        <div>
                            <h5>Call Us</h5>
                            <p><a href="tel:+911234567890">+91 12345 67890</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="contact-form-wrapper">
                        <h2 class="section-title">Send Us a Message</h2>
                        <form action="contact_send.php" method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="name" placeholder="Full Name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <textarea class="form-control" name="message" rows="5" placeholder="Your Message" required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
