let checked = false;
document.getElementById('checkAll').addEventListener("click", () =>{
    const checkBoxs = document.querySelectorAll('input[type="checkbox"]');
    if(!checked){
        for(let i = 0; i<checkBoxs.length; i++){
            checkBoxs[i].checked =true;
        }
        checked = true
    }else{
        for(let i = 0; i<checkBoxs.length; i++){
            checkBoxs[i].checked =false;
        }
        checked = false

    }
})