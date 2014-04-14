$(function() {

	$('#redactor_intro').redactor({
		focus: true,
		air: true
	});

	$('#redactor_content').redactor({
/* 			imageUpload: '', */
		focus: true,
		air: true,
		airButtons: ['formatting', 'bold', 'italic', 'deleted', 'unorderedlist', 'orderedlist', 'outdent', 'indent', 'image']
	});

  $('.dripr-intro-image').on('click', function(){
      $('#dripr_file_modal').show();
    
  });

	
});
