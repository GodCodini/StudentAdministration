function nodeElement() {

    $.ajax({
        url: "index.php",
        cache: false,
        type: "post",
        data: {
            submit: 'submit',
            data: $("#name").data('value')},
        success: function (result, success) {

            console.log(result);
            console.log(success);
            console.log('success');
        },
        error: function (xhr, status, error) {
            var err = JSON.parse(xhr.responseText);
            alert(err.Message);
        }
    });
}

function listElement() {

    $.ajax({
        url: "index.php",
        cache: false,
        type: "post",
        data: { data: $("#name").data('value')},
        success: function (result, success) {

            console.log(result);
            console.log(success);
            console.log('success');
        },
        error: function (result, error) {
            console.log(result);
            console.log(error);
            console.log('error');
        }
    });
}

$(document).ajaxError(function(e, xhr, opt){
    alert("Error requesting " + opt.url + ": " + xhr.status + " " + xhr.statusText);
});