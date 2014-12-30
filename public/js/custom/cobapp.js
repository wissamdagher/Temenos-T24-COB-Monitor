$(document).ready(function(){
    $('#cobstartsummaries').DataTable({
	"paging":   true,
	"ordering": true,
	"info":     false,
	"searching": false,
	"bFilter" : false,
		"bLengthChange": false
    });

    $('#cobstartsummaries')
	.removeClass( 'display' )
	.addClass('table table-striped table-bordered');
});