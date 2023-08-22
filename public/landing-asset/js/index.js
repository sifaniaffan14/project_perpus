let getCurrentYear = new Date().getFullYear()
document.getElementById('currenYear').innerHTML = getCurrentYear

function myFunction() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
