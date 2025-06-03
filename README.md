# README

Project to test PHP Mailer

## Requirements

* Intall composer.
* Run `composer install`.


## Run 

* Start the container by `make start`
* Get inside the container `make bash`
* Follow the instructions to install composer: https://getcomposer.org/download/

Basically this at the time of writing:
```sh
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'.PHP_EOL; } else { echo 'Installer corrupt'.PHP_EOL; unlink('composer-setup.php'); exit(1); }"
php composer-setup.php
php -r "unlink('composer-setup.php');"
mv composer.phar /usr/local/bin/composer
```

* Install phpmailer, using the composer.json
```sh 
composer install
```


Go to the [site](http://localhost:8090)


## TODO
* Put the configuration in a more friendly way to store it.
* Automate in the docker file, composer installation. See: [How do I install Composer programmatically?](https://getcomposer.org/doc/faqs/how-to-install-composer-programmatically.md#how-do-i-install-composer-programmatically-)
* The `vendor` directory created by composer should be oustside of the public html folder, fix eventually, but right now is only for testing.
