document.addEventListener("init", function (event) {
    var list = document.getElementById('usersList');

    if (list) {
        $.ajax({
            type: "GET",
            url: "/api/admin.php",
            success: function (result) {
                for (var i = 0; i < result.length; i++) {
                    var onsItem = document.createElement('ons-list-item');
                    onsItem.setAttribute('modifier', "chevron");
                    onsItem.setAttribute('onclick', "functionName()");
                    onsItem.innerHTML = result[i]['username'] + ' (' + result[i]['email'] + ')';
                    list.appendChild(onsItem);
                }
            },
            dataType: "json"
        });
    }
});