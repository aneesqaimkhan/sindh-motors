# CodeIgniter 4 User Management System

A complete user management system built with CodeIgniter 4 featuring login, registration, and admin panel functionality.

## Features

- **User Authentication**: Login and registration system
- **User Management**: Complete CRUD operations for users
- **Admin Panel**: Modern admin interface with statistics
- **Responsive Design**: Mobile-friendly Bootstrap 5 interface
- **Security**: Password hashing and validation
- **Database**: MySQL database with proper migrations

## User Fields

The system includes the following user fields:
- `name` - Full name
- `fname` - Father's name
- `cnic_no` - CNIC number (unique)
- `cell_no` - Cell phone number
- `date_of_birth` - Date of birth
- `category_id` - User category (Student, Teacher, Employee, Other)
- `status` - User status (active/inactive)
- `email` - Email address (unique)
- `username` - Username (unique)
- `password` - Hashed password

## Installation

### Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Composer
- Web server (Apache/Nginx)

### Step 1: Clone/Download the Project

```bash
# If using git
git clone <repository-url>
cd sindh-motors

# Or extract the downloaded files
```

### Step 2: Install Dependencies

```bash
composer install
```

### Step 3: Database Setup

1. Create a MySQL database named `ci4_users`
2. Update the database configuration in `app/Config/Database.php`:

```php
public array $default = [
    'hostname' => 'localhost',
    'username' => 'your_username',
    'password' => 'your_password',
    'database' => 'ci4_users',
    'DBDriver' => 'MySQLi',
    'DBPrefix' => '',
    'pConnect' => false,
    'DBDebug' => true,
    'charset' => 'utf8',
    'DBCollat' => 'utf8_general_ci',
    'swapPre' => '',
    'encrypt' => false,
    'compress' => false,
    'strictOn' => false,
    'failover' => [],
    'port' => 3306,
];
```

### Step 4: Run Database Migration

```bash
# Navigate to the project directory
cd sindh-motors

# Run the migration
php spark migrate
```

### Step 5: Configure Environment

1. Copy the `env` file to `.env`:
```bash
cp env .env
```

2. Update the `.env` file with your configuration:
```env
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost/your-project-path/public/'
database.default.hostname = localhost
database.default.database = ci4_users
database.default.username = your_username
database.default.password = your_password
```

### Step 6: Set Permissions

Make sure the `writable` directory is writable:

```bash
chmod -R 755 writable/
```

## Usage

### Accessing the Application

1. **Login Page**: `http://localhost/your-project-path/public/login`
2. **Registration Page**: `http://localhost/your-project-path/public/register`
3. **Dashboard**: `http://localhost/your-project-path/public/dashboard`
4. **Admin Panel**: `http://localhost/your-project-path/public/admin`

### User Registration

1. Visit the registration page
2. Fill in all required fields
3. Submit the form
4. Login with your credentials

### Admin Features

- **Dashboard**: View user statistics
- **User Management**: View, add, edit, delete users
- **User Status**: Toggle user active/inactive status
- **User Search**: Search and filter users

## File Structure

```
sindh-motors/
├── app/
│   ├── Config/
│   │   ├── Database.php
│   │   └── Routes.php
│   ├── Controllers/
│   │   ├── Auth.php
│   │   └── Admin.php
│   ├── Database/
│   │   └── Migrations/
│   │       └── 2024-01-01-000001_CreateUsersTable.php
│   ├── Models/
│   │   └── UserModel.php
│   └── Views/
│       ├── auth/
│       │   ├── login.php
│       │   └── register.php
│       ├── admin/
│       │   ├── dashboard.php
│       │   ├── users.php
│       │   └── add_user.php
│       └── dashboard/
│           └── index.php
├── public/
├── writable/
└── README.md
```

## Routes

- `GET /` - Redirects to login
- `GET/POST /login` - User login
- `GET/POST /register` - User registration
- `GET /logout` - User logout
- `GET /dashboard` - User dashboard
- `GET /admin` - Admin dashboard
- `GET /admin/users` - User management
- `GET/POST /admin/addUser` - Add new user
- `GET/POST /admin/editUser/{id}` - Edit user
- `GET /admin/deleteUser/{id}` - Delete user
- `GET /admin/toggleStatus/{id}` - Toggle user status

## Security Features

- Password hashing using PHP's `password_hash()`
- Input validation and sanitization
- CSRF protection
- Session management
- Unique constraints on email, username, and CNIC

## Customization

### Adding New Fields

1. Update the migration file
2. Update the UserModel
3. Update the views
4. Update the controllers

### Styling

The application uses Bootstrap 5 with custom CSS. You can modify the styles in each view file or create a separate CSS file.

## Troubleshooting

### Common Issues

1. **Database Connection Error**: Check your database credentials in `app/Config/Database.php`
2. **Migration Error**: Make sure your database exists and is accessible
3. **Permission Error**: Ensure the `writable` directory has proper permissions
4. **URL Error**: Update the `app.baseURL` in your `.env` file

### Error Logs

Check the error logs in `writable/logs/` for detailed error information.

## Support

For support and questions, please refer to:
- [CodeIgniter 4 Documentation](https://codeigniter4.github.io/userguide/)
- [Bootstrap 5 Documentation](https://getbootstrap.com/docs/5.0/)

## License

This project is open-source and available under the MIT License.
