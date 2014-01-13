;(function(){
	
	var cartConf = {
		add: ".add-cart",
		remove: ".remove-cart"
	}
	
	var cartFunc = {
		add: function() {
			return this.delegate(cartConf.add, "click", function(){
				var me = $(this),
				id = me.data("entry-id");

				jQuery.ajax({
					type: "POST",
					url: config.base_url+"/cart/add_cart/",
					data: { 'id' : id },
					cache: false,
					success: function (response) {
						if(response == "off-session"){
							alert("Please login to perform this action.");
							return false;
						}

						me
						.removeClass("add-cart btn-primary")
						.addClass("remove-cart btn-danger")
						.html('<i class="glyphicon glyphicon-remove"></i> Remove to cart')
						.data("cart-id", response);
					}, error: function () {
						console.log('Something went wrong..');
					}
				});
			})
		},
		remove: function(){
			return this.delegate(cartConf.remove, "click", function(){
				var me = $(this),
				id = me.data("cart-id");
				if(!confirm("Are you sure you want to remove this from the cart?")) return false;

				jQuery.ajax({
					type: "POST",
					url: config.base_url+"/cart/remove_cart/",
					data: { 'id' : id },
					cache: false,
					success: function (response) {
						if(response == "off-session"){
							alert("Please login to perform this action.");
							return false;
						}

						me
						.removeClass("remove-cart btn-danger")
						.addClass("add-cart btn-primary")
						.html('<i class="glyphicon glyphicon-shopping-cart"></i> Add to cart')
						.data("cart-id", response);
					}, error: function () {
						console.log('Something went wrong..');
					}
				});
			});
		}
	}

	$.extend(config.doc, cartFunc);
	config.doc.add();
	config.doc.remove();

	var deleteConf = {
		archive: "a.delete",
		specific: "i.specific-delete"
	}
	
	var deleteFunc = {
		archive: function() {
			return this.delegate(deleteConf.archive,"click", function(){
				var me = $(this),
				id = me.data("entry-id");
				if(!confirm("Are you sure you want to delete this?")) return false;

				jQuery.ajax({
					type: "POST",
					url: config.base_url+"/view/delete/",
					data: { 'id' : id },
					cache: false,
					success: function (response) {
						alert("Successfuly deleted!");
						location.href="";
					}, error: function () {
						console.log('Something went wrong..');
					}
				});
			})
		},
		specific: function() {
			return this.delegate(deleteConf.specific,"click", function(){
				var me = $(this),
				id = me.data("entry-id");
				if(!confirm("Are you sure you want to delete this?")) return false;
				var img = $("img.img-"+id).attr("src");
				
				jQuery.ajax({
					type: "POST",
					url: config.base_url+"/view/img_delete/",
					data: { 'id' : id, 'img' : img },
					cache: false,
					success: function (response) {
						alert("Successfuly deleted!");
						me.hide();
						$("img.img-"+id).slideToggle();
					}, error: function () {
						console.log('Something went wrong..');
					}
				});
			});
		}
	}
	
	$.extend(config.doc, deleteFunc);
	config.doc.archive();
	config.doc.specific();

}(jQuery, window, document));