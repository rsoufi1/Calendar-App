window.onload = function() {
    document.getElementById("createNewAccountBtn").addEventListener('click', createNewAccount);
    console.log("loaded");

    var form = document.getElementById("createNewEventForm");
    function handleForm(event) { event.preventDefault(); } 
    form.addEventListener('submit', handleForm);
}

function createNewAccount(){
    console.log("created");

    var username = $('#name').val();
    var userID = $('#username').val();
    var password = $('#password').val();

    $.ajax({
        method: "POST",
        url: "../PHP/createNewAccount.php",
        data: { 
            userName: username,
            userID: userID,
            password: password
        }
      }).done(function( response ) {
        console.log(response);
        if(response == false){
            alert("the user id you entered already exists");
            document.getElementById("username").style.backgroundColor = "#fcc2c2";
        } else {
            //redirect to home page
            location.href = "../Pages/calendar.php";
        }
      });
}
