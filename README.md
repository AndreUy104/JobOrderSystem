# Job Order System Application

The Job Order System Application is a web-based system designed to manage and track job orders within an organization. It provides a platform for creating, updating, and monitoring job orders efficiently.

## Features

- **Job Order Management:** Create, update, and delete job orders.
- **User Authentication:** Secure access to the system with user authentication.
- **Role-Based Access Control:** Different roles for users, such as admin and regular user, with varying permissions.
- **Reporting:** Generate reports and analytics on job orders.

### Prerequisites

- [PHP](https://www.php.net/) (>= 7.2)
- [Composer](https://getcomposer.org/)
- [laragon](https://laragon.org/index.html)

### Steps

1. Clone the repository:

   ```bash
   git clone https://github.com/AndreUy104/JobOrderSystem

2. Install PHP dependencies:
   ```base
   composer install

3. Run database migrations and seeders:
   ```bash
   php artisan migrate --seed

4. Start the development server:
   run laragon server

5. Enter URL:
   ```bash
   http://jobordersystem.test
