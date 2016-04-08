<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
</head>
<body>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script>
    var result;
    function reqListener() {
        console.log(this.responseText);
    }

    var oReq = new XMLHttpRequest(); //New request object
    oReq.onload = function () {
        //This is where you handle what to do with the response.
        //The actual data is found on this.responseText
        result = this.responseText;
        $.each(JSON.parse(result), function (index, obj) {
            //console.log(obj.lat + ":" + obj.lng);
            alert(obj.lat + " , " + obj.lng);
        });

    };
    oReq.open("get", "upload.php", true);
    //                               ^ Don't block the rest of the execution.
    //                                 Don't wait until the request finishes to
    //                                 continue.
    oReq.send();
</script>
</body>
</html>