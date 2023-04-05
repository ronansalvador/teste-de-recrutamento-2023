function submitForm() {
  console.log('clicou no botao')
  var form = document.getElementById("add_account");
  var formData = new FormData(form);
  console.log(formData);
  var selectTypeAccount = document.getElementById("type_account");
  console.log(selectTypeAccount);
  var typeAccount = selectTypeAccount.options[selectTypeAccount.selectedIndex].id;
  console.log(typeAccount);

 
}