Medical Site - for learning purposes

SETUP DB
--------
~~~
yii migrate/up --migrationPath=@vendor/dektrium/yii2-user/migrations
yii migrate
~~~

SETUP TEST DB
-------------
~~~
tests\bin\yii migrate/up --migrationPath=@vendor/dektrium/yii2-user/migrations
tests\bin\yii migrate
~~~

RUN TESTS
---------
You have to install Java and ChromeDriver first.
Then run ChromeDriver:
~~~
chromedriver --url-base=/wd/hub
~~~
And then run tests:
~~~
vendor\bin\codecept run
~~~


INSTALLATION
------------

Update dependencies with Composer
~~~
composer update
~~~