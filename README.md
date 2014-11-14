ebas
====

ebas is a lightweight user friendly mysql content manager.

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
* `events[]` Tasks to trigger on specific events

## Fields

* `name` Displayname of your choice for the field  
* `sqlname` SQL field name  
* `options` Display and process options for this field  
  * `contenteditable` Allow edit on this field  
  * `runfunctiononce` Run the process function only once  
* `function` MySQL function to run when value is added to the databse, use `%VALUE%` as placeholder  

## Events

Events are tasks with different conditions that can be triggered on specific actions.  
In your PHP code you can add an Trigger with the following snippet:  

```$result = runEvents("tablename","task-Bereinigunglauf",elementid);```

Then in the config file you have to associate the trigger with optional conditions and a task.  

* `trigger` Name of the event, used to trigger on specific locations in the code
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
* `deleteontable` Table containing the data sets to delete referenced by the source table
* `fieldmap[]` Define match rules for the delete reference
  * `source` Field holds the values to identify the elements to delete in the delete table
  * `destination ` Field holds the value which are identified by the source field
