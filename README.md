# Blog_Perso

Welcome in your Blog_Perso.

[![Build Status](https://app.travis-ci.com/thomasop/blog_perso.svg?branch=master)](https://app.travis-ci.com/thomasop/blog_perso)

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/82dee796ec5c44d28917777e0412943c)](https://www.codacy.com/gh/thomasop/blog_perso/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=thomasop/blog_perso&amp;utm_campaign=Badge_Grade)

[![Maintainability](https://api.codeclimate.com/v1/badges/f6115e64e8204ff6cf66/maintainability)](https://codeclimate.com/github/thomasop/blog_perso/maintainability)

## How to install the project

### Prerequisite
PHP 8

Download Wamp, Xampp, Mamp or WebHost

Symfony 5.4

Composer

### Clone
Go in directory.
Make a clone with git clone https://github.com/thomasop/blog_perso.git

### Configuration
Update environnements variables in the .env file with your values.
At the very least you need to define the SYMFONY_ENV=prod
MAILER_URL

### Composer
Install composer with composer install and init the projet with composer init in blog_perso

### Start the project
At the root of your project use the command php bin/console server:start -d

### Test
For run test: make tests 
