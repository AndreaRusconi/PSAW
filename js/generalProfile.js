/**
 * Created by User on 22/07/2017.
 */
    
  
   
            document.getElementById('nomeInfo').innerHTML = datiPersonali[0]['nome'];
            document.getElementById('cognome').innerHTML = datiPersonali[0]['cognome'];
            document.getElementById('email').innerHTML = datiPersonali[0]['email'];
            document.getElementById('citta').innerHTML = datiPersonali[0]['citta'];
    
    
    
            
          
          

	     var table = document.getElementById('tabellaEventi');

	     var tbody = table.getElementsByTagName('tbody')[0];

	    
        for(let i in dati) { 
        
            var tr = document.createElement('tr');
            
            var td_0 = document.createElement('td');
            
            td_0.setAttribute('class','datiTabella');
            
            var tx_0 = dati[i]['nome'];
            
            var a_0 = document.createElement('a');
            
            a_0.innerHTML=tx_0;
            a_0.setAttribute('href', 'search.php?var=' + dati[i]['nome']);
            
            td_0.appendChild(a_0);
            
            tr.appendChild(td_0);
            
            tbody.appendChild(tr);
	    
        }


