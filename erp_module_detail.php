<?php
require 'connection/db.php';

$moduleId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$moduleId) {
    header("Location: erp.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM erp_modules WHERE id = ?");
$stmt->execute([$moduleId]);
$module = $stmt->fetch();

// If module is not found in DB, create a placeholder module array
if (!$module) {
    $module = [
        'id' => $moduleId,
        'slug' => 'unknown',
        'title' => 'Unknown ERP Module',
        'description' => 'Details for this ERP module are not yet available.'
    ];
}

// Enhanced descriptions based on module ID, prioritizing consistency with header links
$enhancedDescription = '';
$displayTitle = $module['title']; // Default to DB title

switch ($moduleId) {
    case 1:
        $displayTitle = "School Management Software";
        $enhancedDescription = "<p>The School Management System is a comprehensive platform designed to streamline all administrative and academic operations of educational institutions. It covers student admissions, attendance tracking, grade management, timetable scheduling, fee collection, and communication with parents. This module centralizes data, reduces manual workload, and enhances overall efficiency, allowing educators to focus more on teaching and learning.</p>\n        <p>Key features include student information management, academic records, library management, transport management, and robust reporting tools for administrators.</p>";
        break;
    case 2:
        $displayTitle = "Attendance Management Systems";
        $enhancedDescription = "<p>Our Attendance Management System provides advanced tools for tracking and managing student and staff attendance across various departments. It supports multiple attendance methods including biometric (fingerprint, face recognition), RFID, QR codes, and manual entry. The system offers real-time attendance monitoring, automated reporting, and seamless integration with payroll and student information systems. It helps reduce absenteeism, ensures accurate record-keeping, and provides valuable insights into attendance patterns.</p>\n        <p>Features include daily/monthly attendance reports, leave management, holiday settings, and integration with various attendance devices.</p>";
        break;
    case 3:
        $displayTitle = "Website Development Services";
        $enhancedDescription = "<p>We offer professional website development services tailored for educational institutions and businesses. From responsive designs to robust backend systems, we build engaging and functional websites that enhance your online presence and streamline operations. Our services include custom design, e-commerce integration, content management systems, and ongoing maintenance.</p>\n        <p>Key features include modern UI/UX, SEO optimization, secure coding practices, and scalable architecture.</p>";
        break;
    case 4:
        $displayTitle = "Android App Development";
        $enhancedDescription = "<p>Our Android App Development services provide custom mobile applications designed to extend your reach and improve user engagement. We build native Android apps for various purposes, including student/parent portals, attendance tracking, communication platforms, and educational tools. Our apps are user-friendly, high-performing, and integrate seamlessly with your existing systems.</p>\n        <p>Features include intuitive interfaces, push notifications, offline capabilities, and secure data handling.</p>";
        break;
    case 5:
        $displayTitle = "Communication Services";
        $enhancedDescription = "<p>Effective communication is key to success. Our communication services provide integrated solutions for schools and businesses to connect with students, parents, and staff. This includes SMS alerts, email notifications, in-app messaging, and announcement boards. Ensure timely dissemination of important information, emergency alerts, and daily updates.</p>\n        <p>Key features include bulk messaging, scheduled communications, delivery reports, and customizable templates.</p>";
        break;
    case 6:
        $displayTitle = "Bus Tracking System";
        $enhancedDescription = "<p>Ensure the safety and punctuality of student transportation with our advanced Bus Tracking System. This module provides real-time GPS tracking of school buses, route optimization, and instant notifications for parents regarding bus location and estimated arrival times. It enhances security, improves operational efficiency, and offers peace of mind.</p>\n        <p>Features include live tracking on maps, route management, driver management, and historical data for analysis.</p>";
        break;
    case 7:
        $displayTitle = "Online Learning Solutions";
        $enhancedDescription = "<p>Empower your institution with modern online learning capabilities. Our solutions provide robust Learning Management Systems (LMS) for delivering courses, managing assignments, conducting online assessments, and facilitating virtual classrooms. Support blended learning models and ensure continuous education with interactive and engaging digital content.</p>\n        <p>Key features include course creation tools, student progress tracking, virtual collaboration, and secure content delivery.</p>";
        break;
    default:
        // Fallback to original description if ID is not 1-7
        $enhancedDescription = "<p>" . htmlspecialchars($module['description']) . "</p>";
        break;
}

// If module was not found in DB, use the displayTitle for the page title
if ($module['slug'] === 'unknown') {
    $pageTitle = $displayTitle;
} else {
    $pageTitle = htmlspecialchars($module['title']);
}

?>

<main>
    <section class="page-header">
        <div class="container text-center">
            <h1 class="text-white"><?php echo $displayTitle; ?></h1>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <h2 class="section-title text-center">Module Overview</h2>
                    <div class="lead mb-4">
                        <?php echo $enhancedDescription; // Already HTML formatted ?>
                    </div>
                    
                    <hr class="my-5">

                    <h3 class="text-center mb-4">Why Choose Our <?php echo $displayTitle; ?>?</h3>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="feature-box">
                                <i class="fas fa-cogs"></i>
                                <div>
                                    <h5>Customizable Workflows</h5>
                                    <p class="mb-0">Adapt the module to fit your unique institutional processes.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-box">
                                <i class="fas fa-chart-line"></i>
                                <div>
                                    <h5>Advanced Analytics</h5>
                                    <p class="mb-0">Gain insights with comprehensive reports and data visualization.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-box">
                                <i class="fas fa-shield-alt"></i>
                                <div>
                                    <h5>Robust Security</h5>
                                    <p class="mb-0">Protect sensitive data with multi-layered security protocols.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-box">
                                <i class="fas fa-headset"></i>
                                <div>
                                    <h5>Dedicated Support</h5>
                                    <p class="mb-0">Access expert assistance whenever you need it.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-5">
                        <a href="quote.php?module_id=<?php echo $module['id']; ?>" class="btn btn-primary btn-lg">Get a Quote for this Module</a>
                        <a href="contact.php" class="btn btn-secondary btn-lg ms-3">Ask a Question</a>
                    </div>

                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>