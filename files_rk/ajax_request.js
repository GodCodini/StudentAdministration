/*
function requestNodeInfo(){
    var nodeRequestType = document.getElementById("test").value;
    alert(nodeRequestType);
}
*/

function requestNodeInfo() {
    var getNodeNumber = document.getElementByID("showSpecificNode").value;

    jQuery.ajax({
        type: "POST",
        url: "ajax_process.php",
        data: {
            node_Number: getNodeNumber
        }
    }).done(function(){
        alert("worked");
    })
}