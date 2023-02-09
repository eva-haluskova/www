function deleteComment(id) {
    let xhr = new XMLHttpRequest();
    xhr.onload = function() { // vykona sa ked je prijaty http reqest zo servera
        if (xhr.status === 200) { // ak je status http odpovede = 200, teda je okej
            let json = JSON.parse(xhr.responseText); // vytvorim si premennu v ktorej je json
            if (json.e) { // ak ma jeon chybu, vypise sa
                console.log(json.e);
                return;
            }
            let divToRemove = document.querySelector("div#com-" + json.comment); // ulozim si do premennej divko na vymazanie
            divToRemove.remove(); // vymazem ho
        } else {
            console.error(xhr.responseText); // ak status http odpovede nie je 200, cize cosi je spatne
        }
    };

    // async: true - oznacuje funkciu, v ktorej bude asynchornne volanie
    // htto post request
    xhr.open("POST", "http://localhost/?c=comments&a=delete", true);
    //xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send('id=' + id); // posle reqesty na server s ideckom komentu na vymazanie
}

function deleteRecipe(id) {
    let xhr = new XMLHttpRequest();
    xhr.onload = function() {
        if (xhr.status === 200) {
            let json = JSON.parse(xhr.responseText);
            if (json.e) {
                console.log(json.e);
                return;
            }
            let divToRemove = document.querySelector("div#rec-" + json.recipe);
            divToRemove.remove();
        } else {
            console.error(xhr.responseText);
        }
    };

    xhr.open("POST", "http://localhost/?c=recipes&a=delete", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send('id=' + id);
}

function deleteType(id) {
    let xhr = new XMLHttpRequest();
    xhr.onload = function() {
        if (xhr.status === 200) {
            let json = JSON.parse(xhr.responseText);
            if (json.e) {
                console.log(json.e);
                return;
            }
            let divToRemove = document.querySelector("div#typ-" + json.type);
            divToRemove.remove();
        } else {
            console.error(xhr.responseText);
        }
    };

    xhr.open("POST", "http://localhost/?c=types&a=delete", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send('id=' + id);
}


function showAddTypeForm() {
    document.getElementById('addTypeForm').style.display = "block";
    document.getElementById('addType').style.display = "none";
}

function hideAddTypeForm() {
    document.getElementById('addTypeForm').style.display = "none";
    document.getElementById('addType').style.display = "block";
}
