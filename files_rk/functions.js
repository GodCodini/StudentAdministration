jQuery(document).ready(function() {

    jQuery("#studentTable").on('click', '.studentRow', function (e) {

        jQuery("#activeElement").each(function(i, obj) {
            jQuery(obj).removeAttr("id", "activeElement");
        });

        jQuery(e.currentTarget).attr("id", "activeElement");

        jQuery("#EDITschuelerID").val(jQuery(e.currentTarget).find(".studentID").text());
        jQuery("#EDITschuelerVorname").val(jQuery(e.currentTarget).find(".schuelerVorname").text());
        jQuery("#EDITschuelerNachname").val(jQuery(e.currentTarget).find(".schuelerNachname").text());
        jQuery("#EDITschuelerGeburtsdatum").val(jQuery(e.currentTarget).find(".schuelerGeburtsdatum").text());
        jQuery("#EDITschuelerEMail").val(jQuery(e.currentTarget).find(".schuelerEmail").text());
        jQuery("#EDITschuelerKlasse").val(jQuery(e.currentTarget).find(".schuelerKlasse").attr("id"));

        jQuery( "#editRecord" ).dialog();
    });
});

function checkForUpdate(){
    window.updateNeeded = true;
}
