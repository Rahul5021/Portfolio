# Portfolio Website

This repository contains the source code for a personal resume website built using PHP and Bootstrap. The website provides information about the user's profile, skills, education, certifications, projects, professional experiences, and contact details.

## Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Setup](#setup)
- [File Structure](#file-structure)
- [Contributing](#contributing)
- [License](#license)

## Features

- Display user profile information dynamically fetched from a MySQL database.
- Showcase skills, education, certifications, projects, and professional experiences.
- Allow visitors to download the user's resume.
- Provide a contact form for visitors to send messages directly to the user.
- Display social media links for further interaction.

## Requirements

- PHP (Tested with PHP 7.x)
- MySQL Database
- Web Server (Apache, Nginx, etc.)
- Bootstrap 5.3.2
- jQuery (Included with Bootstrap)
- Any text editor or IDE (e.g., Visual Studio Code, Sublime Text)

## Setup

1. Clone or download the repository to your local machine.
    ```bash
   git clone https://github.com/Rahul5021/Portfolio

2. Import the database schema and sample data into your MySQL database using the provided SQL files (schema.sql, data.sql).
3. Update the database configuration in the include/config.php file with your MySQL credentials.
    ```php
    $servername = "localhost"; // Your MySQL server address
    $username = "root"; // Your MySQL username
    $password = ""; // Your MySQL password
    $database = "db_name"; // Your MySQL database name
4. Place the project files in your web server's document root directory.
5. Access the website through your web browser.

## File Structure

- `index.php`: Main entry point of the website.
- `include/config.php`: Configuration file containing database credentials.
- `assets/`: Directory containing CSS, JavaScript, images, and vendor libraries.
- `schema.sql`: SQL file containing the database schema.
- `data.sql`: SQL file containing sample data for the database.
- `README.md`: This README file.

## Contributing
Contributions are welcome! If you find any issues or have suggestions for improvements, feel free to open an issue or create a pull request.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

