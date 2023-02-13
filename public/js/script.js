// funkcie na vymazanie kometnarov a receptov
function deleteComment(id) {
    let xhr = new XMLHttpRequest();
    xhr.onload = function() {
        if (xhr.status === 200) {
            let json = JSON.parse(xhr.responseText);
            if (json.e) {
                console.log(json.e);
                return;
            }
            let divToRemove = document.querySelector("div#com-" + json.comment);
            divToRemove.remove();
        } else {
            console.error(xhr.responseText);
        }
    };

    xhr.open("POST", "http://localhost/?c=comments&a=delete", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send('id=' + id);
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

// funkcia ktora zobrazi moznost na vkladanie kategorii
function showAddTypeForm() {
    document.getElementById('addTypeForm').style.display = "block";
    document.getElementById('addType').style.display = "none";
}

// funkcia na zobrazenie editovaneho komentara
function showEditWindow(id) {
   let xhr = new XMLHttpRequest();
    xhr.onload = function() {
        if (xhr.status === 200) {
            let json = JSON.parse(xhr.responseText);
            if (json.e) {
                console.log(json.e);
                return;
            }
            document.getElementById('placeToEdit-' + id).innerHTML = json.comment.text;
            document.getElementById('commentEditArea-' + id).style.display = "block";
            document.getElementById('commentArea-' + id).style.display = "none";

        } else {
            console.error(xhr.responseText);
        }
    };
    xhr.open("POST", "http://localhost/?c=comments&a=edit", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send('id=' + id);
}

// funkcia na kontrolu, ci uz pouzivatel s danym loginom neexistuje
function checkLogin(str) {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
        if (xmlhttp.status === 200) {
            let json = JSON.parse(xmlhttp.responseText);
            if (json.e) {
                console.log(json.e);
                return;
            }
            document.getElementById("txtLogin").innerHTML = json.message;

            if (json.message !== "") {
                document.getElementById("login").style.border = "2px solid red";
            } else {
                document.getElementById("login").style.border = "1px black";
            }
        } else {
            console.error(xmlhttp.responseText);
        }

    };
    xmlhttp.open("POST", "http://localhost/?c=auth&a=checkLogin",true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send('str=' + str);
}