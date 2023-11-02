#!/bin/bash

# Prompt the user for input
read -p "Enter name: " name
read -s -p "Enter password: " password
echo # Add a new line after the password input

# Email validation function
validate_email() {
    local email="$1"
    if [[ "$email" =~ ^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$ ]]; then
        return 0
    else
        return 1
    fi
}

# Prompt for email until a valid one is entered
while true; do
    read -p "Enter email: " email
    if validate_email "$email"; then
        break
    else
        echo "Invalid email address. Please enter a valid email."
    fi
done

# Load Laravel .env variables
if [ -f .env ]; then
    while IFS= read -r line; do
        if [[ "$line" =~ ^DB_USERNAME=|^DB_PASSWORD= ]]; then
            export "$line"
        fi
    done <.env
else
    echo "The .env file does not exist. Make sure it's in the same directory as this script."
    exit 1
fi

# Use PHP Artisan to run Laravel commands
php artisan tinker <<PHP
use App\Models\User;

User::create([
'name' => '$name',
'email' => '$email',
'password' => bcrypt('$password'),
'role' => 'admin'
]);
PHP

echo "User created!"

# if [ $? -eq 0 ]; then
#     echo "User created successfully."
# else
#     echo "Error creating the user."
# fi
