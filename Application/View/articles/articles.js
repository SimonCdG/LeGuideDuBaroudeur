function extend() {
    document.getElementById('delete-button').value = "Vous êtes sûr de vouloir supprimer l’article ?";
    document.getElementById('delete-button').classList.add('delete-button-extended');
    document.getElementById('delete-button').classList.remove('delete-button');
    document.getElementById('delete-submit').classList.add('delete-submit');
    document.getElementById('delete-submit').classList.remove('delete-submit-hidden');
    document.getElementById('cancel-button').classList.add('cancel-button');
    document.getElementById('cancel-button').classList.remove('cancel-button-hidden');
    document.getElementById('button-container').classList.add('button-container-extended');
    document.getElementById('button-container').classList.remove('button-container');
}

function smaller() {
    document.getElementById('delete-button').value = "Supprimer";
    document.getElementById('delete-button').classList.add('delete-button');
    document.getElementById('delete-button').classList.remove('delete-button-extended');
    document.getElementById('delete-submit').classList.add('delete-submit-hidden');
    document.getElementById('delete-submit').classList.remove('delete-submit');
    document.getElementById('cancel-button').classList.add('cancel-button-hidden');
    document.getElementById('cancel-button').classList.remove('cancel-button');
    document.getElementById('button-container').classList.add('button-container');
    document.getElementById('button-container').classList.remove('button-container-extended');
}