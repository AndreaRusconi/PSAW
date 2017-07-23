/**
 * Created by User on 22/07/2017.
 */
 var totMarker;
        
            function myMap() {
                        
                      
                        
                            var startCenter = new google.maps.LatLng(44.4264000, 8.9151900);
                            var mapProp= {zoom:13};
                            var map=new google.maps.Map(document.getElementById("googleMap_2"),mapProp);
                            var infowindow;
                            
                if(varSearch == 'null'){
                          if (navigator.geolocation) {
                
                                navigator.geolocation.getCurrentPosition(function(position) {
                                    
                                    var pos = {
                                        lat: position.coords.latitude,
                                        lng: position.coords.longitude
                                    };
                                    map.setCenter(pos);  
                                });
                            }
                            
                            else{
                                alert('La geo-localizzazione NON è possibile');
                                map.setCenter(startCenter);
                                }    
                        
                    }
                                      
                            
                            totMarker = new Array();
                            
                            
                        
                                for(let i in dati) {
                                    
                                var posMarker = new google.maps.LatLng(dati[i]['latitudine'],dati[i]['longitudine']);
                                marker = new google.maps.Marker({position:posMarker});
                                 
                                
                              
                                var string =
                                    '<div id="nuvola">' + 
                                        '<div id="nome_search">' + 
                                            '<h1>' + dati[i]["nome"] + '</h1>' + 
                                        '</div>' +
                                        '<div id="indirizzo">' +
                                            dati[i]['indirizzo'] +
                                        '</div>' +
                                        '<div id="descrizione_search">' + 
                                            '<p>' + dati[i]["descrizione"] + '</p>' + 
                                        '</div>'+
                                        
                                        '<div id="giorno_search">' + 
                                            dati[i]["giorno"] + 
                                        '</div>' +
                                        '<div id="ora_search">' + 
                                            dati[i]["ora"] +
                                        '</div>' +
                                        '<div id="user_search">' + 
                                            '<a href="generalProfile.php?var=' + dati[i]['user'] + '">' + dati[i]["user"]+ '</a>'  + 
                                        '</div>' +
                                        '<div id="forum_search">' + 
                                            '<a href="messages.php?var=' + dati[i]['nome'] + '">' + 'forum evento</a>' + 
                                        '</div>'+
                                    '</div>';
                                    
                                marker.infowindow = new google.maps.InfoWindow({
                                        content: string,
                                    });
                                    
                               
                                marker.setMap(map);
                                totMarker[i] = marker;
                                
                                if(dati[i]['nome'] == varSearch){
                                    marker.setAnimation(google.maps.Animation.BOUNCE);
                                    marker.infowindow.open(map, marker);
                                    map.setCenter(posMarker);
                                }    
                                    
                                    
                                showclick(marker);
                                
                                }
                
                            function showclick(data){    
                              
                                google.maps.event.addListener(data, 'click', function() {
                                
                                    for(var n = 0; n < totMarker.length ; n++){
                                
                                        totMarker[n].setAnimation(null);
                                        totMarker[n].infowindow.close();
                                    }
        
                             
                                map.setCenter(data.position);
                                data.setAnimation(google.maps.Animation.BOUNCE);
                                data.infowindow.open(map, data);
        
                             
                                });
                                }
                            
                
                          
        }
            
            
          function category(category){
                        var temp = category.innerHTML;
                        document.getElementById("categoria").value = temp;
                
                        for(var n = 0; n < dati.length ; n++){
                            
                            if(dati[n]['categoria'] != temp && temp != 'Tutti gli eventi'){
                               totMarker[n].setVisible(false);
                                totMarker[n].infowindow.close();
                            }
                            else
                                totMarker[n].setVisible(true);
                        
                    }
                 }
            
        
          
            