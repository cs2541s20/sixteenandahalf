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
  `year` varchar(4),
  `grade` varchar(12),
  `gradeModified` boolean,
  PRIMARY KEY (`uid`, `crn`)
); 

CREATE TABLE `course` (
  `crn` int PRIMARY KEY AUTO_INCREMENT,
  `day` varchar(10),
  `time` varchar(10),
  `location` varchar(25),
  `section` int
);

CREATE TABLE `coursedata` (
  `crn` int PRIMARY KEY,
  `cid` int,
  `dept` varchar(40),
  `name` varchar(40),
  `credits` int(2),
  `semester` varchar(8),
  `instructorid` int(8)
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


INSERT INTO users VALUES (11111111,  '2121 h st', 'John', 'Doe', 'password', 'john@gwu.edu', 'student');
INSERT INTO users VALUES (22222222, '1467 f st', 'James', 'Taylor', 'password', 'jt@gwu.edu', 'admin');
INSERT INTO users VALUES (33333333, '5433 i st', 'Frank', 'Bolton', 'password', 'pfrank@gwu.edu', 'admin');
INSERT INTO users VALUES (44444444, '1212 g st', 'Teacher', 'Man', 'password', 'tman@gwu.edu', 'faculty');
INSERT INTO users VALUES (55555555, '2121 h st', 'Cell', 'Freeza', 'password', 'fcell@gwu.edu', 'student');
INSERT INTO users VALUES (66666666, '4231 j st', 'Brad', 'Mecretary', 'password', 'bmecr@gwu.edu', 'gradsec');
INSERT INTO users VALUES (77777777, '2121 h st', 'Rad', 'Hecretary', 'password', 'rhecr@gwu.edu', 'gradsec');



INSERT INTO student VALUES (11111111, 'yes', 'Physics', 'Undergraduate');
INSERT INTO student VALUES (55555555, 'yes', 'Psychology', 'Undergraduate');


INSERT INTO enrollment VALUES (11111111, 1222, 'Fall', 'A', 'Junior', false);
INSERT INTO enrollment VALUES (11111111, 5555, 'Fall', 'B', 'Junior', false);
INSERT INTO enrollment VALUES (55555555, 1222, 'Fall', 'C', 'Freshman', false);
INSERT INTO enrollment VALUES (55555555, 4444, 'Fall', 'B', 'Freshman', false);


INSERT INTO course VALUES (1222, 'Monday', '10:30', 'Philips 201', 30);
INSERT INTO course VALUES (5555, 'Thursday', '10:30', 'Rome 401', 10);
INSERT INTO course VALUES (4444, 'Monday', '11:30', 'Thompkins 201', 30);


INSERT INTO coursedata VALUES (1222, 1, 'Humanities', 'Philosophy', 3, 'Fall', 44444444);
INSERT INTO coursedata VALUES (5555, 2, 'Physics', 'Physics 101', 4, 'Fall', 44444444);
INSERT INTO coursedata VALUES (4444, 2, 'Psychology', 'Mind 101', 3, 'Fall', 44444444);


INSERT INTO room VALUES ('Philips 201', 45);
INSERT INTO room VALUES ('Rome 401', 50);
INSERT INTO room VALUES ('Thompkins 201', 25);


INSERT INTO prereqs VALUES (5555, 1222);
INSERT INTO prereqs VALUES (4444, 1222);


INSERT INTO coreqs VALUES (5555, 1222);
INSERT INTO coreqs VALUES (4444, 1222);


INSERT INTO lab VALUES (5555, 1333);
INSERT INTO lab VALUES (4444, 1332);
INSERT INTO lab VALUES (1222, 1331);

