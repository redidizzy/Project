$(function(){
	$("#wilaya").on("change", function(e){
		$("#region").empty();
		var first_option = " <option value="0" selected hidden disabled>Choisir Une commune</option>";
		$("#region").html(first_option);

		var wilaya = $(this).val();
		$.get('/getCommunes/'+wilaya, function(d){

		});
	});
});