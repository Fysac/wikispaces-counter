# wikispaces-counter 

An online user counter specifically designed for Wikispaces.

## Features
* Displays number of online users
* Displays usernames and profile pictures

## Caveats
* Does not work if you're accessing your wiki via HTTPS
* Only limited support for guests

## Quick setup
Edit your wiki's navigation menu, and add an "Other HTML" widget with the following code:


````
<script src='https://wikispaces-counter.herokuapp.com/counter.js'></script>
````

## Using your own remote server
###Requirements
* Web server with PHP support
* Writeable directory for wikispaces-counter

Upload counter.php and counter.js into a directory of your choosing. Make sure that permissions are configured so that counter.php can create new text files in this directory.

Open counter.js and point the variable **url** to where your copy of counter.php is being hosted.

For example:
````
var url = 'https://wikispaces-counter.herokuapp.com/index.php';
````

could become
````
var url = 'http://example.com/myfolder/index.php';
````

After that, just add this line as a widget to your wiki's navigation menu, and you're done:
````
<script src='http://example.com/myfolder//counter.js'></script>
````






