// add new class
jQuery(document).ready(function() {
    jQuery('.newClassForm').click(function (e) {
        e.preventDefault();

        var klassenbezeichnung = jQuery('.neueKlasseInput').val();
        var notenschluesselFK = jQuery('#notenSchluesselTyp option:selected').val();
        var notenschluessel = jQuery('#notenSchluesselTyp option:selected').text();

        jQuery.ajax({
            method: "POST",
            url: "ajax_process_newClass.php",
            data: {
                klassenbezeichnung_data: klassenbezeichnung,
                notenschluesselFK_data: notenschluesselFK,
            },
            dataType: "json",
            success: function () {
                jQuery(".classOutputTable").prepend('' +
                    '<tr class="klassenUebersicht" style="background-color: var(--softAccentColor)">' +
                        '<td>'+klassenbezeichnung+'</td>' +
                        '<td>'+notenschluessel+'</td>' +
                    '</tr>');
            }
        })
    });
});

// add new student
jQuery(document).ready(function() {
    jQuery('.newStudentForm').on('submit', function (e) {

        e.preventDefault();

        //var studentID = jQuery('#studentID').val();
        var schuelerVorname = jQuery('.schuelerVornameInput').val();
        var schuelerNachname = jQuery('.schuelerNachnameInput').val();
        var schuelerGeburtsdatum = jQuery('.schuelerGeburtsdatumInput').val();
        var schuelerEMail = jQuery('.schuelerEMailInput').val();
        var schuelerKlasseFKval = jQuery('.schuelerKlasseInput option:selected').val();
        var schuelerKlasseFKtext = jQuery('.schuelerKlasseInput option:selected').text();
        console.log(schuelerKlasseFKtext);

        jQuery.ajax({
            type: "post",
            url: "ajax_process_newStudent.php",
            data:
                {
                schuelerVorname_data: schuelerVorname,
                schuelerNachname_data: schuelerNachname,
                schuelerGeburtsdatum_data: schuelerGeburtsdatum,
                schuelerEMail_data: schuelerEMail,
                schuelerKlasseFK_data: schuelerKlasseFKval,
                },
            dataType: "json",
            success: function (studentID) {
                jQuery(".studentOutputTable").prepend('' +
                    '<tr class="studentUebersicht studentRow" style="background-color: var(--softAccentColor)">' +
                        '<td class="hiddenElement studentID">' + studentID + '</td>' +
                        '<td class="schuelerVorname">'+schuelerVorname+'</td>' +
                        '<td class="schuelerNachname">'+schuelerNachname+'</td>' +
                        '<td class="schuelerGeburtsdatum">'+schuelerGeburtsdatum+'</td>' +
                        '<td class="schuelerEmail">'+schuelerEMail+'</td>' +
                        '<td class="schuelerKlasse" id="'+schuelerKlasseFKval+'">'+schuelerKlasseFKtext+'</td>' +
                    '</tr>');
            }
        })
    });
});

//update existing student
jQuery(document).ready(function () {

    jQuery('.updateStudentForm').on('submit', function (e) {

        if (window.updateNeeded == true) {

            e.preventDefault();

            var studentID = jQuery('#EDITschuelerID').val();
            var schuelerVorname = jQuery('#EDITschuelerVorname').val();
            var schuelerNachname = jQuery('#EDITschuelerNachname').val();
            var schuelerGeburtsdatum = jQuery('#EDITschuelerGeburtsdatum').val();
            var schuelerEMail = jQuery('#EDITschuelerEMail').val();
            var schuelerKlasseFKval = jQuery('#EDITschuelerKlasse option:selected').val();
            var schuelerKlasseFKtext = jQuery('#EDITschuelerKlasse option:selected').text();

            jQuery.ajax({
                type: "post",
                url: "ajax_process_updateStudent.php",
                data:
                    {
                        studentID_data: studentID,
                        schuelerVorname_data: schuelerVorname,
                        schuelerNachname_data: schuelerNachname,
                        schuelerGeburtsdatum_data: schuelerGeburtsdatum,
                        schuelerEMail_data: schuelerEMail,
                        schuelerKlasseFK_data: schuelerKlasseFKval,
                    },
                dataType: "json",
                success: function (data) {
                    jQuery("#activeElement").remove();
                    jQuery("#editRecord").dialog("close");

                    jQuery(".studentOutputTable").prepend('' +
                        '<tr class="studentUebersicht studentRow" style="background-color: var(--softAccentColor)">' +
                        '<td class="hiddenElement studentID">' + studentID + '</td>' +
                        '<td class="schuelerVorname">' + schuelerVorname + '</td>' +
                        '<td class="schuelerNachname">' + schuelerNachname + '</td>' +
                        '<td class="schuelerGeburtsdatum">' + schuelerGeburtsdatum + '</td>' +
                        '<td class="schuelerEmail">' + schuelerEMail + '</td>' +
                        '<td class="schuelerKlasse" id="' + schuelerKlasseFKval + '">' + schuelerKlasseFKtext + '</td>' +
                        '</tr>');
                }
            })
        } else {
            e.preventDefault();
            jQuery("#editRecord").dialog("close");
        }
    });
});

//delete existing student
jQuery(document).ready(function() {
    jQuery('.updateStudentForm').on('click', '.deleteButton', function (e) {

        e.preventDefault();

        var studentID = jQuery('#EDITschuelerID').val();

        jQuery.ajax({
            type: "post",
            url: "ajax_process_deleteStudent.php",
            data:
                {
                    studentID_data: studentID
                },
            dataType: "json",
            success: function (data) {
                jQuery("#activeElement").remove();
                jQuery( "#editRecord" ).dialog("close");
            }
        })
    });
});


/*
// create new dynamic Output
jQuery(document).ready(function() {
    jQuery('.formElement').on('submit', function (e) {

        e.preventDefault();

        var myType = jQuery(e.target).attr('id');

        var array = jQuery('.formElement').serializeArray();

        for (let i=0; i<array.length; i++) {
            jQuery.each(array[i], function (index, value) {
                console.log(index + ": " + value);
            });
        }

        if(jQuery("select").hasClass("FK")){
            var testVal = jQuery("select option:selected").val();
            var testText = jQuery("select option:selected").text();
            console.log(testVal +" is "+ testText);
        }

        jQuery.ajax({
            type: "post",
            url: "ajax_process_student.php",
            data: jQuery('.formElement').serialize()+'&myType='+myType,
            success: function (data) {
                //var output = data.replace(/[^a-z0-9\s,@.-]/gi, '').split(',');

                var test = jQuery.parseJSON(data);
                console.log(test);

                jQuery(".studentTable").append('' +
                    '<tr class="studentUebersicht">' +
                    '<td>'+schuelerVorname+'</td>' +
                    '<td>'+schuelerNachname+'</td>' +
                    '<td>'+schuelerGeburtsdatum+'</td>' +
                    '<td>'+schuelerEMail+'</td>' +
                    '<td>'+dropDownItem+'</td>' +
                    '</tr>');

                /*
                var myTr = '<tr>';
                jQuery.each(output, function(key,value){
                    myTr +='<td>'+value+'</td>';
                });

                myTr +='</tr>';

                jQuery(".studentTable tbody").append(myTr);
                */
                /*
            }
        })
    });
});
*/