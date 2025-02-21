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

INSERT INTO courses_asignments (instructor_id, course_id, semester, year) VALUES
(1, 1, 'Fall', 2021),
(2, 2, 'Fall', 2021),
(3, 3, 'Fall', 2021),
(4, 4, 'Fall', 2021),
(5, 5, 'Fall', 2021);



INSERT INTO enrollments (student_id, course_id, grade) VALUES
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
//List all students along with their details
SELECT * FROM students;
//Find the total number of courses offered by the university.
SELECT COUNT(*) AS total_courses FROM courses ;
//Show the names of all students enrolled in a specific course.
SELECT students.first_name , student.last_name
FROM students 
JOIN enrollments ON students.student_id = enrollment.students_id
WHERE enrollments.course_id =1 ;
//Retrieve the email addresses of all instructors in a department.

SELECT email 
FROM instructors
WHERE department = 'computer siience ';


// List all courses along with the number of students enrolled.
SELECT course.course_name , COUNT(enrollments.students_id) AS student_count
FROM Courses
LEFT JOIN enrollments ON courses.course_id = enrollments.course_id
GROUP BY courses.course_id, courses.course_name;
 
//Find the students who were enrolled in a course with a grade of 'A'.
SELECT students.first_name, students.last_name, courses.course_name
FROM Students
JOIN enrollments ON students.student_id = enrollments.student_id
JOIN courses ON enrollments.course_id = courses.course_id
WHERE enrollments.grade = 'A';
//Retrieve the courses and the instructors assigned for a specific semester.

SELECT courses.course_name, instructors.first_name, instructors.last_name, courseAssignments.semester, CourseAssignments.year
FROM courses
JOIN course_assignments ON courses.course_id = course_assignments.course_id
JOIN instructors ON Course_assignments.instructor_id = Instructors.instructor_id
WHERE course_assignments.semester = 'Fall' AND Course_assignments.year = 2021;
//Find the average grade for a particular course.
SELECT course_name, AVG(CASE 
                        WHEN grade = 'A' THEN 4.0
                        WHEN grade = 'B' THEN 3.0
                        WHEN grade = 'C' THEN 2.0
                        WHEN grade = 'D' THEN 1.0
                        WHEN grade = 'F' THEN 0.0
                        ELSE NULL
                    END) AS average_grade
FROM courses
JOIN enrollments ON courses.course_id = enrollments.course_id
WHERE courses.course_id = 1;
//List students taking more than 3 courses in the current semester.
SELECT students.first_name, students.last_name, COUNT(enrollments.course_id) AS course_count
FROM students
JOIN enrollments ON students.student_id = enrollments.student_id
JOIN course_assignments ON enrollments.course_id = course_assignments.course_id
WHERE course_assignments.semester = 'Fall' AND course_assignments.year = 2021 
GROUP BY students.student_id, students.first_name, students.last_name
HAVING COUNT(enrollments.course_id) > 3;
//Generate a report of students with incomplete grades.
SELECT students.first_name, students.last_name, courses.course_name, enrollments.grade
FROM students
JOIN enrollments ON students.student_id = enrollments.student_id
JOIN courses ON enrollments.course_id = courses.course_id
WHERE enrollments.grade IS NULL OR enrollments.grade = '';
//Show the student with the highest average grade across courses.

SELECT students.first_name, students.last_name, AVG(CASE 
                        WHEN grade = 'A' THEN 4.0
                        WHEN grade = 'B' THEN 3.0
                        WHEN grade = 'C' THEN 2.0
                        WHEN grade = 'D' THEN 1.0
                        WHEN grade = 'F' THEN 0.0
                        ELSE NULL
                    END) AS average_grade
FROM students
JOIN enrollments ON students.student_id = enrollments.student_id
GROUP BY students.student_id
ORDER BY average_grade DESC
LIMIT 1;
//Find the department with the most courses taught this year.

SELECT courses.department, COUNT(*) AS course_count
FROM courses
JOIN courseAssignments ON courses.course_id = course_assignments.course_id
WHERE course_assignments.year = 2025 -- Replace 2025 with the current year
GROUP BY courses.department
ORDER BY course_count DESC
LIMIT 1;


//List courses with no student enrollments.
SELECT courses.course_name
FROM courses
LEFT JOIN enrollments ON courses.course_id = enrollments.course_id
WHERE enrollments.course_id IS NULL;


//Create a function to calculate a student's age based on date_of_birth.
DELIMITER //

CREATE FUNCTION CalculateAge(date_of_birth DATE) RETURNS INT
BEGIN
    DECLARE age INT;
    SET age = TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE());
    RETURN age;
END //

DELIMITER ;
SELECT CalculateAge('2000-01-15') AS age;

SELECT first_name, last_name, CalculateAge(date_of_birth) AS age
FROM Students;

//Create a stored procedure to enroll a student in a course.

DELIMITER //

CREATE PROCEDURE EnrollStudent(
    IN p_student_id INT,
    IN p_course_id INT,
    IN p_grade VARCHAR(2)
)
BEGIN
    DECLARE studentExists INT;
    DECLARE courseExists INT;

    -- Check if the student exists
    SELECT COUNT(*) INTO studentExists
    FROM Students
    WHERE student_id = p_student_id;

    -- Check if the course exists
    SELECT COUNT(*) INTO courseExists
    FROM Courses
    WHERE course_id = p_course_id;

    -- If both the student and course exist, enroll the student
    IF studentExists > 0 AND courseExists > 0 THEN
        INSERT INTO Enrollments (student_id, course_id, grade)
        VALUES (p_student_id, p_course_id, p_grade);
    ELSE
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Student or Course not found.';
    END IF;
END //

DELIMITER ;


?>
