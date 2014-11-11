ebas
====

# Requirements

To make this application work with your database it has to meet the follwing requirements:

* ID must be the first field on every table
* ID must be an Auto Increment
* No foreign keys (working on it)

# Install

First of all, you have to install [Npm](https://www.npmjs.org/) which is part of [Node.js](http://www.nodejs.org/).  
Afterwards you can install the required tools with Npm on your command line:  

[Bower](http://bower.io/) > `npm install bower -g` and  
[Grunt](http://gruntjs.com/) > `npm install grunt-cli -g`.

If you have installed all these tools, start to set up the project from your command line by running these commands:  

`bower install`  
`grunt`

The application is now ready to run.
As you should have seen this guide doesn't cover any webserver nor mysql installations. You have to do that on your own.  
Now it's time to configure the configuration file so the application works with your database.  
Create a copy of the config file and update it (see Config chapter).  

`config-example.json > config.json`

# Config

Update `config.json` based on your database fields and functions.

* `user` MySQL database user  
* `password` MySQL database user password  
* `server` MySQL database servername  
* `database` MySQL database containing the data to display  
* `table[]` Contain configuration foreach table to display  

## Table

* `name` Displayname of your choice for the table  
* `sqlname` SQL table name  
* `sqlstart` Start of SELECT query for this table  
* `options` Display options for this table  
  * `hide` Hide the table  
  * `adminonly` Only give access to admin users  
* `fields[]` Contains definitons for each field to display  

## Fields

* `name` Displayname of your choice for the field  
* `sqlname` SQL field name  
* `options` Display and process options for this field  
  * `contenteditable` Allow edit on this field  
  * `runfunctiononce` Run the process function only once  
* `function` MySQL function to run when value is added to the databse, use `%VALUE%` as placeholder  
