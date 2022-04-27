function initialize() {

    var mapOptions, map, marker, searchBox, city,
        infoWindow = '',
        addressEl = document.querySelector( '#map-search' );
        latEl = document.querySelector( '.latitude' );
        longEl = document.querySelector( '.longitude' );
        element = document.getElementById( 'map-canvas' );
    city = document.querySelector( '.reg-input-city' );

    mapOptions = {
        // How far the maps zooms in.
        zoom: 13,
        // Current Lat and Long position of the pin/
        center: new google.maps.LatLng( 36.80007843469928,10.183331478806037 ),
        // center : {
        // 	lat: -34.397,
        // 	lng: 150.644
        // },
        disableDefaultUI: false, // Disables the controls like zoom control on the map if set to true
        scrollWheel: true, // If set to false disables the scrolling on the map.
        draggable: true, // If set to false , you cannot move the map around.
        // mapTypeId: google.maps.MapTypeId.HYBRID, // If set to HYBRID its between sat and ROADMAP, Can be set to SATELLITE as well.
        // maxZoom: 11, // Wont allow you to zoom more than this
        // minZoom: 9  // Wont allow you to go more up.

    };

    /**
     * Creates the map using google function google.maps.Map() by passing the id of canvas and
     * mapOptions object that we just created above as its parameters.
     *
     */
    // Create an object map with the constructor function Map()
    map = new google.maps.Map( element, mapOptions ); // Till this like of code it loads up the map.

    /**
     * Creates the marker on the map
     *
     */
    marker = new google.maps.Marker({
        position: mapOptions.center,
        map: map,
        // icon: 'http://pngimages.net/sites/default/files/google-maps-png-image-70164.png',
        draggable: true
    });



    /**
     * Finds the new position of the marker when the marker is dragged.
     */
    google.maps.event.addListener( marker, "dragend", async function (event) {
        var lat, long, address, resultArray, citi;

        console.log('i am dragged');
        lat = marker.getPosition().lat();
        long = marker.getPosition().lng();

        latEl.value = lat;
        longEl.value = long;

        const response = await fetch(
            'https://geocode.arcgis.com/arcgis/rest/services/World/GeocodeServer/reverseGeocode?langCode=fr&f=pjson&featureTypes=&location='+long+','+lat);

        const data = await response.json();
        addressEl.value = data.address.Match_addr;

    })
}
