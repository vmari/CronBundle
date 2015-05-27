## Installation

1. Download CronBundle using composer
2. Enable the Bundle
3. Define crons in your config

### Step 1: Download CronBundle using composer

Add CronBundle by running the command:

``` bash
$ php composer.phar require valentinmari/cron-bundle "dev-master"
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
        new Cron\CronBundle(),
    );
}
```

### Step 3: Define crons in your config

Your site is ready to run crons. Now, write them in the `config.yml` file.
It's recommended put all crons in a new file named `crontab.yml` in your config 
folder.

```yaml
#app/config.yml
imports:
    # ...
    - { resource: crontab.yml }
```
```yaml
#app/crontab.yml
crontab:
    - { format: '*/1 * * * *', service: test_job }
    - { format: '*/1 * * * *', service: test_job }
```

The format is like Cron, from Unix. You must define a service, this service must
implement `JobInterface` and redefine the run() method.
Inside run() you can put your Job and do anything you want. You can inject things
in your service too.

```php
// AppBundle/Services/YourJob.php
namespace AppBundle\Services;
use Cron\JobInterface;

class YourJob implements JobInterface{
    public function run(){
        // Do your stuff.
    }
}
```
