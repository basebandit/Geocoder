var map;
var infoWindow;
var boundRegion;
var contentString;
var boundRegionCoords;


function initMap() {
    //Region(polygon) to plot on the map
    boundRegionCoords = [
        {lat: -1.0899350, lng: 37.0199040},
        {lat: -1.1179270, lng: 37.0247480},
        {lat: -1.1634730, lng: 37.0812830}
    ];

    //Wrapping my region coordinates in a bound so as
    //to get the center of the bound and start the
    //initial map plotting from the bound's center coordinates.
    var bound = new google.maps.LatLngBounds();
    for (var i = 0; i < boundRegionCoords.length; i++) {
        bound.extend(new google.maps.LatLng(boundRegionCoords[i]));
    }
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 16,
        center: bound.getCenter() /*{lat:-1.1267040000000001, lng:37.05059349999999}*/,
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

    document.getElementById('submit').addEventListener('click', function () {
        geocodeAddress(geocoder, map);
    });
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
