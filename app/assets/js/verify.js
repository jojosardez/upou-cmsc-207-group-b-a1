function getQueryParam(param) {
    var result = window.location.search.match(
        new RegExp("(\\?|&)" + param + "(\\[\\])?=([^&]*)")
    );

    return result ? result[3] : false;
}

ons.ready(function () {
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
            var header = document.createElement("h3")
            header.innerText = success
                ? 'Verification Success!'
                : 'Verification Failed!';
            var label = document.createElement("label")
            label.innerHTML = "<br/><br/>" + result['message'];
            var container = document.getElementById('message');
            container.appendChild(header);
            container.appendChild(label);
        },
        contentType: 'application/json; charset=utf-8',
        dataType: 'json'
    });
});