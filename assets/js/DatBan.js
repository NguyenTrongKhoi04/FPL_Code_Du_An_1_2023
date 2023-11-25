
let ban = document.querySelectorAll(".ban_check")

for(let i = 0; i< ban.length; i++){
    ban[i].addEventListener("click", (e) => {
        for(let i = 0; i< ban.length; i++){
            if(ban[i].getAttribute("allow") != "false" && ban[i] != e.target){
                ban[i].checked = false
                ban[i].setAttribute("disabled", "")
            }
        }
        // khi bỏ tích
        if(e.target.checked == false){
            for(let i = 0; i< ban.length; i++){
                if(ban[i].getAttribute("allow") != "false" && ban[i] != e.target){
                    ban[i].removeAttribute("disabled")
                }
            }
        }
    })
}

document.getElementById("btn_remore").addEventListener("click", () => {
    for(let i = 0; i< ban.length; i++){
        if(ban[i].getAttribute("allow") != "false"){
            if(ban[i].checked == true){
                ban[i].checked = false
            }
            ban[i].removeAttribute("disabled")
        }
    }
})

