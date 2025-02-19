<?php
// Create Students table
CREATE TABLE students (
    student_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    date_of_birth DATE,
    gender ENUM('Male', 'Female', 'Other'),
    major VARCHAR(50),
    enrollment_year YEAR
);

// Create Courses table
CREATE TABLE courses (
    course_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(50) NOT NULL,
    course_code VARCHAR(10) NOT NULL,
    credits INT(2) NOT NULL,
    department VARCHAR(50)
);

// Create Instructors table
CREATE TABLE instructors (
    instructor_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    hire_date DATE,
    department VARCHAR(50)
);

//Create Enrollments table
CREATE TABLE enrollments (
    enrollment_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    student_id INT(6) UNSIGNED,
    course_id INT(6) UNSIGNED,
    grade VARCHAR(2),
    FOREIGN KEY (student_id) REFERENCES Students(student_id),
    FOREIGN KEY (course_id) REFERENCES Courses(course_id)
);

// Create Course Assignments table
CREATE TABLE course_assignments (
    assignment_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    instructor_id INT(6) UNSIGNED,
    course_id INT(6) UNSIGNED,
    semester VARCHAR(10),
    year YEAR,
    FOREIGN KEY (instructor_id) REFERENCES Instructors(instructor_id),
    FOREIGN KEY (course_id) REFERENCES Courses(course_id)
);
//insert data 
INSERT INTO students (student_id,first_name ,last_name ,email ,date_of_birth DATE,gender ,major ,enrollment_year YEAR) VALUES
('John', 'Doe', 'john.doe@example.com', '2000-01-15', 'Male', 'Computer Science', 2018),
('Jane', 'Smith', 'jane.smith@example.com', '1999-05-24', 'Female', 'Mathematics', 2017),
('Alice', 'Brown', 'alice.brown@example.com', '2001-07-30', 'Female', 'Biology', 2019),
('Bob', 'Johnson', 'bob.johnson@example.com', '2000-09-10', 'Male', 'Physics', 2018),
('Carol', 'Davis', 'carol.davis@example.com', '1998-11-05', 'Female', 'Chemistry', 2016),
('David', 'Wilson', 'david.wilson@example.com', '2001-03-21', 'Male', 'Economics', 2019),
('Eve', 'Taylor', 'eve.taylor@example.com', '1999-12-12', 'Female', 'History', 2017),
('Frank', 'White', 'frank.white@example.com', '1998-06-18', 'Male', 'Philosophy', 2016),
('Grace', 'Martin', 'grace.martin@example.com', '2000-08-23', 'Female', 'Literature', 2018),
('Hank', 'Moore', 'hank.moore@example.com', '2001-02-14', 'Male', 'Engineering', 2019),

INSERT INTO instructors ( instructor_id, first_name, last_name, email, hire_date, department) VALUES
('Emily', 'Clark', 'emily.clark@example.com', '2010-09-01', 'Computer Science'),
('Andrew', 'Lewis', 'andrew.lewis@example.com', '2012-08-15', 'Mathematics'),
('Sarah', 'Walker', 'sarah.walker@example.com', '2014-05-20', 'Biology'),
('Michael', 'Hall', 'michael.hall@example.com', '2015-04-10', 'Physics'),
('Laura', 'Young', 'laura.young@example.com', '2013-03-05', 'Chemistry'),



INSERT INTO courses (course_id, course_name, course_code, credits, department) VALUES
('Introduction to Programming', 'CS101', 3, 'Computer Science'),
('Calculus I', 'MATH101', 4, 'Mathematics'),
('General Biology', 'BIO101', 4, 'Biology'),
('Physics I', 'PHY101', 4, 'Physics'),
('Organic Chemistry', 'CHEM101', 3, 'Chemistry'),

INSERT INTO Enrollments(enrollment_id, student_id, course_id, grade) VALUES
(1, 1, 'Fall', 2021),
(2, 2, 'Fall', 2021),
(3, 3, 'Fall', 2021),
(4, 4, 'Fall', 2021),
(5, 5, 'Fall', 2021),
INSERT INTO Enrollments (student_id, course_id, grade) VALUES
(1, 1, 'A'), (1, 2, 'B'),
(2, 1, 'B'), (2, 3, 'A'),
(3, 2, 'A'), (3, 4, 'B'),
(4, 3, 'C'), (4, 5, 'B'),
(5, 4, 'A'), (5, 1, 'C'),
(6, 5, 'B'), (6, 2, 'A'),
(7, 1, 'A'), (7, 5, 'B'),
(8, 2, 'B'), (8, 3, 'A'),
(9, 3, 'C'), (9, 4, 'B'),
(10, 4, 'A'), (10, 5, 'C');


