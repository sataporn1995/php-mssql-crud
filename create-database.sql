CREATE DATABASE tutorials;
USE tutorials;

CREATE TABLE users
(
          id int IDENTITY(1,1) PRIMARY KEY,
          name nvarchar(50) null,
          date date null
)
