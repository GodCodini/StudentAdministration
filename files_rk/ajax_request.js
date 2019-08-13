// create new class

jQuery(document).ready(function() {
    jQuery('.submitNeueKlasse').click(function (e) {
        e.preventDefault();

       // jQuery('.takeDump').remove();

        var klassenbezeichnung = jQuery('.neueKlasseInput').val();
        var notenschluesselFK = jQuery('.dropDownKlasse option:selected').val();
        var notenschluessel = jQuery('.dropDownKlasse option:selected').text();

        jQuery.ajax({
            method: "POST",
            url: "ajax_process.php",
            data: {
                klassenbezeichnung_data: klassenbezeichnung,
                notenschluesselFK_data: notenschluesselFK,
            },
            dataType: "json",
            success: function () {
                jQuery(".klassenTabelle").append('<tr class="klassenUebersicht"><td>'+klassenbezeichnung+'</td><td>'+notenschluessel+'</td></tr>');
                location.reload();
            }
        })
    });
});


// create new Student
/*
jQuery(document).ready(function() {
    jQuery('.formElement').on('submit', function (e) {

        e.preventDefault();

        var myType = jQuery(e.target).attr('id');

        var schuelerVorname = jQuery('.schuelerVornameInput').val();
        var schuelerNachname = jQuery('.schuelerNachnameInput').val();
        var schuelerGeburtsdatum = jQuery('.schuelerGeburtsdatumInput').val();
        var schuelerEMail = jQuery('.schuelerEMailInput').val();
        var schuelerKlasseFK = jQuery('.schuelerKlasseInput option:selected').val();

        jQuery.ajax({
            type: "post",
            url: "ajax_process_student.php",
            data: jQuery('.formElement').serialize()+'&myType='+myType,
                /*{
                schuelerVorname_data: schuelerVorname,
                schuelerNachname_data: schuelerNachname,
                schuelerGeburtsdatum_data: schuelerGeburtsdatum,
                schuelerEMail_data: schuelerEMail,
                schuelerKlasseFK_data: schuelerKlasseFK,
                schuelerKlasse_data: schuelerKlasse
                },
            dataType: "json",
            success: function (data) {
                console.log(data);

                console.log(typeof (data));

                jQuery(".studentTable").append('' +
                    '<tr class="studentUebersicht">' +
                        '<td>'+schuelerVorname+'</td>' +
                        '<td>'+schuelerNachname+'</td>' +
                        '<td>'+schuelerGeburtsdatum+'</td>' +
                        '<td>'+schuelerEMail+'</td>' +
                        '<td>'+dropDownItem+'</td>' +
                    '</tr>');
            }
        })
    });
});
*/

// create new dynamic Output
jQuery(document).ready(function() {
    jQuery('.formElement').on('submit', function (e) {

        e.preventDefault();

        var myType = jQuery(e.target).attr('id');

        var dropDownItem = jQuery('.dropDownItem option:selected').text();

        jQuery.ajax({
            type: "post",
            url: "ajax_process_student.php",
            data: jQuery('.formElement').serialize()+'&myType='+myType,
            success: function (data) {
                var output = data.replace(/[^a-z0-9\s,]/gi, '').split(',');

                console.log(output);

                // CREATE TABLE OF OUTPUT AS EX BELOW

/*
                jQuery(".studentTable").append('' +
                    '<tr class="studentUebersicht">' +
                    '<td>'+schuelerVorname+'</td>' +
                    '<td>'+schuelerNachname+'</td>' +
                    '<td>'+schuelerGeburtsdatum+'</td>' +
                    '<td>'+schuelerEMail+'</td>' +
                    '<td>'+dropDownItem+'</td>' +
                    '</tr>');*/
            }
        })
    });
});