/**
 * Created by User on 22/07/2017.
 */

var marker = null;
var map = null;

function myMap() {
    var startCenter = new google.maps.LatLng(44.4264000, 8.9151900);
    var mapProp= {center: startCenter ,zoom:15,mapTypeControl: true,navigationControl: true,};
    map =new google.maps.Map(document.getElementById("googleMap"),mapProp);
    var geocoder = new google.maps.Geocoder();
    if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        map.setCenter(pos);
                        marker = new google.maps.Marker({
                        position: pos,
                        map: map,
                        draggable:true,
                        title:"Drag me!"
                    });
                    
                    
                    
              
                    google.maps.event.addListener(marker, 'dragend', function() {
                       
                        var xNew = marker.getPosition().lat();
                        var yNew = marker.getPosition().lng();
                        map.setCenter(marker.position); 
                        document.getElementById("lat").value = xNew;
                        document.getElementById("long").value = yNew;
                        document.getElementById("remBox").checked = false;
                        geocoder.geocode({'location': marker.position}, function(results, status) {
                            if (status === 'OK') {
                                if (results[0]) {
                                    document.getElementById('address').value = results[0].formatted_address;
                                }
                            }
                        });
                    });
                });
        }
        else{
            alert('La geo-localizzazione NON è possibile');
        }
}


function category(category){
        var temp = category.innerHTML;
            document.getElementById("categoria").value = temp;
        }
            
var x;
var y;
var poss;
    if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                    var geocoder_0 = new google.maps.Geocoder();
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    x = pos.lat;
                    y = pos.lng;
                    poss = pos;
                    geocoder_0.geocode({'location': poss}, function(results, status) {
                        if (status === 'OK') {
                            if (results[0]) {
                                document.getElementById('address').value = results[0].formatted_address;
                            }
                        }
                    });
                    document.getElementById("lat").value = x;
                    document.getElementById("long").value = y;
            });
        }
        
        else{
            alert('La geo-localizzazione NON è possibile');
        }
        


function unlock(check) {
    var geocoder_1 = new google.maps.Geocoder();
    if(check.checked) {
        document.getElementById("lat").value = x;
        document.getElementById("long").value = y;
        geocoder_1.geocode({'location': poss}, function(results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        document.getElementById('address').value = results[0].formatted_address;
                        }
                    }
                });
        var newPos = new google.maps.LatLng(x,y);
        map.setCenter(newPos);
        marker.setPosition(newPos);
        
        }
        else {
            document.getElementById("lat").value = "";
            document.getElementById("long").value = "";
            }
}

function find(){
    
    var address = document.getElementById('address').value;
    var geocoder_2 = new google.maps.Geocoder();
        geocoder_2.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            map.setCenter(results[0].geometry.location);
            marker.setPosition(results[0].geometry.location);
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });


}






