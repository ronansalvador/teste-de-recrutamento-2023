let inicio = '';
let fim = ''
const elementos = document.querySelectorAll('#history > *');
const dataInicio = document.getElementById('data-inicio');

const editDate = (data) => {
    console.log('data', data);
    var ano = parseInt(data.slice(0, 4));
    console.log('ano', ano)
    var mes = parseInt(data.slice(5, 7));
    console.log('mes', mes)
    var dia = parseInt(data.slice(8));
    console.log('dia', dia)
    
    var dataFormatada = `${dia}/${mes}/${ano}`
    console.log(dataFormatada)

    return dataFormatada;
}

dataInicio.addEventListener('change', function() {
	const data = dataInicio.value;
    inicio = editDate(data);
    filtrar();
});


const dataFim = document.getElementById('data-fim');
dataFim.addEventListener('change', function() {
	var data = dataFim.value;
    fim = editDate(data)
    filtrar();
});


const filtrar = () => {

    let history = document.querySelector('#history');
    const filteredHistory = [];
    let inicioObj = new Date(inicio);
    let fimObj = new Date(fim); 
    let inicioTime = inicioObj.getTime();            
    let fimTime = fimObj.getTime();

    if (inicioTime > fimTime) {
        history.innerHTML = '';
        let mensagem = document.createElement('p');
        mensagem.innerHTML = 'Data final não pode ser menor que a data inicial';                
        history.appendChild(mensagem);
        return
    }       

    if (inicio.length > 0 && fim.length > 0) {
        elementos.forEach((item) => {
            const dateAdded = item.getElementsByClassName('date_added')[0].innerHTML;
            console.log(dateAdded);     
            let dataObj = new Date(dateAdded);                    
            let dataTime = dataObj.getTime();          
            if (dataTime >= inicioTime && dataTime <= fimTime) {
                filteredHistory.push(item)
            }
        } )        
        history.innerHTML = '';        
        for (var i = 0; i < filteredHistory.length; i++) {
            history.appendChild(filteredHistory[i]);
        }
    }

}
