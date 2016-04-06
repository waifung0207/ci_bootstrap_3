## CodeIgniter 3 Bootstrap 

**Note: This project is still in progress, but welcome for any issues encountered**

A starter template that supports multi-tenant (Frontend / Admin Panel / API) website in a single application.

This repository is developed upon the following tools: 
* [CodeIgniter](http://www.codeigniter.com/) (v3.0.6) - PHP framework
* [CodeIgniter HMVC Extensions](https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc) - modular structure by [wiredesignz](http://wiredesignz.co.nz/)
* [codeigniter-base-model](https://github.com/jamierumbelow/codeigniter-base-model) - more advanced CRUD functions for models by [jamierumbelow](https://github.com/jamierumbelow)
* [codeigniter-restserver](https://github.com/chriskacerguis/codeigniter-restserver) - base setup for API module
* [Ion Auth](http://benedmunds.com/ion_auth/) - authentication library for CodeIgniter by [Ben Edmunds](http://benedmunds.com/)
* [Bootstrap](http://getbootstrap.com/) (v3.3.6) - popular frontend framework
* [Grocery CRUD](http://www.grocerycrud.com/) (v1.5.4) - feature-rich library to build CRUD tables
* [Image CRUD](http://www.grocerycrud.com/image-crud) (v0.6) - CRUD library for image management
* [AdminLTE](https://github.com/almasaeed2010/AdminLTE) (v2.3.2) - bootstrap theme for Admin Panel


### Features

This repository contains setup for rapid development:
* Multi-tenant (e.g. Frontend Website, Admin Panel, API) website in single application
* Modular design by CodeIgniter HMVC extension
* Custom config files (sites.php, locale.php) for easy configuration of website behavior
* Admin Panel with AdminLTE v2 theme, and Grocery CRUD integration
* Admin Panel includes usage of [Sortable](http://rubaxa.github.io/Sortable/) library
* API Site with [Swagger](http://swagger.io/) UI integrated, via annotations supported by [swagger-php](https://github.com/zircote/swagger-php) library
* API Site to handle RESTful endpoints, with shortcut functions to grab parameters and display results
* User authentication for Frontend Website (Sign Up, Login, Forgot Password, etc.)
* User authentication for Admin Panel (Login, Change Password, etc.)
* Preset layouts and templates
* Preset asset pipeline (e.g. minify scripts, image optimization) via gulp (reference from [gulp-starter](https://github.com/greypants/gulp-starter))
* Preset data structure for Blogging (with pagination) and Cover Photos (carousel), which can be managed from Admin Panel
* Form Builder library to help with form rendering with Bootstrap theme, form validation, etc.
* Breadcrumb and Pagination handling fit with Bootstrap theme
* Custom 404 pages for Frontend Website and Admin Panel
* Multilingual support
* Email config setup
* Functions to be called from CLI (e.g. daily cron job, database backup)
* ... more coming!


### Server Environment

Below configuration are preferred; other environments are not well-tested, but still feel free to report and issues. 

* **PHP 5.5+**
* **Apache 2.2+** with rewrite mod enabled
* **MySQL 5.5+** (not tested on MariaDB)


### Setup Guide

1. git clone this repo
2. Create a database (e.g. named "ci_bootstrap_3"), then import /sql/latest.sql into MySQL server
3. Make sure the database config (/application/config/database.php) is set correctly
4. You should be able to access Frontend Website, Admin Panel and API Site (with Swagger Doc) respectively
5. Visit the Demo Controllers (exist in both Frontend / Admin Panel / API) for sample usage

**Note** For more advanced workflow (includes repo upgrade), please have a look on my suggestion in [this issue](https://github.com/waifung0207/ci_bootstrap_3/issues/42). After release the v1.0 version, I will try to keep the upgrade procedure more developer friendly. 


### Admin Users (and default login accounts)

There are 4 preset users for Admin Panel:

* Webmaster (default username & password are both "webmaster", belongs to the webmaster group)
* Admin (default username & password are both "admin", belongs to the admin group)
* Manager (default username & password are both "manager", belongs to the manager group)
* Staff (default username & password are both "staff", belongs to the staff group)


### Folder Structure

Explanation on the folder structure which supports HMVC (only showing the highlighted folders and files).

```
application/                    --- Main CodeIgniter source files
    config/
        production/             --- Configuration when ENVIRONMENT is set as "production"
        autoload.php            --- By default, some files are loaded for this repo
        database.php            --- Need to verify to ensure connection with MySQL database
        email.php               --- Created to centralize email configuration (preset: using Mandrill service)
        form_validation.php     --- Created to centralize validation forms for all forms, include ReCAPTCHA settings
        routes.php              --- Changed default controller from Welcome to Home
        site.php                --- Core configuration file for Frontend Website; same format also applied to Admin module
    controllers/                --- Controllers for Frontend Website; extends from MY_Controller (except Cli)
        Cli.php                 --- Utility function that can only be called from command line
        Home.php                --- Default controller for Frontend Website        
        Language.php            --- Controller to handle language switching
    core/                       --- Extending CodeIgniter core classes; can also be used within modules
        MY_Controller.php       --- Important class which contains shared logic of all controllers
        MY_Form_validation.php  --- Contains additional rule for validation
        MY_Loader.php           --- Required for HMVC extension
        MY_Model.php            --- Contains shared function for model classes
        MY_Router.php           --- Required for HMVC extension
    helpers/                    --- Contains custom helper functions being used throughout this repo
    language/                   --- Preset language files
    libraries/                  --- Custom libraries (e.g. Ion Auth, Form Builder, System Message)
    models/                     --- Sample model extending from MY_Model
    modules/                    --- Each module can be accessed by http://{base_url}/{module_name}/{module_controller}/, etc.
        admin/                  --- Module for Admin Panel
            config/             --- Configuration for Admin Panel (overriding application/config/)
            controllers/        --- Controllers for Admin Panel; also extends from MY_Controller
            helpers/            --- Helper classes, e.g. to generate AdminLTE widgets
            libraries/          --- Libraries from Grocery CRUD and Image CRUB
            models/             --- Models only being used in Admin panel
            views/              --- Views for Admin Panel; can reuse Frontend views, or override by using same path/filename
        adminlte/               --- Module with AdminLTE widgets
        api/                    --- Another module specific for API endpoints
    third_party/
        MX/                     --- Required for HMVC extension
    views/                      --- Views for Frontend Website, can also be used by modules unless overrided
assets/
    api/                        --- Swagger UI assets
    css/                        --- Custom CSS files append to each site
    dist/                       --- Post-processed scripts and images via gulp tasks (don't manually edit files here!)
    fonts/                      --- Font files copied via gulp tasks
    grocery_crud/               --- Asset files from Grocery CRUD library
    image_crud/                 --- Asset files from Image CRUD library
    images/                     --- Source image files before optimization
    js/                         --- Custom CSS files append to each site
    theme/                      --- Default folder for additional theme files
    uploads/                    --- Default folder for upload files, where permission should set as writable
gulpfile.js/                    --- Task runner following gulp-starter practice
screenshots/                    --- Screenshot images for preview
sql/                            --- MySQL files
    backup/                     --- Files which will be created when backup database from CLI
    core/                       --- Files contains core data (e.g. Ion Auth)
    demo/                       --- Files contains demo data
    latest.sql                  --- Latest version of all preset data
system/                         --- CodeIgniter core files (unchanged as clean CI3 installation)
.htaccess                       --- URL rewrite for Apache web server (require mod enabled)
```


### Preset Gulp Tasks

The gulpfile.js folder is prepared with following tasks available:

* **default**: run **build** task first, then **watch** for file change
* **build**: run **imagemin**, **cssmin** and **uglify** tasks in parallel
* **rebuild**: run **clean** task first, then **copy**, **imagemin**, **cssmin** and **uglify** tasks in parallel
* **clean**: remove all files inside the dist folder (default: /assets/dist)
* **copy**: copy required files to dist folder
* **cssmin**: concat and minify CSS files
* **imagemin**: optimize images (jpg, png, gif, svg) and output to dist folder (default: /assets/dist/images)
* **uglify**: concat and minify (uglify) JS files
* **watch**: monitor JS / CSS / image files and execute specific tasks upon changes


### Screenshots

Frontend - Home: 

![](screenshots/frontend_home.png "Frontend Home")

Admin Panel - Home: 

![](screenshots/admin_home.png "Admin Panel Home")

More screenshots can be viewed from the [screenshots folder](https://github.com/waifung0207/ci_bootstrap_3/blob/master/screenshots/) under this repository.


### TODO

* Changelog file
* Better documentation (e.g. on [Gitbook](http://gitbook.com/))
* Enhance Form Builder library to support more field types
* API authentication (by API key or JSON Web Token, i.e. JWT)
* More helpers to enhance code reusability
