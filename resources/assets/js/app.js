require('./bootstrap');
require('./vue/main');

$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#app").toggleClass("toggled");
});


let btn = document.getElementById('selectAll');
if(btn !== null) {
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
}
let moreInfoBtns = document.querySelectorAll('.more-information-btn');

moreInfoBtns.forEach((btn) => {
    btn.addEventListener('click', (e) => {
        let body = e.target.parentNode.parentNode.querySelector('.card-body');
        if(btn.classList.contains('module-info')) {
            if(body.classList.contains('d-none')) {
                body.classList.remove('d-none');
            } else {
                body.classList.add('d-none');
            }
        }
        if (btn.classList.contains('block-info')) {
            let tbl = body.querySelector('table');
            if(tbl.classList.contains('d-none')) {
                tbl.classList.remove('d-none');
            } else {
                tbl.classList.add('d-none');
            }
        }
    })
});

