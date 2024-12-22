#!/bin/bash

# Prompt for database name
read -p "Enter the name of the database to create: " DB_NAME

# Prompt for MySQL username
read -p "Enter the MySQL username to create: " DB_USER

# Prompt for MySQL password
read -sp "Enter the password for the new MySQL user: " DB_PASS
echo

# Confirm MySQL root credentials
read -sp "Enter the MySQL root password: " ROOT_PASS
echo

# Create SQL commands in a temporary file
SQL_FILE=$(mktemp)
cat <<EOF >"$SQL_FILE"
CREATE DATABASE $DB_NAME;
CREATE USER '$DB_USER'@'localhost' IDENTIFIED BY '$DB_PASS';
GRANT ALL PRIVILEGES ON $DB_NAME.* TO '$DB_USER'@'localhost';
FLUSH PRIVILEGES;
EOF

# Execute the SQL commands using the secure method
mysql -u root -p"$ROOT_PASS" <"$SQL_FILE"

# Cleanup
rm "$SQL_FILE"

# Output success message
if [ $? -eq 0 ]; then
    echo "Database and user created successfully!"
    echo "Database: $DB_NAME"
    echo "Username: $DB_USER"
else
    echo "An error occurred. Please check your inputs and try again."
fi
