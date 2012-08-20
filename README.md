INVO Application
================

Phalcon PHP is a web framework delivered as a C extension providing high
performance and lower resource consumption.

This is a sample application for the Phalcon PHP Framework. We expect to
implement as many features as possible to showcase the framework and its
potential.

Please write use if you have any feedback.

Thanks.

NOTE
----
The master branch will always contain the latest stable version. If you wish
to check older versions or newer ones currently under development, please
switch to the relevant branch.

Latest stable release: 0.4.4

Get Started
-----------

#### Requirements

To run this application on your machine, you need at least:

* PHP 5.3.x
* Apache Web Server with mod rewrite enabled
* Latest Phalcon Framework extension enabled

Then you'll need to create the database and initialize schema:

    echo 'CREATE DATABASE invo' | mysql -u root
    cat schemas/invo.sql | mysql -u root invo
