# Problems

Syntax error or access violation: 1071 Specified key was too long
Inside config/database.php, replace this line for mysql
'engine' => 'InnoDB ROW_FORMAT=DYNAMIC',

# Installation

Open your terminal then type those commands
- `git clone https://github.com/Jakirsoft-Intern/dt-adminlte-integration.git`
- `cd dt-adminlte-integration`
- `composer install` or `composer update`
- `npm install`
- `npm run dev`
- In Windows:
`copy .env.example .env`
In Linux/Mac:
`cp .env.example .env`
- edit .env file and add database info
- `php artisan key:generate`
- `php artisan migrate:fresh -seed`
- `php artisan serve`

# Helpers
- For Routes list visit **/routes**
- For Artisan Command visit **/~artisan**

# Preview

1. Login
    ![Login](https://i.postimg.cc/3RGv71K8/screenshot-2.png)
2. Register
    ![Register](https://i.postimg.cc/fWmM7F2W/screenshot-3.png)
3. Dashboard
    ![Dashboard](https://i.postimg.cc/nh071TVr/screenshot-4.png)
4. Blank Page
    ![Blank_Page](https://i.postimg.cc/B68V3X75/screenshot-5.png)
