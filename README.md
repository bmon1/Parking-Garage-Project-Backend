
# Parking Garage Backend Project (Work in progress)

## How to get up and running

## Windows
- Install docker desktop **[Docker Desktop](https://www.docker.com/products/docker-desktop)**
- Install Windows Subsystem for Linux 2 **[WSL2](https://learn.microsoft.com/en-us/windows/wsl/install)**
- Configure WSL2 to work with docker **[Docker WSL2 configuration](https://docs.docker.com/desktop/wsl/)**
- Launch WSL2 with "wsl" command in PowerShell terminal
- Clone this repo "git clone https://github.com/bmon1/Parking-Garage-Project-Backend"
- cd Parking-Garage-Project-Backend
- Install laravel sail "composer require laravel/sail --dev"
- Publish sail config files "php artisan sail:install"
- Update .env file with these attributes
```
  DB_CONNECTION=mysql
  DB_HOST=mysql
  DB_PORT=3306
  DB_DATABASE=Parking_Garage
  DB_USERNAME=sail
  DB_PASSWORD=password
```
- Run sail containers in docker from WSL2 terminal inside project directory "./vendor/bin/sail up" (to stop Sail from running use "./vendor/bin/sail down"
- While sail containers are running, install dependencies "./vendor/bin/sail composer install"
- Run data migrations "./vendor/bin/sail artisan migrate"
- Laravel server should be running on http://localhost:80

<br>
<br>

## MacOS
- Clone this repo "git clone https://github.com/bmon1/Parking-Garage-Project-Backend"
- cd Parking-Garage-Project-Backend
- Install laravel sail "composer require laravel/sail --dev"
- Publish sail config files "php artisan sail:install"
- Update .env file with these attributes
```
  DB_CONNECTION=mysql
  DB_HOST=mysql
  DB_PORT=3306
  DB_DATABASE=Parking_Garage
  DB_USERNAME=sail
  DB_PASSWORD=password
```
- Run sail containers in docker from WSL2 terminal inside project directory "./vendor/bin/sail up" (to stop Sail from running use "./vendor/bin/sail down"
- While sail containers are running, install dependencies "./vendor/bin/sail composer install"
- Run data migrations "./vendor/bin/sail artisan migrate"
- Laravel server should be running on http://localhost:80
