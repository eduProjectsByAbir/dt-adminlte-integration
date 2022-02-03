#Problems

Syntax error or access violation: 1071 Specified key was too long
Inside config/database.php, replace this line for mysql
'engine' => 'InnoDB ROW_FORMAT=DYNAMIC',

# Installation

- `git clone https://github.com/Jakirsoft-Intern/dt-adminlte-integration.git`
- `cd dt-adminlte-integration`
- edit .env file
- `php artisan migrate`
- `php artisan serve`
