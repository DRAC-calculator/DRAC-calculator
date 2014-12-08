
jQuery(function() {

	jQuery('#drac_load_example_data').click(function(){
		var data = "";

		data += 'DRAC-example Quartz Q AdamiecAitken1998 3.4000 0.5100 14.4700 1.6900 1.2000 0.1400 0.0000 0.0000 N X X X X X X X X X X X X X X X X X N 90.0000 125.0000 Brennanetal1991 Guerinetal2012-Q 8.0000 10.0000 Bell1979 0.0000 0.0000 5.0000 2.0000 2.2000 0.2200 1.8000 0.1000 30.0000 70.0000 150.0000 X X 20.0000 0.2000\n';
		data += 'DRAC-example Feldspar F AdamiecAitken1998 2.0000 0.2000 8.0000 0.4000 1.7500 0.0500 0.0000 0.0000 Y X X X X 12.5000 0.5000 X X N X X X X X X X X Y 180.0000 212.0000 Bell1980 Mejdahl1979 0.0000 0.0000 Bell1979 0.1500 0.0500 10.0000 3.0000 0.1500 0.0150 1.8000 0.1000 60.0000 100.0000 200.0000 X X 15.0000 1.5000\n';
		data += 'DRAC-example Polymineral PM AdamiecAitken1998 4.0000 0.4000 12.0000 0.1200 0.8300 0.0800 0.0000 0.0000 Y X X X X 12.5000 0.5000 X X N X X 2.5000 0.1500 X X X X Y 4.0000 11.0000 Bell1980 Mejdahl1979 0.0000 0.0000 X 0.0860 0.0038 10.0000 5.0000 0.2000 0.0200 1.8000 0.1000 46.0000 118.0000 200.0000 0.2000 0.1000 204.4700 2.6900\n';

		jQuery('#drac_data_table').val(data);

		if( jQuery('#drac_data_name').val() == "" ) {
			jQuery('#drac_data_name').val("Example Name");
		}
	});

	jQuery('#drac_clear_data').click(function(){
		jQuery('#drac_data_table').val("");
	});

	jQuery('#drac_data_submit').click(function(){
		jQuery('.drac_field_error').hide();
	});

});
