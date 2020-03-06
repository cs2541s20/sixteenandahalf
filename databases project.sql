CREATE TABLE `student` (
  `uid` int(8) PRIMARY KEY,
  `address1` varchar(80),
  `address2` varchar(80),
  `fname` varchar(40),
  `lname` varchar(40),
  `password` varchar(25),
  `email` varchar(40),
  `admission` varchar(4),
  `degree` varchar(20),
  `program` varchar(30)
);

CREATE TABLE `paststudent` (
  `uid` int(8) PRIMARY KEY,
  `address1` varchar(80),
  `address2` varchar(80),
  `fname` varchar(40),
  `lname` varchar(40),
  `program` varchar(30),
  `password` varchar(25),
  `email` varchar(40)
);

CREATE TABLE `instructor` (
  `uid` int(8) PRIMARY KEY,
  `address1` varchar(80),
  `address2` varchar(80),
  `password` varchar(25),
  `email` varchar(40)
);

CREATE TABLE `supervisors` (
  `uid` int(8) PRIMARY KEY,
  `address1` varchar(80),
  `address2` varchar(80),
  `password` varchar(25),
  `permission` varchar(20),
  `email` varchar(40)
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
  `day` varchar(5),
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

