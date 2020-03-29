DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS student CASCADE;
DROP TABLE IF EXISTS enrollment CASCADE;
DROP TABLE IF EXISTS course CASCADE;
DROP TABLE IF EXISTS coursedata CASCADE;
DROP TABLE IF EXISTS room CASCADE;
DROP TABLE IF EXISTS prereqs CASCADE;
DROP TABLE IF EXISTS coreqs CASCADE;
DROP TABLE IF EXISTS lab CASCADE;

CREATE TABLE `users` (
  `uid` int(8) PRIMARY KEY,
  `address` varchar(255),
  `fname` varchar(40),
  `lname` varchar(40),
  `password` varchar(25),
  `email` varchar(40),
  `permission` varchar(20)
);

CREATE TABLE `student` (
  `uid` int(8) PRIMARY KEY,
  `admission` varchar(4),
  `degree` varchar(20),
  `program` varchar(30)
);

CREATE TABLE `enrollment` (
  `uid` int(8),
  `crn` int,
  `semester` varchar(8),
  `year` varchar(9),
  `grade` varchar(12),
  `gradeModified` boolean,
  PRIMARY KEY (`uid`, `crn`)
); 

CREATE TABLE `course` (
  `crn` int AUTO_INCREMENT,
  `day` varchar(10),
  `starttime` int(4),
  `endtime` int(4),
  `location` varchar(25),
  `section` int,
  PRIMARY KEY (`crn`, `section`)
);

CREATE TABLE `coursedata` (
  `crn` int,
  `cid` int,
  `dept` varchar(40),
  `name` varchar(40),
  `credits` int(2),
  `semester` varchar(8),
  `instructorid` int(8),
  PRIMARY KEY (`crn`, `dept`)
);

CREATE TABLE `room` (
  `location` varchar(40) PRIMARY KEY,
  `capacity` int(4)
);

CREATE TABLE `prereqs` (
  `crn` int,
  `prereq` int,
  PRIMARY KEY (`crn`, `prereq`)
);

CREATE TABLE `coreqs` (
  `crn` int,
  `coreq` int,
  PRIMARY KEY (`crn`, `coreq`)
);

CREATE TABLE `lab` (
  `crn` int,
  `lab` int,
  PRIMARY KEY (`crn`, `lab`)
);


INSERT INTO users VALUES (12121212,  '2121 h st', 'John', 'Doe', 'password', 'john@gwu.edu', 'student');
INSERT INTO users VALUES (23232323, '1467 f st', 'James', 'Taylor', 'password', 'jt@gwu.edu', 'admin');
INSERT INTO users VALUES (32323232, '5433 i st', 'Frank', 'Bolton', 'password', 'pfrank@gwu.edu', 'admin');
INSERT INTO users VALUES (44442222, '1212 g st', 'Teacher', 'Man', 'password', 'tman@gwu.edu', 'faculty');
INSERT INTO users VALUES (55555555, '2121 h st', 'Cell', 'Freeza', 'password', 'fcell@gwu.edu', 'student');
INSERT INTO users VALUES (66666666, '4231 j st', 'Brad', 'Mecretary', 'password', 'bmecr@gwu.edu', 'gradsec');
INSERT INTO users VALUES (77777777, '2121 h st', 'Rad', 'Hecretary', 'password', 'rhecr@gwu.edu', 'gradsec'); 
INSERT INTO users VALUES (88888888, '211 meg rd', 'Billie', 'Holiday', 'password', 'bholiday@gwu.edu', 'student'); 
INSERT INTO users VALUES (99999999, '211 meg rd', 'Diana', 'Krall', 'password', 'dkrall@gwu.edu', 'student');
INSERT INTO users VALUES (10101010, '1212 g st', 'Bhagi', 'Narahari', 'password', 'narahari@gwu.edu', 'faculty');
INSERT INTO users VALUES (20202020, '2222 g st', 'Choi', 'Buckets', 'password', 'cbuckets@gwu.edu', 'gradsec');



