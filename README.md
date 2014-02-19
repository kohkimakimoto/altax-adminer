# Altax adminer plugin

[Adminer](https://github.com/vrana/adminer/) runs on the php built-in web server via [altax](https://github.com/kohkimakimoto/altax).

> Note: It runs with altax version 3 which is in development stage. You shouldn't use it yet.

## Installation

Edit your `.altax/composer.json` file like the following.

    {
      "require": {
        "kohkimakimoto/altax-adminer": "dev-master"
      }
    }

Run altax update.

    $ altax update

Add the following line your `.altax/config.php` file.

    Task::register('adminer', 'Altax\Contrib\Adminer\Command\AdminerCommand');

## Usage

Run the task command.

    $ altax adminer [-H|--host="..."] [-p|--port="..."] [--css="..."]

Access server using a web browser.

    http://localhost:3000/

## Configuration

Example:

```php
Task::register('adminer', 'Altax\Contrib\Adminer\Command\AdminerCommand')
->config(array(
    "host" => "localhost",
    "port" => 1234,
    "css" => "ng9",
    ));
```

### host

The host address of the server.

### port

The port of the server.

### css

The design css.

## See also

* [PHP: Built-in web server - Manual ](http://www.php.net/manual/en/features.commandline.webserver.php)
* [Adminer](https://github.com/vrana/adminer/)
* [altax](https://github.com/kohkimakimoto/altax)


