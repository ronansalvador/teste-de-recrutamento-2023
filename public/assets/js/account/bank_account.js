const edit = document.getElementsByClassName('edit_account');
const remove = document.getElementsByClassName('remove_account');
console.log(remove);

for (let i = 0; i < edit.length; i++) {
    edit[i].addEventListener('click', function() {
            
      window.location.href = `bankaccount/edit?account=${edit[i].id}`;
      alert(`Uma conta bancária só pode ser deletada, se ela não foi utilizada em nenhuma transferência!`);
      
    });
}

for (let i = 0; i < remove.length; i++) {
    remove[i].addEventListener('click', function() {
    window.location.href = `bankaccount/delete?account=${edit[i].id}`;
        
      alert(`Uma conta bancária só pode ser deletada, se ela não foi utilizada em nenhuma transferência!`);
    });
}