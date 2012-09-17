<html>

    <head>
        <title>PageDown Demo Page</title>
        
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        
<!-- Pagedown stuff -BEGIN- -->
        <script type="text/javascript" src="js/Markdown.Converter.js"></script>
        <script type="text/javascript" src="js/Markdown.Sanitizer.js"></script>
        <script type="text/javascript" src="js/Markdown.Editor.js"></script>
<!-- Pagedown stuff -BEGIN- -->

<!-- upload stuff -BEGIN- -->
        <script type='text/javascript' src='js/jquery-1.8.0.min.js'></script>
        <script type='text/javascript' src='js/jquery-ui-1.8.23.custom.min.js'></script>
        <link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.8.23.custom.css" />
        <link rel="stylesheet" type="text/css" href="css/pagedown_upload.css" />
        <script type='text/javascript' src='js/jquery.ajaxfileupload.js'></script>        
        <!-- upload stuff -END- -->

    </head>
<!-- Pagedown stuff -BEGIN- -->
    <div class="wmd-panel">
            <div id="wmd-button-bar"></div>
            <textarea class="wmd-input" id="wmd-input">
This is the *first* editor.
------------------------------

Just plain **Markdown**, except that the input is sanitized:

<marquee>I'm the ghost from the past!</marquee>
</textarea>

    MD goes here
        </div>
        <div id="wmd-preview" class="wmd-panel wmd-preview"></div>
<!-- Pagedown stuff -END- -->



    
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
    		if ($('#wmd-input').length > 0) {
                var converter = new Markdown.Converter();
                var help = function () { window.open('http://stackoverflow.com/editing-help'); }
                var editor = new Markdown.Editor(converter, null, { handler: help });

                var $dialog = $('#insertImageDialog').dialog({ 
                    autoOpen: false,
                    closeOnEscape: false,
                    open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); }
                });

                var $loader = $('span.loading-small', $dialog);
                var $url = $('input[type=text]', $dialog);
                var $file = $('input[type=file]', $dialog);

                editor.hooks.set('insertImageDialog', function(callback) {

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

                    return true; // tell the editor that we'll take care of getting the image url
                });

                editor.run();
            }
                
		});
    </script>
