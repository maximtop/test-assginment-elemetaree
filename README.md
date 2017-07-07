# Elementaree company test task

[![Code Climate](https://codeclimate.com/github/maximtop/ee-test-task/badges/gpa.svg)](https://codeclimate.com/github/maximtop/ee-test-task)
[![Issue Count](https://codeclimate.com/github/maximtop/ee-test-task/badges/issue_count.svg)](https://codeclimate.com/github/maximtop/ee-test-task)
[![Test Coverage](https://codeclimate.com/github/maximtop/ee-test-task/badges/coverage.svg)](https://codeclimate.com/github/maximtop/ee-test-task/coverage)
[![Build Status](https://travis-ci.org/maximtop/ee-test-task.svg?branch=master)](https://travis-ci.org/maximtop/ee-test-task)

### Description
Project able to get and save data from weather api and then render weather data as an calendar

Whole test task description you can find [here](https://docs.google.com/spreadsheets/d/1kcn2QQs2oSfg-7STnvGffqta_-c-yM0fzmKbzTUYRss/edit?usp=sharing)

Installation
============

### Requirements

- Composer
- Makefile
- MySQL
- PHP 5.4 or above. Ideally latest PHP 7

### Project downloading

$ git clone https://github.com/maximtop/test-elemetaree.git test-elementaree
$ cd test-elementaree

Configuration
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.

### Api Key

Edit the file `components/WeatherApi.php` with real api key from https://developer.worldweatheronline.com/my/:

```{
    private $api_key = 'your_api_key_here';
```

### Installing

As you can see in Makefile this command installs all composer dependencies and migrate database structure

If there is no errors than run command
```
make weather
```
this command will supply our database with data from our weaher api

No in order to run local server print in your terminal
```
make serve
```
After this you will be able to get weather data by the url
localhost:8080/index.php?r=weather
