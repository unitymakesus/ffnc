function footnotation_show(pid) {
	jQuery('#footnotes-'+pid+' ol').show();
	footnotation_updatelabel(pid);
}

function footnotation_togglevisible(pid) {
	jQuery('#footnotes-'+pid+' ol').toggle();
	footnotation_updatelabel(pid);
	return false;
}

function footnotation_updatelabel(pid) {
	if (jQuery('#footnotes-'+pid+' ol').is(':visible')) {
		jQuery('#footnotes-'+pid+' .footnoteshow').hide();
	} else {
		jQuery('#footnotes-'+pid+' .footnoteshow').show();
	}
}

jQuery(document).ready(
	function() {
		try {
			var target = window.location.hash;
			if (target.substr(0,4) == '#fn-') {
				var pieces = target.split('-');
				if (pieces.length == 3) {
					var pid = pieces[1];
					footnotation_show(pid);
				}
			}
		} catch (ex) {
		}
	}
);
