function cache(val){
   document.getElementById("status-select").disabled = true;
    if (val == "utilisateur")
   document.getElementsByClassName("register-club-form")[0].style.visibility= "visible"
    if (val == "club")
      document.getElementsByClassName("register-user-form")[0].style.visibility= "visible"
}