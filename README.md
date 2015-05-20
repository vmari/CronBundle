# PHP-Crontab
Manage dinamic crons with requests in your PHP site.



To use:

* Require with composer
```json 
"repositories": [
    {
        "name": "valentinmari/crontab-bundle",
        "type": "vcs",
        "url": "https://github.com/valentinmari/CrontabBundle"
    }
],
"require": {
    "valentinmari/crontab-bundle": "dev-master"
}
```

* Update your project
```bash
composer update
```
    
* Register Bundle in AppKernel.php
```php
$bundles = array(
    /* (...) */
    new Crontab\CrontabBundle(),
);
```

* Update your schema with 
```bash
php app/console doctrine:schema:update --force
```
