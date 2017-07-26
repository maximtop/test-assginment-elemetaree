# Elementaree company test task

### Description
Project able to get and save data from weather api and then render weather data in an calendar. It also marks the day of month which has the max temperature amplitude with red color. And days with temperature above the average month ampltitude with yellow color.

Whole test task description you can find [here](https://docs.google.com/spreadsheets/d/1kcn2QQs2oSfg-7STnvGffqta_-c-yM0fzmKbzTUYRss/edit?usp=sharing)
![alt text](https://www.dropbox.com/s/ygdroxwonali29q/Selection_033.png?dl=1 "Weather rendering in calendar")

Installation
============

### Requirements

- Composer
- Makefile
- MySQL
- PHP 5.4 or above. Ideally latest PHP 7

### Project downloading
```
$ git clone https://github.com/maximtop/test-elemetaree.git test-elementaree
$ cd test-elementaree
```

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

After that you can install app by running in your terminal command
```
$ make install
```
As you can see in Makefile this command installs all composer dependencies and migrate database structure

If there is no errors than you can run command
```
$ make weather
```
this command will supply our database with data from our weaher api

Now in order to run local server print in your terminal
```
$ make serve
```
After this you will be able to get weather data by the url
localhost:8080/index.php?r=weather
