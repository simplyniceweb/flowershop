;(function(){

	
	var categoryConf = {
		type: "#category_type",
		app:  ".category_app"
	}
	
	var categoryFunc = {
		showCategory: function() {
			return this.delegate(categoryConf.type, "change", function(){
				var me = $(this), type = me.val();
				jQuery.ajax({
					type: "POST",
					url: config.base_url+"/admin/append_category/",
					data: { 'type' : type },
					cache: false,
					success: function (response) {
						$(categoryConf.app).html(response);
					}, error: function () {
						console.log('Something went wrong..');
					}
				});
			})
		}
	}
	
	$.extend(config.doc, categoryFunc);
	config.doc.showCategory();

}(jQuery, window, document));