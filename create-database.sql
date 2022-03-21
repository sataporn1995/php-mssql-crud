CREATE DATABASE company;
USE company;

CREATE TABLE employees
(
          id int IDENTITY(1,1) PRIMARY KEY,
          name nvarchar(50) null,
          date date null
)
