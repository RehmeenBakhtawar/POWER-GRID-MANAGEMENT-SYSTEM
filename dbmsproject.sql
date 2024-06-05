DROP TABLE IF EXISTS `npcc_reporting`;
CREATE TABLE npcc_reporting (
    report_id INT PRIMARY KEY,
    power_policy VARCHAR(255),
    power_type VARCHAR(255),
    power_producer VARCHAR(255),
    portal_transaction_number INT,
    transfer_to_ap VARCHAR(255),
    ipp_number VARCHAR(255),
    dispute_letter VARCHAR(255),
    generation_period_from DATE,
    generation_period_to DATE,
    demand_number INT,
    due_date DATE
);
select * from npcc_reporting;
INSERT INTO npcc_reporting ( report_id, power_policy, power_type, power_producer, 
        portal_transaction_number, transfer_to_ap, ipp_number, 
        dispute_letter, generation_period_from, generation_period_to, 
        demand_number, due_date
    ) VALUES 
        (1, 'Energy 2015', 'Solar', 'Engro Solar Power (Pvt) Limited', 50280, 'AP1', 'ESPL/CPP/04', 'Letter1', '2024-04-01', '2024-04-30', 50900, '2024-05-30'),
        (2, 'Energy 2015', 'Wind', 'Lucky Wind Power (Pvt) Limited', 50281, 'AP2', 'EWPL/CPP/05', 'Letter2', '2024-05-01', '2024-05-31', 50901, '2024-06-30'),
        (3, 'Energy 2015', 'Hydro', 'Lucky Hydro Power (Pvt) Limited', 50282, 'AP3', 'EHPL/CPP/06', 'Letter3', '2024-06-01', '2024-06-30', 50902, '2024-07-30'),
        (4, 'Energy 2015', 'Coal', 'thar Coal Power (Pvt) Limited', 50283, 'AP4', 'ECPL/CPP/07', 'Letter4', '2024-07-01', '2024-07-31', 50903, '2024-08-30'),
        (5, 'Energy 2015', 'Nuclear', 'Port qasim Nuclear Power (Pvt) Limited', 50284, 'AP5', 'ENPL/CPP/08', 'Letter5', '2024-08-01', '2024-08-31', 50904, '2024-09-30'),
        (6, 'Energy 2015', 'Biomass', 'Port qasim Biomass Power (Pvt) Limited', 50285, 'AP6', 'EBPL/CPP/09', 'Letter6', '2024-09-01', '2024-09-30', 50905, '2024-10-30'),
        (7, 'Energy 2015', 'Geothermal', 'thar Coal Geothermal Power (Pvt) Limited', 50286, 'AP7', 'EGPL/CPP/10', 'Letter7', '2024-10-01', '2024-10-31', 50906, '2024-11-30'),
        (8, 'Energy 2015', 'Tidal', 'Engro Tidal Power (Pvt) Limited', 50287, 'AP8', 'ETPL/CPP/11', 'Letter8', '2024-11-01', '2024-11-30', 50907, '2024-12-30'),
        (9, 'Energy 2015', 'Gas', 'Lucky Gas Power (Pvt) Limited', 50288, 'AP9', 'EGPPL/CPP/12', 'Letter9', '2024-12-01', '2024-12-31', 50908, '2025-01-30'),
        (10, 'Energy 2015', 'Diesel', 'thar Coal Diesel Power (Pvt) Limited', 50289, 'AP10', 'EDPPL/CPP/01', 'Letter10', '2025-01-01', '2025-01-31', 50909, '2025-02-30');
        CREATE TABLE reports (
    report_id INT PRIMARY KEY,
    reviewed_by_id INT,
    review_date DATE,
    status VARCHAR(50),
    approval_date DATE,
    auditor_id INT,
    auditor_name VARCHAR(255),
    budgeted_cost DECIMAL(10, 2),
    total_cost DECIMAL(10, 2),
    variance DECIMAL(10, 2)
);
select * from reports;
CREATE TABLE technicalreport (
    report_id INT AUTO_INCREMENT PRIMARY KEY,
    source VARCHAR(255),
    reviewer_id INT,
    review_date DATE,
    priority VARCHAR(50),
    status VARCHAR(50),
    submission_date DATE,
    comments TEXT
);
select * from technicalreport;
TRUNCATE TABLE technicalreport;
CREATE TABLE `users` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
);
INSERT INTO `users` (`email`, `password`) VALUES ('Sara.Ahmed@techcppa.com', 'Welcome@123');
INSERT INTO `users` (`email`, `password`) VALUES ('Usman.Raza@techcppa.com', 'Tech@2024');
INSERT INTO `users` (`email`, `password`) VALUES ('Faisal.Malik@financecppa.com', 'Password#321');
INSERT INTO `users` (`email`, `password`) VALUES ('Ayesha.Shah@financecppa.com', 'Secure@456');
INSERT INTO `users` (`email`, `password`) VALUES ('Omar.Khan@techcppa.com', 'Start@789');
INSERT INTO `users` (`email`, `password`) VALUES ('Zainab.Qureshi@billingcppa.com', 'Login@ABC');
INSERT INTO `users` (`email`, `password`) VALUES ('Bilal.Hussain@billingcppa.com', 'Begin@XYZ');
INSERT INTO `users` (`email`, `password`) VALUES ('Rabia.Saeed@billingcppa.com', 'Entry@987');
INSERT INTO `users` (`email`, `password`) VALUES ('Asim.Bashir@billingcppa.com', 'Open@321');
select * from users;



CREATE TABLE invoices (
    invoice_id VARCHAR(255) PRIMARY KEY,
    disco_id VARCHAR(255),
    bill_issue_date DATE,
    due_date DATE,
    amount DECIMAL(10, 2),
    amount_paid DECIMAL(10, 2),
    payment_date DATE,
    charges DECIMAL(10, 2),
    status VARCHAR(255),
    last_updated DATE,
    revised_by VARCHAR(255),
    comments TEXT
);
select * from invoices;