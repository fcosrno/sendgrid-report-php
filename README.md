# sendgrid-report-php

[![Build Status](https://travis-ci.org/fcosrno/sendgrid-report-php.svg)](https://travis-ci.org/fcosrno/sendgrid-report-php) [![Latest Stable Version](https://poser.pugx.org/fcosrno/sendgrid-report/v/stable.svg)](https://packagist.org/packages/fcosrno/sendgrid-report) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/fcosrno/sendgrid-report-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/fcosrno/sendgrid-report-php/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/fcosrno/sendgrid-report-php/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/fcosrno/sendgrid-report-php/?branch=master)


PHP wrapper to view and manage SendGrid reports through the Web API.

This library extends the [official sendgrid-php library](https://github.com/sendgrid/sendgrid-php). For consistency, it follows the same coding style, dependencies and conventions.

## Quick usage

```php
$sendgrid = new Fcosrno\SendGridReport\SendGrid('username', 'password');
$report = new Fcosrno\SendGridReport\Report();
$report->spamreports();
$result = $sendgrid->report($report);
```


## Installation

Add SendGrid Report to your `composer.json` file. If you are not using [Composer](http://getcomposer.org), you should be. It's an excellent way to manage dependencies in your PHP application. 

```json
{  
  "require": {
    "fcosrno/sendgrid-report": "1.*"
  }
}
```

Then at the top of your PHP script require the autoloader:

```bash
require 'vendor/autoload.php';
```

## Example App

There is an example in `doc/example.php` to help jumpstart your development.

The `example.php` file requires a `example_params.json` file that contains your SendGrid credentials. The json file is in `.gitignore`, so no worries about accidental commits there. For your convenience, an example of this json file is included in `doc/example_params_placeholder.json` so that you can simply copy/paste that file and rename it to `example_params.json`.


## Usage

To begin using this library, initialize the SendGrid object with your SendGrid credentials.

```php
$sendgrid = new Fcosrno\SendGridReport\SendGrid('your_sendgrid_username', 'your_sendgrid_password');
```

Create a new SendGrid Report object and add your method details.

```php
$report = new Fcosrno\SendGridReport\Report();
$report->spamreports()->email('foo@bar.com');
$result = $sendgrid->report($report);
```

You can get Spam Reports, Blocks, Bounces, Invalid Emails, and Unsubscribes as defined in the [SendGrid Web API](https://sendgrid.com/docs/API_Reference/Web_API/index.html). Actions and parameters are chainable to the method. The `get` action is inferred by default.

For example, this GET request has a date parameter.

	https://api.sendgrid.com/api/spamreports.get.json?api_user=your_sendgrid_username&api_key=your_sendgrid_password&date=1

The equivalent would look like this:

```php
$sendgrid = new Fcosrno\SendGridReport\SendGrid('your_sendgrid_username', 'your_sendgrid_password');
$report = new Fcosrno\SendGridReport\Report();
$report->spamreports()->date();
$result = $sendgrid->report($report);
```

You can keep linking parameters:

```php
$sendgrid = new Fcosrno\SendGridReport\SendGrid('your_sendgrid_username', 'your_sendgrid_password');
$report = new Fcosrno\SendGridReport\Report();
$report->spamreports()->date()->days(1)->startDate('2014-01-01')->email('foo@bar.com');
$result = $sendgrid->report($report);
```


If you want to use another action like `delete`, `add` or `count`, just add it to the chain like this:

```php
$sendgrid = new Fcosrno\SendGridReport\SendGrid('your_sendgrid_username', 'your_sendgrid_password');
$report = new Fcosrno\SendGridReport\Report();
$report->blocks()->delete()->email('foo@bar.com');
$result = $sendgrid->report($report);
```


### Blocks

Returns list of blocks with the status, reason and email

```php
$report = new Fcosrno\SendGridReport\Report();
$report->blocks();
$result = $sendgrid->report($report);
```


### Bounces

Returns list of bounces with status, reason and email.

```php
$report = new Fcosrno\SendGridReport\Report();
$report->bounces();
$result = $sendgrid->report($report);
```

With parameter, an optional email address to search for.

```php
$report = new Fcosrno\SendGridReport\Report();
$report->bounces()->email('foo@bar.com');
$result = $sendgrid->report($report);
```


### Invalid Emails

Returns list of invalid emails with the reason and email.

```php
$report = new Fcosrno\SendGridReport\Report();
$report->invalidemails();
$result = $sendgrid->report($report);
```
### Spam Reports

Returns list of spam reports with the ip and email.

```php
$report = new Fcosrno\SendGridReport\Report();
$report->spamreports();
$result = $sendgrid->report($report);
```

### Unsubscribes

Requires API access for unsubscribes.

```php
$report = new Fcosrno\SendGridReport\Report();
$report->unsubscribes();
$result = $sendgrid->report($report);
```


## Contributing

1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Commit your changes (`git commit -am 'Added some feature'`)
4. Push to the branch (`git push origin my-new-feature`)
5. Create new Pull Request

Testing
--------
Tests are built with [PHPUnit](https://github.com/sebastianbergmann/phpunit/).

Make sure you install with dev requirements.
```bash
composer install
```

Go to the root of the project then run all tests by typing in the terminal:
```bash
phpunit
```
