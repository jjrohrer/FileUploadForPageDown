FileUploadForPageDown
=====================

This is a working demo of making file uploading work with pagedown.  There really isn't any original code here, I just took inspiration from http://ben.onfabrik.com/posts/pagedown-markdown-editor-custom-image-dialog and got it working for me.  Infinite thanks Ben Foster.

Instructions
------------
* Put this on your server
* ensure the 'upload' directory is writable by the web server (something like: 'sudo chown  _www upload' on a Mac)
* visit uploaddemoWithMd.php

Motivation
----------
Ben Foster wrote a post (http://ben.onfabrik.com/posts/pagedown-markdown-editor-custom-image-dialog) about how to add a file-uploader to PageDown.  He didn't include runable code, though, just a thurough explanation.  I spent some time getting a working demo going and figured that I would post it in case it helped somebody else.  


Resources/Sources
-----------------
* PageDown (http://code.google.com/p/pagedown/)
*  jfeldstein / jQuery.AjaxFileUpload.js (https://github.com/jfeldstein/jQuery.AjaxFileUpload.js)
* Article on getting the two to work together (http://ben.onfabrik.com/posts/pagedown-markdown-editor-custom-image-dialog)
* jQuery (http://jquery.com)


Disclaimer
-----------
I'm new to git, so be please be gentle - I'm sure there is a better way to make demo's using code from multiple repositories (well maybe, PageDown is hosted via mercurial)

Troubleshooting
---------------
If you get a message back 'undefined', then you 'probably' have a permission problem.  At this point, you'll probably want to load it up in firebug to see what the message from the server is.
NiceToDo: modify JS so if th the response from the server is 'underfined', the print out the raw response to the developer