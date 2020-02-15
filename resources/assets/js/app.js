require('./bootstrap');
require('./vue/main');

$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#app").toggleClass("toggled");
});


let btn = document.getElementById('selectAll');
btn.addEventListener("click", () => {
    console.log(btn.checked);
    let checkboxes = document.getElementsByClassName('form-check');
    for (let i = 0; i < checkboxes.length - 1;  i++){
        if(btn.checked){
            document.getElementById('selectAll-label').innerText = "Deselect All";
            checkboxes[i].checked = true;
        } else {
            document.getElementById('selectAll-label').innerText = "Select All";
            checkboxes[i].checked = false;
        }

    }
});
