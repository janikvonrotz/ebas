ebas
====

ebas is a lightweight user friendly mysql content manager.

![](https://janikvonrotz.ch/wp-content/uploads/2014/12/ebas-table-edit-view.png)

# Live Demo

Url: https://janikvonrotz.ch/ebas  
Login with  
User `admin@ebas.ch`  
Password `ebas`  
Or  
User `login@ebas.ch`  
Password `ebas`  

# Features

* Excel like table edit 
* Authentication for editor and admin users
* Export data to CSV
* Simple sort and search functionality
* Add custom events for your workflow
* Customizable dropdown for foreign key resolution
* Everything is customizable (see config chapter)
* Responsive and touch friendly

# Requirements

To make this application work with your existing database, it has to meet the follwing requirements:

* ID must be the first field on every table
* ID must be an Auto Increment

# Install

First of all, you have to install [Npm](https://www.npmjs.org/) which is part of [Node.js](http://www.nodejs.org/).  
Afterwards you can install the required tools with Npm on your command line:  

[Bower](http://bower.io/) > `npm install bower -g` and  
[Grunt](http://gruntjs.com/) > `npm install grunt-cli -g`.

If you have installed all these tools, start to set up the project from your command line by running these commands:  

`bower install`  
`grunt`

The application is now ready to run.
As you should have seen this guide doesn't cover any webserver nor mysql installations. You have to do that on your own. Checkout the guide from [Janik von Rotz](https://janikvonrotz.ch/your-own-virtual-private-server-hosting-solution/).  
Now it's time to edit the configuration file so the application works with your database.  
Create a copy of the config file and update it (see the Config chapter).  

`config-example.json > config.json`

# Security

At this point you have to consider security restrictions. It's very important that you prevent the configuration files from being access.
We recommand you to use at least the following Nginx access rules:
```
location ~* \.(json)$ {
    deny all;
}
location ~* /(node_modules|bower_components)/ {
    deny all;
}
```
This configuration will restrict access to any .json configuration files of this project and also denys access the development folders, which might contain code you are not aware of.

# Config

Update `config.json` based on your database fields and functions.

* `user` MySQL database user  
* `password` MySQL database user password  
* `server` MySQL database servername  
* `database` MySQL database containing the tables to display  
* `table[]` Contains a configuration part for each table to display  

## Table

* `name` Displayname for the table of your choice  
* `sqlname` SQL table name  
* `sqlstart` Start of SELECT query for this table  
* `options` Display options for this table  
  * `hide` Hide the table  
  * `adminonly` Only give access to admin users  
* `fields[]` Contains definitons for each field to display  
* `events[]` Tasks to trigger on specific events

## Fields

* `name` Displayname for the field of your choice  
* `sqlname` SQL field name  
* `sqldropdown` Contains a SELECT statement, which acts as a foreign key display in the end. The first field has to be the ID of the foreign table, the foreign key in this field then will be replaced by a dropdown list containing the other fields of this statement.
* `options` Display and process options for this field  
  * `contenteditable` Allow edit on this field  
  * `runfunctiononce` Run the process function only once  
* `function` MySQL function to run when value is added to the databse, use `%VALUE%` as placeholder  

## Events

Events are tasks with different conditions that can be triggered on specific actions.  
In the PHP code you can add a trigger with the following snippet:  

```$result = runEvents("tablename","task-Bereinigunglauf",elementid);```

Then in the config file you have to associate the trigger with optional conditions and a task.  

* `trigger` Name of the event, which is being triggered on specific locations in the code
* `condition` Contains conditions that have be true in order to run the event task
  * `istable` Condition where table name must be the value
* `task` Definition of the event task

### RowDelete

Whenever a data row is deleted this trigger is called.

### task-Bereinigunglauf

This trigger is associated with the example task on the task page.

## Task

* `name` Name of the task to run

### copyfields

This task copies the values of the current table to another table.

* `totable` Name of the destination table
* `fieldmap[]` Tell which field should be copied to a field in the destination
  * `source` Fieldname from the current table
  * `destination` Fieldname from the destination table

### deletesameitems

This task deletes items based on the rule where specific fields in a table hold the same value as the items to delete.

* `sourcetable` Table containing the reference data sets
* `deleteontable` Table containing the data sets to delete, referenced by the source table
* `fieldmap[]` Define match rules for the delete reference
  * `source` Field holds the values to identify the elements for Deletion in the delete table
  * `destination ` Field holds the value which are identified by the source field
