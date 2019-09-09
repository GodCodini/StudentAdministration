jQuery(document).ready(function() {
    jQuery("tr").not(':first').click(function (e) {

        jQuery("#schuelerKlasse").each(function (index) {
            console.log(jQuery(this).val());
            //console.log(index);
        });


        jQuery("#EDITschuelerID").val(jQuery(e.currentTarget).find(".studentID").text());
        jQuery("#EDITschuelerVorname").val(jQuery(e.currentTarget).find(".schuelerVorname").text());
        jQuery("#EDITschuelerNachname").val(jQuery(e.currentTarget).find(".schuelerNachname").text());
        jQuery("#EDITschuelerGeburtsdatum").val(jQuery(e.currentTarget).find(".schuelerGeburtsdatum").text());
        jQuery("#EDITschuelerEMail").val(jQuery(e.currentTarget).find(".schuelerEmail").text());
        jQuery("#EDITschuelerKlasse").val(jQuery(e.currentTarget).find("#schuelerKlasse").val());

        jQuery( "#editRecord" ).dialog();
    });
});