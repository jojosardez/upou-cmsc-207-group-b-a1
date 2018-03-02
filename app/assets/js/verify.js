var pageInitialized = false;

document.addEventListener("init", function (event) {
    if (pageInitialized) return;
    pageInitialized = true;
    verifyAccount();
});

var getQueryParam = function (param) {
    var result = window.location.search.match(
        new RegExp("(\\?|&)" + param + "(\\[\\])?=([^&]*)")
    );
    return result ? result[3] : false;
}

var verifyAccount = function () {
    showModal();
    var encodedUsername = getQueryParam('u');
    var token = getQueryParam('t');

    $.ajax({
        type: 'POST',
        url: '/api/verify.php',
        data: JSON.stringify({
            encodedUsername: encodedUsername,
            token: token
        }),
        success: function (result) {
            var success = result['success'] === true;
            var errorcode = result['errorcode'];
            hideModal();
            var header = document.createElement("h3")
            header.innerText = success
                ? 'Verification Success!'
                : errorcode === 1
                    ? 'Verification Failed!'
                    : 'Error encountered:';
            var label = document.createElement("label")
            label.innerHTML = '<br/><br/>' + result['message'] + '<br/><br/>';
            var container = document.getElementById('message');
            container.appendChild(header);
            container.appendChild(label);
            if (success) {
                var loginButton = document.createElement('ons-button');
                loginButton.setAttribute('onclick', "location.href = '../app/login.php'");
                loginButton.innerHTML = "Login";
                container.appendChild(loginButton);
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