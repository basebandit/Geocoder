var map;
var infoWindow;
var boundRegion;
var contentString;
var boundRegionCoords;
var areaName;
function initMap() {
//Server side json output of the database query
    var result;
    //Region(polygon) to plot on the map
//    boundRegionCoords = [{lat: 25.774, lng: -80.190},
//        {lat: 18.466, lng: -66.118},
//        {lat: 32.321, lng: -64.757},
//        {lat: 25.774, lng: -80.190}
//    ];
    boundRegionCoords = [
        {lat: -1.0899350, lng: 37.0199040},
        {lat: -1.1179270, lng: 37.0247480},
        {lat: -1.1634730, lng: 37.0812830}
    ];
    var arrayCoords = new Array();
    var oReq = new XMLHttpRequest(); //New request object
    oReq.onload = function () {
        //This is where you handle what to do with the response.
        //The actual data is found on this.responseText
        result = this.responseText;
        //console.log(result.data);
//        $.each(JSON.parse(result), function (index, obj) {
//            //console.log(obj.lat + ":" + obj.lng);
//            arrayCoords.push("lat:"+obj.lat, "lng:"+obj.lng);
//            
//        
//
//        });
        //console.log($.parseJSON(result).data);
        //boundRegionCoords = $.parseJSON(result).data;
        $.each($.parseJSON(result).data, function (idx, obj) {
            //console.log(obj.lat + ":" + obj.lng);   
            boundRegionCoords[idx] = new google.maps.LatLng(obj.lat, obj.lng);
        });
        areaName = $.parseJSON(result).area;
        //console.log(boundRegionCoords);
//        for (var i = 0; i < arrayCoords.length; i++) {
//            // var coords = arrayCoords[i].split(",");
//            // console.log(coords);
//            var anotherArr = new Array();
//            anotherArr[i] = new google.maps.LatLng(arrayCoords);
//            //Array.prototype.splice.apply(boundRegionCoords, [0, boundRegionCoords.length].concat(anotherArr));
//        }
//        console.log(anotherArr);
    };
    oReq.open("get", "search.php", true);
    //                               ^ Don't block the rest of the execution.
    //                                 Don't wait until the request finishes to
    //                                 continue.
    oReq.send();
    //console.log(boundRegionCoords);

    //Wrapping my region coordinates in a bound so as
    //to get the center of the bound and start the
    //initial map plotting from the bound's center coordinates.
    var bound = new google.maps.LatLngBounds();
    for (var i = 0; i < boundRegionCoords.length; i++) {
        bound.extend(new google.maps.LatLng(boundRegionCoords[i].lat, boundRegionCoords[i].lng));
    }
//console.log(boundRegionCoords[0].lat);
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 16,
        center: bound.getCenter()/*{lat:-1.1267040000000001, lng:37.05059349999999}*/,
        mapTypeId: google.maps.MapTypeId.HYBRID
    });
    //Construct the Polygon
    boundRegion = new google.maps.Polygon({
        paths: boundRegionCoords,
        strokeColor: '#FF0000',
        strokeOpacity: 0.8,
        strokeWeight: 3,
        fillColor: '#FF0000',
        fillOpacity: 0.35
    });
    boundRegion.setMap(map);
    //Add a listener for the click event
    boundRegion.addListener('click', showArrays);
    infoWindow = new google.maps.InfoWindow;
    var geocoder = new google.maps.Geocoder();
    $('#analyze').click(function () {
        $("#area").append($.parseJSON(result).area);
        $("#calcArea").val(calcArea());
        $("#distance").append($.parseJSON(result).area);
        $("#calcDistance").val(calcDistance());
    });
    window.onload = function () {
        $("#calcArea").val("");
        $("#calcDistance").val("");
    };
//    document.getElementById('analyze').addEventListener('click', function () {
//
//    });

}

function geocodeAddress(geocoder, resultsMap) {
    var address = document.getElementById('address').value;
    geocoder.geocode({'address': address}, function (results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: resultsMap,
                position: results[0].geometry.location
            });
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}
/** @this {google.maps.Polygon} */
function showArrays(event) {
//Since this boundRegion(Polygon) has only one path, we can call getPath() to return the
//MVCArray of LatLngs.
    var vertices = this.getPath();
    contentString = '<b>Bound Region polygon</b><br>' +
            'Clicked location: <br>' + event.latLng.lat() + ',' + event.latLng.lng() +
            '<br>';
    //Iterate over the vertices.
    for (var i = 0; i < vertices.getLength(); i++) {
        var xy = vertices.getAt(i);
        contentString += '<br>' + 'Coordinate ' + i + ':<br>' + xy.lat() + ',' +
                xy.lng();
    }
    var area = calcArea();
    contentString += '<br>' + '<b>Area of Bound Region Polygon</b><br>' +
            area.toFixed(1) + 'm<sup>2</sup>';
    var distance = calcDistance();
    contentString += '<br>' + '<b>Distance of Bound Region Polygon</b><br>' +
            distance.toFixed(1) + 'm';
    //Replace the info Window's content and position.
    infoWindow.setContent(contentString);
    infoWindow.setPosition(event.latLng);
    infoWindow.open(map);
}

function calcArea() {

//Use the Google Maps geometry library to measure the area of the polygon(bound region)
    var area = google.maps.geometry.spherical.computeArea(boundRegion.getPath().getArray());
    return area;
}

function calcDistance() {
    var length = google.maps.geometry.spherical.computeLength(boundRegion.getPath().getArray());
    return length;
}
