document.getElementById('nomeInfo').innerHTML = datiPersonali[0]['nome'];
document.getElementById('cognome').innerHTML = datiPersonali[0]['cognome'];
document.getElementById('email').innerHTML = datiPersonali[0]['email'];
document.getElementById('citta').innerHTML = datiPersonali[0]['citta'];

var table = document.getElementById('tabellaEventi');
var tbody = table.getElementsByTagName('tbody')[0];
for(let i in dati) {         
            var tr = document.createElement('tr');
            var td = document.createElement('td');
    
            td.setAttribute('class','datiTabella');
            
            var tx = dati[i]['nome'];
            var a = document.createElement('a');
    
            a.innerHTML=tx;
 
            if(tx == 'nessun evento condiviso'){
                td.setAttribute('id','noEvent'); 
            }
            else{
                if(document.getElementById('noEvent')){
                    document.getElementById('noEvent').parentNode.removeChild(document.getElementById('noEvent'));
                }
                td.setAttribute('id','siEvent');
                a.setAttribute('href', 'search.php?var=' + dati[i]['nome']);
            }
            
            td.appendChild(a);
            tr.appendChild(td);
            tbody.appendChild(tr);
}


if(!remove){    
    document.getElementById('datiDaRimuovere').parentNode.removeChild(document.getElementById('datiDaRimuovere'));
    document.getElementById('to_modifica').parentNode.removeChild(document.getElementById('to_modifica'));
    
}