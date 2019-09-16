$(document).ready( function () {
    $("#updateStudent").on('submit', function (e) {
        e.preventDefault();
        var id = $("#id").val();
        var firstName = $("#firstName").val();
        var lastName = $("#lastName").val();
        var bday = $("#bday").val();
        var courseKey = $("#class option:selected").val();
        var course = $("#class option:selected").text();

        $.ajax({
            type: "post",
            url: "ajax_student.php",
            data:
                {
                    first: firstName,
                    last: lastName,
                    birth: bday,
                    class: courseKey,
                    studentID: id
                },
            dataType: "json",
            success: function (data) {
                // $(".studentOutputTable").prepend('' +
                //     '<tr>' +
                //     '<td class="last">'+lastName+'</td>' +
                //     '<td class="first">'+firstName+'</td>' +
                //     '<td class="birth">'+bday+'</td>' +
                //     '<td><a href="newGrade.php?id='+id+'&class='+course+'">Noten für '+firstName + lastName+' eintragen</a></td>' +
                //     '</tr>');
                console.log(data);
            }
        })
    })
});