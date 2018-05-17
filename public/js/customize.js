$(document).ready(function() {



	$("#wilaya").on("change", function(e){
		$("#region").empty();
		var first_option = " <option value='0' selected hidden disabled>Choisir Une commune</option>";
		$("#region").append(first_option);
		var region = $("#region");
		var wilaya = $(this).val();
		$.get(APP_URL+'/ajax/getCommunes/'+wilaya, function(d){
			d.forEach(function(commune){
				var nouvel_commune = new Option(commune, commune, false, false);
				region.append(nouvel_commune);
			});
		});
	});
	
});
<div>
	<p></p>
</div>