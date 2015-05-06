## CodeIgniter 3 Bootstrap 

**Work in progress**

A starter template that supports multi-tenant (Frontend / Admin Panel / API) website in a single application.

This repository is developed upon the following tools: 
* [CodeIgniter](http://www.codeigniter.com/) (v3.0.0) - PHP framework
* [Bootstrap](http://getbootstrap.com/) (v3.3.4) - popular frontend framework
* [Grocery CRUD](http://www.grocerycrud.com/) (v1.5.1) - feature-rich library to build CRUD tables
* [Image CRUD](http://www.grocerycrud.com/image-crud) (v0.6) - CRUD library for image management
* [AdminLTE](https://github.com/almasaeed2010/AdminLTE) (v2.0.5) - bootstrap theme for backend system


### Features

This repository contains setup for rapid development:
* Multi-tenant (e.g. Frontend Website, Admin Panel, API) website in single application
* Custom config files (sites.php, locale.php) for easy configuration of website behavior
* Admin Panel with AdminLTE v2 theme, and Grocery CRUD integration
* User authentication for Frontend Website (Sign Up, Login, Forgot Password, etc.)
* User authentication for Admin Panel (Login, Change Password, etc.)
* Preset layouts and templates
* Preset asset pipeline (e.g. minify scripts, image optimization) via Gulp (reference from [gulp-start 2.0 branch](https://github.com/greypants/gulp-starter/tree/2.0))
* Form Builder library to help with form rendering with Bootstrap theme, form validation, etc.
* Breadcrumb handling
* Multilingual support
* Email config setup
* Functions to be called from CLI (e.g. daily cron job, database backup)
* ... more coming!


### Screenshots

Frontend - Home: 

![](screenshots/frontend_home.png "Frontend Home")

Backend - Home: 

![](screenshots/admin_home.png "Backend Home")

More screenshots can be viewed from the [screenshots folder](https://github.com/waifung0207/ci_bootstrap_3/blob/master/screenshots/) under this repository.


### TODO

* Changelog file
* Enhance Form Builder library to support more field types
* Example of using Image CRUD
* Database migration setup (consider using [Phinx](https://phinx.org/) instead of CodeIgniter built-in one)
* Custom 404 error page
* API structure (e.g. authentication, response shortcut functions)
* More helpers to enhance code reusability
* Better documentation
