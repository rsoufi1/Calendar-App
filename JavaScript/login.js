window.onload = function() {
    document.getElementById("createNewAccount").addEventListener('click', createNewAccount);
    document.getElementById("login").addEventListener('click', checkPasswords);

    var form = document.getElementById("loginForm");
    function handleForm(event) { event.preventDefault(); } 
    form.addEventListener('submit', handleForm);
}

function createNewAccount(){
    location.href = "../Pages/createNewAccount.php";
}

function checkPasswords(){
    //Check if username and password match 
    var userID = $('#username').val();
    var password = $('#password').val();

    $.ajax({
        method: "POST",
        url: "../PHP/login.php",
        data: { 
            userID: userID,
            password: password
        }
      }).done(function( response ) {
        console.log(response);
        if(response == false){
            alert("incorrect username or password");
            document.getElementById("username").style.backgroundColor = "#fcc2c2";
            document.getElementById("password").style.backgroundColor = "#fcc2c2";
        } else {
            //redirect to home page
            location.href = "../Pages/calendar.php";
        }
      });
}