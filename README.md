ebas
====

You can setup this project either on your local machine or an vagrant virtual machine.

# Local

First of all you have to install [Npm](https://www.npmjs.org/) which is part of [Node.js](http://www.nodejs.org/).

Afterwards you can install these packages with Npm on your command line:

[Bower](http://bower.io/) > `npm install bower -g` and
[Grunt](http://gruntjs.com/) > `npm install grunt-cli -g`.


To handle the required php packages you have to install [composer](https://getcomposer.org).

If you have installed all these tools you start to set up this project from your command line by running this commands:

`bower install`
`grunt`
`composer install`

The website is now ready to run.

As you should have seen this guide doesn't cover any webserver nor mysql installations. You have to do that on your own.

# Vagrant

This is the more convienient way to go.

First install:

[Virtualbox](https://www.virtualbox.org/wiki/Downloads)
[Vagrant](http://www.vagrantup.com/downloads.html)

Then run `vagrant up` from you command line.
