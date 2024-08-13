CREATE TABLE Users (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(255) NOT NULL,
  last_name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  username VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE Jobs (
    job_id INT AUTO_INCREMENT PRIMARY KEY,
    posted_by INT,
	contractor_id INT
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    budget DECIMAL(10, 2),
    status ENUM('open', 'in-progress', 'complete') NOT NULL,
    job_type ENUM('fixed', 'hourly') NOT NULL,
    hourly_rate DECIMAL(10, 2),
    estimated_hours_per_week DECIMAL(5, 2),
    estimated_completion_date DATE,
    FOREIGN KEY (posted_by) REFERENCES Users(user_id)
	FOREIGN KEY (contractor_id) REFERENCES Users(user_id)
);


CREATE TABLE Requests (
    request_id INT AUTO_INCREMENT PRIMARY KEY,
    job_id INT,
    requested_by INT,
    status ENUM('pending', 'accepted', 'rejected') NOT NULL,
    FOREIGN KEY (job_id) REFERENCES Jobs(job_id),
    FOREIGN KEY (requested_by) REFERENCES Users(user_id)
);


CREATE TABLE Reviews (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    reviewer_id INT,
    contractor_id INT,
    job_id INT,
    communication TINYINT CHECK (communication BETWEEN 1 AND 5),
    time_management TINYINT CHECK (time_management BETWEEN 1 AND 5),
    quality TINYINT CHECK (quality BETWEEN 1 AND 5),
    professionalism TINYINT CHECK (professionalism BETWEEN 1 AND 5),
    comments VARCHAR(255),
    FOREIGN KEY (reviewer_id) REFERENCES Users(user_id),
    FOREIGN KEY (contractor_id) REFERENCES Users(user_id),
    FOREIGN KEY (job_id) REFERENCES Jobs(job_id)
);


CREATE TABLE Skills (
    skill_id INT AUTO_INCREMENT PRIMARY KEY,
    skill_name VARCHAR(255) NOT NULL,
    skill_category VARCHAR(255)
);


CREATE TABLE UserSkills (
    user_id INT,
    skill_id INT,
    PRIMARY KEY (user_id, skill_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (skill_id) REFERENCES Skills(skill_id)
);