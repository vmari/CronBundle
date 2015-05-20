# PHP-Crontab
Manage dinamic crons with requests in your PHP site.



To use:

* Require with composer:
    
    "repositories": [
        {
            "name": "valentinmari/crontab-bundle",
            "type": "vcs",
            "url": "https://github.com/valentinmari/CrontabBundle"
        }
    ],
    "require": {
        ...,   
        "valentinmari/crontab-bundle": "dev-master"
    }
    
    
* Register Bundle in AppKernel.php => new Crontab\CrontabBundle()

* Update your schema with 
    php app/console doctrine:schema:update --force
