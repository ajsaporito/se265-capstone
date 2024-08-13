# SE265 Capstone Project

![PHP](https://img.shields.io/badge/php-%3E%3D%207.4-blue)
![Bootstrap](https://img.shields.io/badge/bootstrap-%5E5.0-blueviolet)
![jQuery](https://img.shields.io/badge/jquery-%5E3.6.0-blue)
![MySQL](https://img.shields.io/badge/mysql-%5E8.0.0-orange)
<br>
[![forthebadge](https://forthebadge.com/images/badges/powered-by-coders-sweat.svg)](https://forthebadge.com)

## Overview

This site is the capstone project for the SE265 course at New England Tech, coded by AJ Saporito and Tristen Jussaume. Users on this site can post or request to work on jobs related to software development. Additionally, when a user is satisfied with their job and the results, they have the option to leave a review towards whoever worked on it.

## Setup

1. **Clone the Repository:**

    ```sh
    git clone https://github.com/ajsaporito/se265-capstone.git
    ```

2. **Set Up Your Web Server:**

    - For XAMPP, move the project to the `htdocs` directory.

3. **Configure the Database:**

    - Create a file named `dbconfig.ini` in the `config` directory and add your database configuration:

      ```ini
      [database]
      servername = your_server_name
      port = your_port_number
      username = your_database_username
      password = your_database_password
      dbname = your_database_name
      ```

   - Copy the `db.sql` file in the `docs` directory and execute the query to create the tables.

4. **Run the Application:**

    - Start your web server and navigate to `http://localhost/se265-capstone` in your web browser.

## License

This project is licensed under the MIT License.
