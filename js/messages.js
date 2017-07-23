/**
 * Created by User on 22/07/2017.
 */

	     var table = document.getElementById('tabella');

	     var tbody = table.getElementsByTagName('tbody')[0];

	   
        for(let i in dati) { 
    

            var tr = document.createElement('tr');
            
            var td_0 = document.createElement('td');
            var td_1 = document.createElement('td');
            
            td_0.setAttribute('class','linea');
	        td_1.setAttribute('class','linea');
            
            var tx_0 = dati[i]['mittente'];
            var tx_1 = dati[i]['messaggio'];
            
            var a_0 = document.createElement('a');
            
            a_0.innerHTML=tx_0;
            
            if(tx_0 == 'admin'){
                td_0.setAttribute('id','adminMit');
                td_1.setAttribute('id','adminMes');
                
            }
            else{
                if(document.getElementById('adminMit')){
                    document.getElementById('adminMit').parentNode.removeChild(document.getElementById('adminMit'));
                    document.getElementById('adminMes').parentNode.removeChild(document.getElementById('adminMes'));
                }
                td_0.setAttribute('id','mitt');
                a_0.setAttribute('href', 'generalProfile.php?var=' + dati[i]['mittente']);
            }
            
            
            td_0.appendChild(a_0);
            td_1.innerHTML=tx_1;
            
           
             
            tr.appendChild(td_1);
            tr.appendChild(td_0);
            
            tbody.appendChild(tr);
	    
        }
