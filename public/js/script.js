function validateForm() {
    let x = document.forms["myForm"]["title"].value;
    let y = document.forms["myForm"]["ingredient"].value;
    let z = document.forms["myForm"]["process"].value;

     if (x.length == 0) {
        alert("Nezadal si nazov");
        return false;
     } else if (x.length < 5) {
        alert("Nadpis je prilis kratky...\n Zadaj aspon 5 znakov");
        return false;
    } else if (x.length > 40) {
        alert("Nadpis je prilis dlhy...\n Maximalny pocet znakov je 40");
        return false;
    } else if (y.length == 0) {
        alert("Nezadal si ingrediencie");
        return false;
    } else if (y.length < 10) {
        alert("Ingredienci je prilis malo");
        return false;
    } else if (z.length == 0) {
        alert("Nezadal si postup");
        return false;
    } else if (z.length < 10) {
        alert("Postup je prilis kratky");
        return false;
    } else {
        return true;
    }
}

