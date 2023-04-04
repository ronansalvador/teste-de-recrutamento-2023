// seleciona o elemento "select"
const selectElement = document.querySelector('select');

// adiciona um event listener para o evento "change"
selectElement.addEventListener('change', function() {
  // obtém a opção selecionada
  const selectedOption = selectElement.selectedOptions[0];

  // obtém o valor do atributo "id" da opção selecionada
  const id = selectedOption.id;

  // faz algo com o valor do atributo "id", por exemplo, exibe-o no console
  console.log(id);
  //window.location.href = `/account/seller/transfer/add?account=${id}`;
});

  
   
