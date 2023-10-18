/*
document.body.onload = function() {
clientID = yaCounter38176370.getClientID();
window.clientID = clientID;
console.log('METKIKA: '+ clientID);

region = ymaps.geolocation.region;
country = ymaps.geolocation.country;
window.city = ymaps.geolocation.city;
console.log('city: '+ window.city);
}
*/

$(document).ready(function() {

    clientID = yaCounter38176370.getClientID();
    window.clientID = clientID;
    console.log('METKIKA: '+ clientID);

    $.ajax({
        type: "GET",
        url: "/actions/pool-voting/show-form?client_id="+clientID,
        success: function (data) {
            if (data) {
                // подгрузка стилей
                $('head').append('<link rel="stylesheet" type="text/css" href="/old_theme/css/modules/pool-voting/pool-voting.css">');

                // подгрузка html
                $('body').append(data);
                // подгрузка js
                $('body').append('<script src="/old_theme/js/modules/pool-voting/pool-voting.js"></script>');
            }

        }
    });

    /*
    var supportsES6 = function() {
        try {
            new Function("(a = 0) => a");
            return true;
        }
        catch (err) {
            return false;
        }
    }();
    */


    if (YMaps.location) {
        //console.log("Longitude: " + YMaps.location.longitude); // Выведем долготу
        //console.log("Latitude: " + YMaps.location.latitude);   // Выведем широту
        //$(".country").val(YMaps.location.country); // Достанем в input страну
        window.city = YMaps.location.city;   // Достанем в input регион (область)
        console.log('city: '+ window.city);
    }
});