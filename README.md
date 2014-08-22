#CodeIgniter FileUpload with JQuery

## Demo
[File Upload Demo](http://fileupload.leewardassociates.com/)

## Description
###Uploading files using Codeigniter

This project shows how to upload files to a server in php using the CodeIgniter framework.  Sebastian Tschan's jQuery-File-Upload script is used for the front end.  The back end processing is being handled by php in the CodeIgniter framework.  The files are stored in a mysql database.  I've included the script to create the table as well.

##Methodology

Codeigniter's [File Upload](https://ellislab.com/codeigniter/user-guide/libraries/file_uploading.html) library is used to handle the file uploads. The files are stored in the 'files' folder at the web root.  The information (including the actual file) is then stored in the database. I choose to store my files in the database instead of in a file structure so that the file and information aren't stored in different places on the server.  After the file is saved, the file is removed from the 'files' folder and the file details are returned back to the client via ajax so that the new file can be shown in the file list.

## Requirements

The requirements are built into the application.  Look at upload.php to see the javascript and style sheets needed. Bootstrap 3 is used for the look and feel.

## License
Released under the [MIT license](http://www.opensource.org/licenses/MIT).

## Donations
This is free software, but you can donate to support the developer, Michael Dirks:

Flattr: [![Flattr](https://api.flattr.com/button/flattr-badge-large.png)](https://flattr.com/submit/auto?user_id=dirksm&url=https%3A%2F%2Fgithub.com%2Fdirksm%2Fcodeigniter-fileupload)

PayPal: [![PayPal](https://www.paypalobjects.com/WEBSCR-640-20110429-1/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=EPCL3KAXXHDVL)
