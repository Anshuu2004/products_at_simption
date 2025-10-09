-- schema.sql (Step 1)
CREATE DATABASE IF NOT EXISTS products_at_simption CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE products_at_simption;

-- users table
CREATE TABLE IF NOT EXISTS users (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(150) NOT NULL,
email VARCHAR(255) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL,
is_verified TINYINT(1) DEFAULT 0,
is_admin TINYINT(1) DEFAULT 0,
verify_code VARCHAR(128),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- clients table
CREATE TABLE IF NOT EXISTS clients (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(200) NOT NULL,
city VARCHAR(100),
logo VARCHAR(255),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- products table (for idcards, lanyards, bedge)
CREATE TABLE IF NOT EXISTS products (
id INT AUTO_INCREMENT PRIMARY KEY,
category VARCHAR(100) NOT NULL, -- e.g. "idcard", "lanyard", "bedge"
title VARCHAR(200) NOT NULL,
description TEXT,
price DECIMAL(10,2) DEFAULT 0.00,
image VARCHAR(255),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- attendance types table
CREATE TABLE IF NOT EXISTS attendance_types (
id INT AUTO_INCREMENT PRIMARY KEY,
slug VARCHAR(100) NOT NULL UNIQUE,
title VARCHAR(200) NOT NULL,
short_desc VARCHAR(512),
content LONGTEXT,
image VARCHAR(255),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- contact messages
CREATE TABLE IF NOT EXISTS contact_messages (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(150),
email VARCHAR(255),
subject VARCHAR(255),
message TEXT,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- erp modules list
CREATE TABLE IF NOT EXISTS erp_modules (
id INT AUTO_INCREMENT PRIMARY KEY,
slug VARCHAR(100) UNIQUE,
title VARCHAR(200),
description TEXT
) ENGINE=InnoDB;

-- seed: sample clients
INSERT INTO clients (name, city, logo) VALUES
('Greenfield School','Delhi','client_greenfield.png'),
('Rising College','Mumbai','client_rising.png'),
('Alpha Institute','Bangalore','client_alpha.png');

-- seed: sample products (idcard, lanyard, bedge)
INSERT INTO products (category, title, description, price, image) VALUES
('idcard','RFID PVC Card - Standard','RFID compatible PVC ID card, printable both sides.',120.00,'id_rfid_pvc.png'),
('idcard','UV Printed PVC Card','Premium UV printing for high durability.',180.00,'id_uv_pvc.png'),
('lanyard','Polyester Lanyard - 20mm','Soft polyester with metal swivel hook.',40.00,'lanyard_poly.png'),
('lanyard','Printed Lanyard (Custom)','Custom branded printed lanyard.',85.00,'lanyard_print.png'),
('bedge','Plastic Badge - 75x50mm','Durable plastic badge with pin.',35.00,'badge_plastic.png'),
('bedge','Metal Badge - Premium','Premium metal finish badge with enamel.',150.00,'badge_metal.png');

-- seed: sample attendance types
INSERT INTO attendance_types (slug, title, short_desc, content, image) VALUES
('rfid','RFID Attendance','Contactless RFID-based attendance systems for fast scanning.','<p>RFID attendance systems use tags/cards and readers to record presence. Ideal for large institutions and factories. Features include bulk reads, logging, and export.</p>','att_rfid.png'),
('face','Face Recognition Attendance','Biometric face recognition for secure attendance.','<p>Face recognition systems use camera + ML models to identify users with high accuracy. Option for temperature check and mask detection.</p>','att_face.png'),
('fingerprint','Fingerprint Attendance','Classic biometric fingerprint-based attendance units.','<p>Fingerprint readers are compact and reliable. Good for small-to-medium offices. Provide template storage and tamper-proof logs.</p>','att_fingerprint.png'),
('qr','qr code attendance','QR code based self-attendance using mobile phones.','<p>Generate QR codes per session or user; scan via mobile or scanner. Works well for remote or soft-attendance use-cases.</p>','att_qr.png'),
('barcode','Barcode Attendance','Barcode scanning attendance for printed cards.','<p>Barcode readers integrate easily with legacy systems. Low cost and simple to deploy.</p>','att_barcode.png'),
('geo','Geo-fencing Self Attendance','Location based self-attendance using geofencing.','<p>Geo-fencing requires mobile GPS. Ensures attendance only within predefined geolocation boundaries.</p>','att_geo.png'),
('manual','Manual From Software','Manual entry and admin-corrected attendance.','<p>Admin portal for manual corrections, leave entries, and approvals. Useful for exceptions and one-off edits.</p>','att_manual.png');

-- seed: erp modules
INSERT INTO erp_modules (slug, title, description) VALUES
('school','School Management System','Complete school ERP with admissions, exams, fees, and HR.'),
('attendance','Attendance Management System','Module to centralize and analyze attendance across devices.'),
('college','College Management System','Higher-education ERP for departments, courses, and grading.'),
('payroll','Payroll Management System','Payroll, payslips, and statutory reports.');

-- done
COMMIT;
-- End of schema.sql