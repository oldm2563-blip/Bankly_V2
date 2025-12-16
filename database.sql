CREATE DATABASE bankly_v2;
USE bankly_v2;

CREATE TABLE `User` (
  `User_id` int AUTO_INCREMENT,
  `username` Varchar(255) UNIQUE,
  `role` enum,
  `password` varchar(255),
  PRIMARY KEY (`User_id`),
);

CREATE TABLE `Cusromers` (
  `customers_id` int AUTO_INCREMENT,
  `full_name` varchar(255),
  `Email` varchar(255) UNIQUE,
  `CIN` Varchar(7) UNIQUE,
  `Phone` Varchar(18),
  PRIMARY KEY (`customers_id`),
);

CREATE TABLE `Accounts` (
  `Account_id` int AUTO_INCREMENT,
  `Account_number` int UNIQUE,
  `account type` enum,
  `balance` float,
  `Customers_id` int,
  PRIMARY KEY (`Account_id`),
  FOREIGN KEY (`Customers_id`)
      REFERENCES `Cusromers`(`customers_id`),
);

CREATE TABLE `Transactions` (
  `Transaction_id` int,
  `amount` int,
  `Transction_type` enum,
  `account_id` int,
  `Transaction_date` datetime,
  PRIMARY KEY (`Transaction_id`),
  FOREIGN KEY (`Transaction_id`)
      REFERENCES `Accounts`(`Account_id`) ON DELETE CASCADE;
);



