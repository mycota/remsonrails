$(document).ready(function(){

	$("form").on("click", ".reset", function(){

		// I will be back to finish this
		var getid = $(this).attr('id');
		console.log(getid);

		$(getid).trigger("reset");

		// $('#addMoreProductModal').on('hidden.bs.modal', function (e) {
  //       $(this).find("input,textarea,select").val('').end()
  //       .find("input[type=checkbox], input[type=radio]").prop("checked", "").end();
  //   })
	})
});