INSERT INTO student VALUES (12121212, 'yes', 'Physics', 'Undergraduate');
INSERT INTO student VALUES (55555555, 'yes', 'Psychology', 'Undergraduate');
INSERT INTO student VALUES (88888888, 'yes', 'CSCI', 'Graduate');
INSERT INTO student VALUES (99999999, 'yes', 'Undecided', 'Graduate');


INSERT INTO enrollment VALUES (12121212, 1222, 'Fall', 'Junior', 'A', false);
INSERT INTO enrollment VALUES (12121212, 5555, 'Fall', 'Junior', 'B', false);
INSERT INTO enrollment VALUES (55555555, 1222, 'Fall', 'Freshman', 'C', false);
INSERT INTO enrollment VALUES (55555555, 4444, 'Fall', 'Freshman', 'B', false);
INSERT INTO enrollment VALUES (88888888, 6461, 'Fall', 'Graduate', 'B', false);
INSERT INTO enrollment VALUES (88888888, 6212, 'Fall', 'Graduate', 'B', false);


INSERT INTO course VALUES (1222, 'Monday', 1030, 1145,'Philips 201', 30);
INSERT INTO course VALUES (5555, 'Thursday', 1030, 1145, 'Rome 401', 10);
INSERT INTO course VALUES (4444, 'Monday', 1130,1245, 'Tompkins 201', 30);
INSERT INTO course VALUES (6221, 'Monday', 1500, 1730, 'Philips 201', 10);
INSERT INTO course VALUES (6461,  'Tuesday', 1500, 1730, 'Rome 401', 30);
INSERT INTO course VALUES (6212, 'Wednesday', 1500, 1730, 'Tompkins 201', 30);
INSERT INTO course VALUES (6232, 'Monday', 1800, 2030, 'Philips 201', 10);
INSERT INTO course VALUES (6233, 'Tuesday', 1800, 2030, 'Rome 201', 10);
INSERT INTO course VALUES (6241, 'Wednesday', 1800, 2030, 'Tompkins 201', 10);
INSERT INTO course VALUES (6242, 'Friday', 1800, 2030, 'Rome 401', 30);
INSERT INTO course VALUES (6246, 'Tuesday', 1500, 1730, 'Rome 401', 10);
INSERT INTO course VALUES (6251, 'Monday', 1800, 2030, 'Tompkins 201', 30);
INSERT INTO course VALUES (6254, 'Monday', 1530, 1800, 'Philips 201', 30);
INSERT INTO course VALUES (6260, 'Friday', 1800, 2030, 'Rome 401', 10);
INSERT INTO course VALUES (6262, 'Wednesday', 1800, 2030, 'Tompkins 201', 30);
INSERT INTO course VALUES (6283, 'Tuesday', 1800, 2030, 'Philips 201', 30);
INSERT INTO course VALUES (6284, 'Monday', 1800, 2030, 'Tompkins 201', 30);
INSERT INTO course VALUES (6286, 'Wednesday', 1800, 2030, 'Rome 401', 10);
INSERT INTO course VALUES (6384, 'Wednesday', 1500, 1730, 'Philips 201', 30);
INSERT INTO course VALUES (6210, 'Wednesday', 1800, 2030, 'Philips 201', 30);
INSERT INTO course VALUES (6339, 'Friday', 1600, 1830, 'Tompkins 201', 30);





