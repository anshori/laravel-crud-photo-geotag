<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a><h2 align="center">CRUD Photo Geotag</h2></p>

## About

This application is a simple CRUD application that allows users to upload photos and tag them with a location. The application uses the LeafletJS to display the location of the photos on a map.

## Requirements

- PHP 8.2 or higher
- PHP Extensions: Fileinfo, Mbstring, MySQLi, Exif
- Composer
- Node.js
- NPM
- MySQL

## Installation

- Clone the repository
- Run `composer install`
- Run `npm install`
- Run `npm run build`
- Create a new database
- Copy the `.env.example` file to `.env`
- Update the `.env` file with your database credentials
- Run `php artisan key:generate`
- Run `php artisan migrate`
- Run `php artisan storage:link`
- Run `php artisan serve`
- Visit `http://localhost:8000` in your browser

___
> unsorry@2024
