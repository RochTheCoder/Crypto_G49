-- Create a login
CREATE LOGIN user1 WITH PASSWORD = 'pass1';

-- Use the specific database
USE crypto_dbs1;

-- Create a user in the database and map it to the login
CREATE USER user1 FOR LOGIN user1;

-- Grant necessary privileges to the user
ALTER ROLE [db_datareader] ADD MEMBER user1; -- Example privilege, adjust as needed
ALTER ROLE [db_datawriter] ADD MEMBER user1; -- Example privilege, adjust as needed



