
jQuery(function() {

 jQuery('#drac_load_example_data').click(function(){
  var data = "";

	data += 'DRAC-example Quartz Q Guerinetal2011 3.4 0.51 14.47 1.69 1.2 0.14 0 0 N X X X X X X X X X X X X X X X X X N 90 125 Brennanetal1991 Guerinetal2012-Q 8 10 Bell1979 0 0 5 2 2.22 0.05 1.8 0.1 30 70 150 X X 20 0.2\n';
	data += 'DRAC-example Feldspar F AdamiecAitken1998 2 0.2 8 0.4 1.75 0.05 0 0 Y X X X X 12.5 0.5 X X N X X X X X X X X Y 180 212 Bell1980 Mejdahl1979 0 0 Bell1979 0.15 0.05 10 3 0.15 0.02 1.8 0.1 60 100 200 X X 15 1.5\n';
	data += 'DRAC-example Polymineral PM AdamiecAitken1998 4 0.4 12 0.12 0.83 0.08 0 0 Y X X X X 12.5 0.5 X X N X X 2.5 0.15 X X X X Y 4 11 Bell1980 Mejdahl1979 0 0 Bell1979 0.086 0.0038 10 5 0.2 0.02 1.8 0.1 46 118 200 0.2 0.1 204.47 2.69\n';

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
