$('#submitButton').on('click',function(e){
    e.preventDefault();
    var email = $("#emailInput").val();
    var password = $("#passwordInput").val();

    if(email==''){
        $('#emailInput').after("<p id='emailMsg' style='color:red'>Please enter your Email!</p>");
        setTimeout(function(){
            document.getElementById("emailMsg").innerHTML = '';
        }, 2000);
    }else if(password==''){
        $('#passwordInput').after("<p id='passwdMsg' style='color:red'>Please enter your Password!</p>");
        setTimeout(function(){
            document.getElementById("passwdMsg").innerHTML = '';
        }, 2000);
    }else{
    $.ajax({
      url: "../php/loginHandler.php",
      type: "POST",
      data: {email: email,
            password: password
            },
      dataType: "json",
      success: function(data) {
        if(data.status == 'success'){
            $('#submitButton').after("<p style='color:green'>Welcome Back!<br>Redirecting you soon!</p>")
            setTimeout(function(){ window.location.href = "../php/myOrders.php"; }, 3000);
        }else if(data.status == 'error_login_failed'){
            alert("Wrong email & password combination!");
        }
      }
    
    });
    return false;
}
});