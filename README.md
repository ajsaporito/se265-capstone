# SE265 Capstone Project

![PHP](https://img.shields.io/badge/php-%3E%3D%207.4-blue)
![Bootstrap](https://img.shields.io/badge/bootstrap-%5E5.0-blueviolet)
![jQuery](https://img.shields.io/badge/jquery-%5E3.6.0-blue)
![MySQL](https://img.shields.io/badge/mysql-%5E8.0.0-orange)

## Overview

This site is the capstone project for the SE265 course at New England Tech. Coded by AJ Saporito and Tristen Jussaume, the site uses PHP and MySQL for the backend, and Bootstrap and jQuery for the frontend. Users on this site can post or request to work on jobs related to software development.

## Setup

1. **Clone the Repository:**

    ```sh
    git clone https://github.com/ajsaporito/se265-capstone.git
    ```

2. **Navigate to the Project Directory:**

    ```sh
    cd se265-capstone
    ```

3. **Set Up Your Web Server:**

    - For XAMPP, move the project to the `htdocs` directory or set up a virtual host.

4. **Configure the Database:**

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

5. **Run the Application:**

    - Start your web server and navigate to `http://localhost/se265-capstone` in your web browser.

## License

This project is licensed under the MIT License.
