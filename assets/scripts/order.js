;(function(){

	var multiOrderConf = {
		check_all: ".multiple-order",
		status: 0
	}

	var multiOrderFunc = {
		check_all: function() {
			return this.delegate(multiOrderConf.check_all, "click", function(){
				if($(this).is(":checked")) {
					// $(this).attr("checked", false);
					$(".child-order").each(function(){
						$(".child-order").prop("checked", true);
					})
				} else {
					// $(this).attr("checked", false);
					$(".child-order").each(function(){
						$(".child-order").prop("checked", false);
					})
				}
			})
		}
	}

	$.extend(config.doc, multiOrderFunc);
	config.doc.check_all();

}(jQuery, window, document));