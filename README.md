<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a><h2 align="center">CRUD Geotag Photos</h2></p>

## About

This application is a simple CRUD application that allows users to upload geotagged photos and get location coordinates from them. This application uses LeafletJS to display photo locations on a map. Developed using laravel 11.x.

## Features

- Display location coordinates on a map
- Upload geotagged photo
- Update data geotagged photo
- Delete location coordinates and photo

## Requirements

- PHP 8.2 or higher
- PHP Extensions: Ctype, cURL, DOM, Fileinfo, Filter, Hash, Mbstring, OpenSSL, PCRE, PDO, Session, Tokenizer, XML, Exif
- Composer
- Node.js
- NPM
- Database (MySQL, PostgreSQL, SQLite, SQL Server, etc.)

[https://laravel.com/docs/11.x/deployment#server-requirements](https://laravel.com/docs/11.x/deployment#server-requirements)

## Installation

#### Manual Installation

- Clone the repository
- Create a new database
- Copy the `.env.example` file to `.env`
- Update the `.env` file with your database credentials
- Run `composer install`
- Run `npm install`
- Run `npm run build`
- Run `php artisan key:generate`
- Run `php artisan migrate`
- Run `php artisan storage:link`
- Run `php artisan serve`
- Visit `http://localhost:8000` in your browser

#### Makefile Installation
- Clone the repository
- Run `make setup`
- Run `make dev`
- Visit `http://localhost:8000` in your browser

## Preview
![Preview Upload Page](public/screenshot/upload.png "Upload Page")

![Preview Map Page](public/screenshot/map.png "Map Page")

![Preview Edit Page](public/screenshot/edit.png "Edit Page")

___
> unsorry@2024
