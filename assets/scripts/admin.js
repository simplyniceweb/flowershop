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
