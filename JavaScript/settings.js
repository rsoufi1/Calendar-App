$(document).ready(function() {
    $("#addFriendButton").click(function() {
        $("#addFriendModal").css('display', 'block');
    });

    $("#submitFriendId").click(function() {
        //Get the input
        var friendID = $("#friendID").val();
        console.log(friendID);

        //make Ajax call with friendID as input
        //if the ID is valid, friend is added
        //otherwise, display an error
        $.ajax({
            method: "POST",
            url: "../PHP/settings_AddFriend.php",
            data: { 
                friendID: friendID
            }
          }).done(function( response ) {
            console.log(response);
            $("#addFriendModal").css('display', 'none');
          });

    });

});