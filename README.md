## Installation

1. Download CrontabBundle using composer
2. Enable the Bundle
3. Configure your application's events
4. Configure the CrontabBundle
5. Update your database schema

### Step 1: Download CrontabBundle using composer

Add CrontabBundle by running the command:

``` bash
$ php composer.phar require valentinmari/crontab-bundle "dev-master"
```

Composer will install the bundle to your project's `vendor/valentinmari` directory.

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Crontab\CrontabBundle(),
    );
}
```

### Step 5: Update your database schema

Now that the bundle is configured, the last thing you need to do is update your
database schema because you have added a new entity, the `Cron` class.

Run the following command.

``` bash
$ php app/console doctrine:schema:update --force
```
