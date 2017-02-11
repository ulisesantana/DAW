function messageAjax (msg) {
    if (jQuery("body").find("#infoBox").length == 0) {
		jQuery("body").prepend("<div id=\"infoBox\" style=\"height: 20px;background-color:#ffffff;width:100%;display:none;text-align:center;border-bottom:#2BBAE4 1px solid;\"></div>");
	} // END IF
	
	jQuery("body").find("#infoBox").text(msg).slideDown().delay(3000).slideUp();
}
messageAjax('Mensaje en el top');