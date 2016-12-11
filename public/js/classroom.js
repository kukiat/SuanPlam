$(document).ready(function() {
	var card = '<div class="course-card"><span class="course-id">ACT1600</span><span class="course-name">FUNDAMENTALS OF FINANCIAL ACCOUNTING</span></div>';
	for(i=0;i<50;i++)
		$('.course-body').append(card)
	$(".button-collapse").sideNav();
});