<html>

    <head>
        <title>PageDown Demo Page</title>
        
        <link rel="stylesheet" type="text/css" href="demo.css" />
        
        <!-- upload stuff -BEGIN- -->
        <script type='text/javascript' src='js/jquery-1.8.0.min.js'></script>
        <script type='text/javascript' src='js/jquery-ui-1.8.23.custom.min.js'></script>
        <link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.8.23.custom.css" />
        <link rel="stylesheet" type="text/css" href="css/pagedown_upload.css" />
        <script type='text/javascript' src='js/jquery.ajaxfileupload.js'></script>        
        <!-- upload stuff -END- -->

    </head>
    
    <div id='uploadNow'>[upload now]</div>

    <div id="insertImageDialog" title="Insert Image">
    <h4>
        From the web</h4>
    <p>
        <input type="text" placeholder="Enter url e.g. http://yoursite.com/image.jpg" />
    </p>
    <h4>
        From your computer</h4>
    <span class="loading-small"></span>
    <input type="file" name="file" id="file" data-action="upload.php" />


</div>


    <script>
    	$(document).ready(function() {
    		var $dialog = $('#insertImageDialog').dialog({ 
                    autoOpen: false,
                    closeOnEscape: false,
                    open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); }
                });

                var $loader = $('span.loading-small', $dialog);
                var $url = $('input[type=text]', $dialog);
                var $file = $('input[type=file]', $dialog);

		    $('#uploadNow').bind('click', function() {
		    	// dialog functions
                    var dialogInsertClick = function() {                                      
                        callback($url.val().length > 0 ? $url.val() : null);
                        dialogClose();
                    };

                    var dialogCancelClick = function() {
                        dialogClose();
                        callback(null);
                    };

                    var dialogClose = function() {
                        // clean up inputs
                        $url.val('');
                        $file.val('');
                        $dialog.dialog('close');
                    };

                    // set up dialog button handlers
                    $dialog.dialog( 'option', 'buttons', { 
                        'Insert': dialogInsertClick, 
                        'Cancel': dialogCancelClick 
                    });

                    var uploadStart = function() {
                        $loader.show();
                    };

                    var uploadComplete = function(response) {
                        $loader.hide();
                        if (response.success) {
                            callback(response.imagePath);
                            dialogClose();
                        } else {
                            alert("There was an error upload your file.  The server says: " + response.message);
                            $file.val('');
                        }
                    };

                    // upload
                    $file.unbind('change').ajaxfileupload({
                        action: $file.attr('data-action'),
                        onStart: uploadStart,
                        onComplete: uploadComplete
                    });

                    // open the dialog
                    $dialog.dialog('open');
		    });
		});
    </script>
