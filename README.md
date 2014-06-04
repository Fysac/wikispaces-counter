# wikispaces-counter 
An online user counter designed for Wikispaces.

## Features
* Displays number of online users
* Displays usernames and profile pictures

## Quick setup
Choose a page on which to embed the counter (use the navigation menu if you want it to work on your entire wiki). Edit the page, and add an "Other HTML" widget with the following code:

````
<script src='https://wikispaces-counter.herokuapp.com/counter.js'></script>
````
Click "Save", and you're done!

## Using your own remote server
###Requirements
* SSL-secured web server with PHP support
* Writeable directory for wikispaces-counter

Upload index.php and counter.js into one directory of your choosing. Make sure that permissions are configured so that index.php can create new text files in this directory.

Open counter.js and point the variable **url** to where your copy of index.php is being hosted.

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
<script src='http://example.com/myfolder/counter.js'></script>
````
