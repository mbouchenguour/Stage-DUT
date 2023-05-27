//Change la couleur du bouton au clique
document.querySelectorAll('a.btn').forEach(function(e) {
    e.addEventListener('click', function() {
        if(this.style.backgroundColor == "rgb(2, 137, 187)")
            this.style.backgroundColor = "white";
        else
        this.style.backgroundColor = "#0289bb";
    })
});


function deleteClient(x){
    
    $.ajax({
        type: "POST",
        url: '../Crud/deleteClient.php',
        data:{id:x},
        success:function(data) {
            location.reload();
        }
   });
}

function deleteService(x){
    
    $.ajax({
        type: "POST",
        url: '../Crud/deleteService.php',
        data:{id:x},
        success:function(data) {
            location.reload();
        }
   });
}

function deleteFormule(x){
    
    $.ajax({
        type: "POST",
        url: '../Crud/deleteFormule.php',
        data:{id:x},
        success:function(data) {
            location.reload();
        }
   });
}

function deleteHistorique(x){
    
    $.ajax({
        type: "POST",
        url: '../Crud/deleteHistorique.php',
        data:{id:x},
        success:function(data) {
            location.reload();
        }
   });
}

function modifyAssociation(x){
    location.href = "../Crud/modifyAssociation.php?id="+x;
}

function modifyParticulier(x){
    location.href = "../Crud/modifyParticulier.php?id="+x;
}

function modifyProfessionnel(x){
    location.href = "../Crud/modifyProfessionnel.php?id="+x;
}

function modifyService(x){
    location.href = "../Crud/modifyService.php?id="+x;
}

function updateFormule(x){
    location.href = "../Crud/updateFormule.php?id="+x;
}

function modifyFormule(x){
    location.href = "../Crud/modifyFormule.php?id="+x;
}

function modifyHistorique(x){
    location.href = "../Crud/modifyHistorique.php?id="+x;
}

function showMore(x){
    location.href = "../Page/profil.php?id="+x;
}