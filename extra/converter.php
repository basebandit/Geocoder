<!DOCTYPE html>
<html>
    <head>
        <title>CSV To JSON</title>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../css/app.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    </head>
    <body>

        <?php require_once('../inc/components.php'); ?>
        <span class="heading-one">
            <h1>CSV to JSON Converter</h1>
        </span>
        <hr/>


        <input type="file" name="file-7[]" id="file" class="inputfile inputfile-6" data-multiple-caption="{count} files selected" multiple />
        <label for="file-7"><span></span> <strong><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> Choose a file&hellip;</strong></label>

        <textarea id="csv" class="text"></textarea>
        <br/>
        <input type="button" class="btn btn-primary" id="convert" value="Convert to JSON">
        <br/>
        <input type="button" class="btn btn-primary"id="download" value="Download JSON">
        <textarea id="json" class="text"></textarea>

        <script src="../js/converter.js"></script>
        <script type="text/javascript" src="../js/jquery.min.js"></script>
        <script type="text/javascript" src="../js/custom-file-input.js"></script>
        <script type="text/javascript" src="../js/jquery.custom-file-input.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <script>
            var fileInput = document.getElementById("file"),
                    readFile = function () {
                        var reader = new FileReader();
                        reader.onload = function () {
                            document.getElementById('csv').innerHTML = reader.result;
                        };
                        // start reading the file. When it is done, calls the onload event defined above.
                        reader.readAsBinaryString(fileInput.files[0]);
                    };

            fileInput.addEventListener('change', readFile);

        </script>    


    </body>
</html>