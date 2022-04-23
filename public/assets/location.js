function initMap() {
    const myLatLng = { lat: 36.858, lng: 10.196};
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 11,
        center: myLatLng,
    });

    new google.maps.Marker({
        position: myLatLng,
        map,
        title: "Hello World!",
    });
}

window.initMap = initMap;
