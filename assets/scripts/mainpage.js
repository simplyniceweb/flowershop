;(function(){

	var deleteConf = {
		archive: "a.delete"
	}
	
	var deleteFunc = {
		archive: function() {
			return this.delegate(deleteConf.archive,"click", function(){
				var me = $(this),
				id = me.data("entry-id");
				if(!confirm("Are you sure you want to delete this?")) return false;
				
				
			})
		}
	}
	
	$.extend(config.doc, deleteFunc);
	config.doc.archive();

}(jQuery, window, document));