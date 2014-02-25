;(function(){

	
	var categoryConf = {
		type: "#category_type",
		app:  ".category_app",
		archive: ".del-categ",
		update: ".update-categ"
	}
	
	var categoryFunc = {
		update: function() {
			return this.delegate(categoryConf.update, "submit", function(e){
				e.preventDefault();
				e.stopPropagation();
				var me = $(this);
				
				if($(".category_app2 > select[name=category]").length < 1) {
					alert("Please select a category.");
					return false;
				}
				
				var data = me.serialize();

				jQuery.ajax({
					type: "POST",
					url: config.base_url+"/admin/update_category/",
					data: data,
					cache: false,
					success: function (response) {
						alert("Updated successfully!");
						location.href= config.base_url + "/admin/category?update=true";
					}, error: function () {
						console.log('Something went wrong..');
					}
				})
			})
		},
		archive: function() {
			return this.delegate(categoryConf.archive, "submit", function(e){
				e.preventDefault();
				e.stopPropagation();
				var me = $(this);

				var category_id = $(".category_app > select[name=category]").val();
				if(!category_id) {
					alert("Please select a category!");
					return false;
				}
				me.children("button.btn.btn-danger").text("Deleting...");

				jQuery.ajax({
					type: "POST",
					url: config.base_url+"/admin/check_archive/",
					data: { 'category_id' : category_id },
					cache: false,
					success: function (response) {
						var json = $.parseJSON(response);
						if(json.is_use == 1) {
							if(confirm("Category is not empty and is being used, are you sure you want to delete it?")) {
								config.doc.archive_process(me, category_id);
							} else {
								me.children("button.btn.btn-danger").text("Delete");
								return false;
							}
						} else {
							if(confirm("Category is empty, are you sure you want to delete this category?")) {
								config.doc.archive_process(me, category_id);
							} else {
								me.children("button.btn.btn-danger").text("Delete");
								return false;
							}
						}
					}, error: function () {
						console.log('Something went wrong..');
					}
				});
			})
		},
		archive_process: function(me, id) {
			jQuery.ajax({
				type: "POST",
				url: config.base_url+"/admin/archive_category/",
				data: { 'id' : id },
				cache: false,
				success: function (response) {
					alert("Deleted successfully!");
					location.href= config.base_url + "/admin/category?del=true";
				}, error: function () {
					console.log('Something went wrong..');
				}
			});
		},
		showCategory: function() {
			return this.delegate(categoryConf.type, "change", function(){
				var me = $(this), type = me.val(), action = me.data("action");
				jQuery.ajax({
					type: "POST",
					url: config.base_url+"/admin/append_category/",
					data: { 'type' : type },
					cache: false,
					success: function (response) {
						$(categoryConf.app+action).html(response);
					}, error: function () {
						console.log('Something went wrong..');
					}
				});
			})
		}
	}
	
	$.extend(config.doc, categoryFunc);
	config.doc.showCategory();
	config.doc.archive();
	config.doc.update();
	
	var userConf = {
		priority: "button.favorite-user",
		archive: "button.delete-user",
		priority_status: 0
	}
	
	var userFunc = {
		priority: function() {
			return this.delegate(userConf.priority, "click", function(){
				var me = $(this), action = me.data("action"), user_id = me.data("entry-id");

				if(userConf.priority_status == 1) return false;
				userConf.priority_status = 1;

				jQuery.ajax({
					type: "POST",
					url: config.base_url+"/admin/favorite/",
					data: { 'action' : action, 'user_id' : user_id },
					cache: false,
					success: function (response) {
						if(action == 0) {
							me.data("action", 1);
							me.removeClass("btn-success").addClass("btn-default");
						} else {
							me.data("action", 0);
							me.removeClass("btn-default").addClass("btn-success");
						}
						userConf.priority_status = 0;
					}, error: function () {
						console.log('Something went wrong..');
					}
				});
			});
		},
		archive: function() {
			return this.delegate(userConf.archive, "click", function(){
				var me = $(this), action = me.data("action"), user_id = me.data("entry-id");

				if(userConf.priority_status == 1) return false;
				userConf.priority_status = 1;

				jQuery.ajax({
					type: "POST",
					url: config.base_url+"/admin/archive/",
					data: { 'action' : action, 'user_id' : user_id },
					cache: false,
					success: function (response) {
						if(action == 0) {
							me.data("action", 1);
							$("span.del").text("Delete");
							me.removeClass("btn-danger").addClass("btn-default");
							console.log();
						} else {
							me.data("action", 0);
							$("span.del").text("Undelete");
							me.removeClass("btn-default").addClass("btn-danger");
						}
						userConf.priority_status = 0;
					}, error: function () {
						console.log('Something went wrong..');
					}
				});
			});
		}
	}

	$.extend(config.doc, userFunc);
	config.doc.priority();
	config.doc.archive();

	var paymentStatusConf = {
		status: ".payment-status"
	}

	var paymentStatusFunc = {
		change: function() {
			return this.delegate(paymentStatusConf.status, "change", function(){
				var me = $(this), new_status = me.val(), status = me.data("status"), order_id = me.data("entry-id");
				if(new_status == status) return false;
				jQuery.ajax({
					type: "POST",
					url: config.base_url+"/orders/payment_status/",
					data: { 'new_status' : new_status, 'order_id' : order_id },
					cache: false,
					success: function (response) {
						me.data("status", new_status);
						var msg = "unpaid";
						if(new_status == 1){
							var msg = "paid";
						}
						alert("Payment status successfully changed to " + msg + "!");
					}, error: function () {
						console.log('Something went wrong..');
					}
				});
			})

		}
	}

	$.extend(config.doc, paymentStatusFunc);
	config.doc.change();

}(jQuery, window, document));
