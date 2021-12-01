function isValid(regForm) {
    const username = regForm.usrName.value;
    const password = regForm.password.value;
    const email = regForm.email.value;

    if (username == "" || password == "" || email == "") {
        document.getElementById("message").innerHTML = "Please fill up the form properly";
        return false;
    }
    return true;
}

function isValid(login) {
    const username = login.usrName.value;
    const password = login.password.value;
   
    if (username == "" || password == "") {
        document.getElementById("message").innerHTML = "Please fill up the form properly";
        return false;
    }
    return true;
}
