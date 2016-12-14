$(document).ready(function() {
	$('.modal').modal();
	$(".sideNav").sideNav();
	$('.club-header').click(function(){
		$('#modal-editpicture').modal('open')
	});
});
