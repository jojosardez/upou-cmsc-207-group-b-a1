var pageInitialized = false;

document.addEventListener("init", function (event) {
    if (pageInitialized) return;
    pageInitialized = true;
    verifyReset();
});

var getQueryParam = function (param) {
    var result = window.location.search.match(
        new RegExp("(\\?|&)" + param + "(\\[\\])?=([^&]*)")
    );
    return result ? result[3] : false;
}

var verifyReset = function () {
    showModal();
    var encodedUsername = getQueryParam('u');
    var token = getQueryParam('t');

    $.ajax({
        type: 'POST',
        url: '../api/resetVerify.php',
        data: JSON.stringify({
            encodedUsername: encodedUsername,
            token: token
        }),
        success: function (result) {
            var success = result['success'] === true;
            hideModal();

            ons.notification.alert(
                result['message'],
                {
                    title: success
                        ? 'Reset Password'
                        : 'Error encountered:'
                });

            if (!success) {
                var resetInput = document.getElementById("resetInput");
                resetInput.style.display = 'none';
            }
        },
        error: function (xhr) {
            hideModal();
            console.log(xhr);
        },
        contentType: 'application/json; charset=utf-8',
        dataType: 'json'
    });
}

var reset = function () {
    showModal();
    var encodedUsername = getQueryParam('u');
    var password = document.getElementById('password').value;
    var repeatPassword = document.getElementById('repeatPassword').value;

    if (validateInput(password, repeatPassword)) {
        resetPassword(encodedUsername, password);
    }
};

var validateInput = function (password, repeatPassword) {
    var errorMessage = "";
    if (password === "") {
        errorMessage = "Password should not be empty.";
    }
    else if (password.length < 5 || password.length > 50) {
        errorMessage = "Password must be between 5 and 50 characters in length.";
    }
    else if (repeatPassword === "") {
        errorMessage = "Repeat password should not be empty.";
    }
    else if (password != repeatPassword) {
        errorMessage = "Passwords provided should match.";
    }

    if (errorMessage === "") {
        return true;
    }
    else {
        hideModal();
        ons.notification.alert(errorMessage, { title: "Invalid Input!" });
        return false;
    }
}

var resetPassword = function (encodedUsername, password) {
    $.ajax({
        type: 'POST',
        url: '../api/resetSave.php',
        data: JSON.stringify({
            encodedUsername: encodedUsername,
            password: password
        }),
        success: function (result) {
            var success = result['success'] === true;
            hideModal();
            ons.notification.alert(
                result['message'],
                {
                    title: success
                        ? 'Password Reset Success!'
                        : 'Password Reset Failed!',
                    callback: function () {
                        if (success) {
                            document.location.href = "../app/login.php";
                        }
                    }
                });
        },
        error: function (xhr) {
            hideModal();
            console.log(xhr);
        },
        contentType: 'application/json; charset=utf-8',
        dataType: 'json'
    });
}