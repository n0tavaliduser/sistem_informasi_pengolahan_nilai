
# LMS SMK Negeri 1 Maros

## Installation

Clone from github repository :

```bash
git clone git@github.com:n0tavaliduser/sistem_informasi_pengolahan_nilai.git
```
Change directory :
```bash
cd sistem_informasi_pengolahan_nilai
```
Installation :
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```


    
## Tech Stack

**Client:** Velzon, Bootstrap 5

**Server:** Laravel 10

**Database:** MySQL


## Screenshots

Login Page :

![Login Page](https://via.placeholder.com/468x300?text=App+Screenshot+Here)

Admin Dashboard

![Login Page](https://via.placeholder.com/468x300?text=App+Screenshot+Here)