INSERT INTO coursedata VALUES (1222, 21, 'Humanities', 'Philosophy', 3, 'Fall', 44444444);
INSERT INTO coursedata VALUES (5555, 22, 'Physics', 'Physics 101', 4, 'Fall', 44444444);
INSERT INTO coursedata VALUES (4444, 23, 'Psychology', 'Mind 101', 3, 'Fall', 44444444);
INSERT INTO coursedata VALUES (6221, 1, 'CSCI', 'SW Paradigms', 3, 'Fall', 10101010);
INSERT INTO coursedata VALUES (6461, 2, 'CSCI', 'Computer Architecture', 3, 'Fall', 10101010);
INSERT INTO coursedata VALUES (6212, 3, 'CSCI', 'Algorithms', 3, 'Fall', 20202020);
INSERT INTO coursedata VALUES (6232, 4, 'CSCI', 'Networks 1', 3, 'Fall', 32323232);
INSERT INTO coursedata VALUES (6233, 5, 'CSCI', 'Networks 2', 3, 'Fall', 32323232);
INSERT INTO coursedata VALUES (6241, 6, 'CSCI', 'Database 1', 3, 'Fall', 10101010);
INSERT INTO coursedata VALUES (6242, 7, 'CSCI', 'Database 2', 3, 'Fall', 10101010);
INSERT INTO coursedata VALUES (6246, 8, 'CSCI', 'Compilers', 3, 'Fall', 44442222);
INSERT INTO coursedata VALUES (6251, 9, 'CSCI', 'Cloud Computing', 3, 'Fall', 20202020);
INSERT INTO coursedata VALUES (6254, 10, 'CSCI', 'SW Engineering', 3, 'Fall', 23232323);
INSERT INTO coursedata VALUES (6260, 11, 'CSCI', 'Multimedi', 3, 'Fall', 44442222);
INSERT INTO coursedata VALUES (6262, 12, 'CSCI', 'Graphics 1', 3, 'Fall', 44442222);
INSERT INTO coursedata VALUES (6283, 13, 'CSCI', 'Security 1', 3, 'Fall', 32323232);
INSERT INTO coursedata VALUES (6284, 14, 'CSCI', 'Cryptography', 3, 'Fall', 32323232);
INSERT INTO coursedata VALUES (6286, 15, 'CSCI', 'Network Security', 3, 'Fall', 10101010);
INSERT INTO coursedata VALUES (6384, 16, 'CSCI', 'Cryptography 2', 3, 'Fall', 32323232);
INSERT INTO coursedata VALUES (6241, 17, 'ECE', 'Communication Theory', 3, 'Fall', 44444444);
INSERT INTO coursedata VALUES (6242, 18, 'ECE', 'Information Theory', 3, 'Fall', 44442222);
INSERT INTO coursedata VALUES (6210, 19, 'MATH', 'Logic', 2, 'Fall', 20202020);
INSERT INTO coursedata VALUES (6339, 20, 'CSCI', 'Embedded Systems', 3, 'Fall', 23232323);



INSERT INTO room VALUES ('Philips 201', 45);
INSERT INTO room VALUES ('Rome 401', 50);
INSERT INTO room VALUES ('Tompkins 201', 25);


INSERT INTO prereqs VALUES (5555, 1222);
INSERT INTO prereqs VALUES (4444, 1222);
INSERT INTO prereqs VALUES (6233, 6232);
INSERT INTO prereqs VALUES (6242, 6241);
INSERT INTO prereqs VALUES (6246, 6461);
INSERT INTO prereqs VALUES (6246, 6212);
INSERT INTO prereqs VALUES (6251, 6461);
INSERT INTO prereqs VALUES (6254, 6221);
INSERT INTO prereqs VALUES (6283, 6212);
INSERT INTO prereqs VALUES (6284, 6212);
INSERT INTO prereqs VALUES (6286, 6283);
INSERT INTO prereqs VALUES (6286, 6232);
INSERT INTO prereqs VALUES (6325, 6212);
INSERT INTO prereqs VALUES (6339, 6461);
INSERT INTO prereqs VALUES (6339, 6212);
INSERT INTO prereqs VALUES (6384, 6284);



INSERT INTO coreqs VALUES (5555, 1222);
INSERT INTO coreqs VALUES (4444, 1222);


INSERT INTO lab VALUES (5555, 1333);
INSERT INTO lab VALUES (4444, 1332);
INSERT INTO lab VALUES (1222, 1331);