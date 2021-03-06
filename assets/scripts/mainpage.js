;(function(){
	var item_ids = [];
	var status = { 0: "Cancelled", 1: "Pending", 2: "On Delivery", 3: "Delivered" }
	
	var imgModalConf = {
		show: ".img-modal",
		allem: ".advertise-format"
	}
	
	var imgModalFunc = {
		show: function() {
			return this.delegate(imgModalConf.show, "click", function(){
				var me = $(this);
				console.log(me.attr("src"));
				$(".modal-body > img").attr("src", me.attr("src"));
			});
		},
		allem: function() {
			return this.delegate(imgModalConf.allem, "change", function(){
				var me = $(this), val = me.val();
				jQuery.ajax({
					type: "POST",
					url: config.base_url+"/advertise/getem/",
					data: { 'val' : val },
					cache: false,
					success: function (response) {
						$(".image-append-here").html(response);
					}, error: function () {
						console.log('Something went wrong..');
					}
				});
			})
		}
	}

	$.extend(config.doc, imgModalFunc);
	config.doc.show();
	config.doc.allem();

	var cartConf = {
		add:     ".add-cart",
		order:   ".order-btn",
		remove:  ".remove-cart",
		archive: ".remove-flower",
		cancel:  ".cancel-flower",
		append:  ".append-orders",
		details: ".view-details",
		suggest: ".btn-suggestion",
		categ:   ".flower_category",
		bydate: ".by_date",
		status: ".order-status",
		billing: ".view-billing",
		quantity: ".quantity",
		quantity_val: ".quantity_val",
		order_all: ".order-all",
		add_ons: ".select-add-ons",
		add_ons_remove: ".add-on-remove",
		add_ons_show: ".show-order",
		add_ons_close: ".close_add_ons",
		arr: 0,
		add_show: 0
		
	}
	
	var cartFunc = {
		add_ons_close: function() {
			return this.delegate(cartConf.add_ons_close, "click", function(){
				$(".add-on-remove").each(function() {
					var item_id = $(this).data("item-id");
					var item_name = $(".select-add-ons option[value="+item_id+"]").data("item-name");
					$(".select-add-ons option[value="+item_id+"]").text(item_name);
				});
				$(".orig_addons").remove();
				item_ids = [];
			})
		},
		add_ons_show: function() {
			return this.delegate(cartConf.add_ons_show, "click", function(){
				var me = $(this), cart_id = me.data("cart-id");
				$("input[name=ao_cart_id]").val(cart_id);
				if(cartConf.add_show != cart_id) {
					jQuery.ajax({
						type: "POST",
						url: config.base_url+"/addons/cartshow/",
						data: { "cart_id" : cart_id },
						cache: false,
						success: function (response) {
							cartConf.add_show = cart_id;
							$(".append_row").prepend(response);
							config.doc.price_calculate();
							$(".add-on-remove").each(function() {
								if($(this).data("item-id") > 0) {
									var item_id = $(this).data("item-id");
									item_ids.push("" + $(this).data("item-id") + "");
									console.log(item_ids);

									var item_name = $(".select-add-ons option[value="+item_id+"]").text();
									$(".select-add-ons option[value="+item_id+"]").text(item_name + " - ( selected )");
								}
							})
						}, error: function () {
							console.log('Something went wrong..');
						}
					});
				}
			})
		},
		add_ons_remove: function() {
			return this.delegate(cartConf.add_ons_remove, "click", function(){
				var me = $(this), item_id = me.data("item-id");
				var item_name = $(".select-add-ons option[value="+item_id+"]").data("item-name");
				$(".select-add-ons option[value="+item_id+"]").text(item_name);
				me.parent().parent("tr").remove();
				item_ids = jQuery.grep(item_ids, function( value ) {
				  return value != item_id;
				});
				config.doc.price_calculate();
			});
		},
		add_ons: function() {
			return this.delegate(cartConf.add_ons, "change", function(){
				var me = $(this), item_id = me.val();
				if(item_id == "") return false;
				if(jQuery.inArray( item_id, item_ids ) > -1) {
					return false;
				}

				var item_name = $(".select-add-ons option[value="+item_id+"]").text();
				$(".select-add-ons option[value="+item_id+"]").text(item_name + " - ( selected )");

				jQuery.ajax({
					type: "POST",
					url: config.base_url+"/addons/append/",
					data: { 'item_id' : item_id },
					cache: false,
					success: function (response) {
						$(".append_row").prepend(response);
						item_ids.push(item_id);
						me.prop('selectedIndex', 0);
						config.doc.price_calculate();
					}, error: function () {
						console.log('Something went wrong..');
					}
				});
			})
		},
		price_calculate: function(a) {
			var total = 0;
			$(".item_price").each(function(){
				var item_price = $(this).data("price");
				total += parseInt(item_price); 
			})
		
			$(".total_price").text("Php " + total + ".00");
			$("input[name=total_price]").val(total);
		},
		process_all: function() {
			if(cartConf.arr == 0) {
				alert("Please select an item.");
				return false;
			}

			var data = $("#order_all_form").serialize();

			jQuery.ajax({
				type: "POST",
				url: config.base_url+"/cart/order_all/",
				data: data,
				cache: false,
				success: function (response) {
					if(response == "invalid_date") {
						alert("Please input a valid date.");
						return false;
					}
					var arrayx = $(".order_all_name").val();
					var splitter = arrayx.split(",");
					for(var i=0; i < splitter.length; i++) {
						$("tr.row-"+ splitter[i]).slideToggle();
					}
					$(".close").trigger("click");
					alert("Success!");
				}, error: function () {
					console.log('Something went wrong..');
				}
			});
		},
		cartarray: function() {
			return this.delegate(cartConf.order_all, "click", function(){
				cartConf.arr = $( ".child-order:checked" ).map(function() { return this.value; }).get(); //.join()
				$(".order_all_name").val(cartConf.arr);
				var arrayx = $(".order_all_name").val();
				var splitter = arrayx.split(",");
				if(splitter.length < 2) {
					$(".close").trigger("click");
					location.href= config.base_url+"/orders/order/" + $("#my_id"+splitter).data("flower-id") + "/0";
				}
			})
		},
		quantity: function() {
			return this.delegate(cartConf.quantity, "click", function(){
				var cart_id = $(this).data("entry-id");
				var quantity = $(this).prev(".quantity_val").val();
				jQuery.ajax({
					type: "POST",
					url: config.base_url+"/cart/quantity/",
					data: { 'quantity' : quantity, "cart_id" : cart_id },
					cache: false,
					success: function (response) {
						alert("Updated!");
					}, error: function () {
						console.log('Something went wrong..');
					}
				});
			});
		},
		billing: function() {
			return this.delegate(cartConf.billing, "click", function(){
				var me = $(this), flower_id = me.data("flower-id"), order_id = me.data("order-id");
				console.log(order_id);
				console.log(flower_id);
				jQuery.ajax({
					type: "POST",
					url: config.base_url+"/orders/billing/",
					data: { 'flower_id' : flower_id, 'order_id' : order_id },
					cache: false,
					success: function (response) {
						$("#billing .modal-body").html(response);
					}, error: function () {
						console.log('Something went wrong..');
					}
				});
			})
		},
		category: function() {
			return this.delegate(cartConf.categ, "change", function() {
				$(cartConf.append).val("empty");
			});
		},
		suggestion: function() {
			return this.delegate(cartConf.suggest, "click", function(){
				var me = $(this), flower_id = me.data("entry-id");
				var suggest = $(".suggest-textarea").val();
				jQuery.ajax({
					type: "POST",
					url: config.base_url+"/admin/suggest/",
					data: { 'flower_id' : flower_id, 'suggest' : suggest },
					cache: false,
					success: function (response) {
						alert("Suggestions added.");
						$(".suggest-textarea").val("");
					}, error: function () {
						console.log('Something went wrong..');
					}
				});
			});
		},
		view: function() {
			return this.delegate(cartConf.details, "click", function() {
				var me = $(this), order_id = me.data("order-id"), flower_id = me.data("flower-id");
					jQuery.ajax({
						type: "POST",
						url: config.base_url+"/orders/details/",
						data: { 'order_id' : order_id, 'flower_id' : flower_id },
						cache: false,
						success: function (response) {
							$("#myModal .modal-body").html(response);
						}, error: function () {
							console.log('Something went wrong..');
						}
					});
			});
		},
		status: function() {
			return this.delegate(cartConf.status, "change", function() {
				var me = $(this), stats = me.val(), id = me.data("status"), order_id = me.data("entry-id");
				if(stats == id) return false;
				if(!confirm("Are you sure you want to change this order status into "+status[stats]+"?")) return false;
				jQuery.ajax({
					type: "POST",
					url: config.base_url+"/admin/change_status/",
					data: { 'order_id' : order_id, 'stats' : stats },
					cache: false,
					success: function (response) {
						me.closest("tr").slideToggle();
						me.data("status", stats);
						alert("Success!");
					}, error: function () {
						console.log('Something went wrong..');
					}
				});
			});
		},
		bydate: function() {
			return this.delegate(cartConf.bydate, "change", function() {
				var me = $(this), date = me.val();

				jQuery.ajax({
					type: "POST",
					url: config.base_url+"/admin/bydate/",
					data: { 'date' : date },
					cache: false,
					success: function (response) {
						$(".append_orders").html(response);
					}, error: function () {
						console.log('Something went wrong..');
					}
				});
			});
		},
		append: function() {
			return this.delegate(cartConf.append, "change", function() {
				var me = $(this), order_status = me.val(), action = me.data("action");
				if(action == 1) {
					var f_categ = $(".flower_category").val();
				} else {
					var f_categ = 0;
				}
				
				if(order_status == "") return false;
				var user_id = $(".user-id").val();
				jQuery.ajax({
					type: "POST",
					url: config.base_url+"/orders/append/",
					data: { 'order_status' : order_status, 'action': action, 'f_categ' : f_categ, 'user_id' : user_id },
					cache: false,
					success: function (response) {
						$(".append_orders").html(response);
					}, error: function () {
						console.log('Something went wrong..');
					}
				});
			});
		},
		cancel: function() {
			return this.delegate(cartConf.cancel, "click", function() {
				var me = $(this), order_id = me.data("entry-id");
				if(!confirm("Are you sure want to cancel this order?")) return false;
				jQuery.ajax({
					type: "POST",
					url: config.base_url+"/orders/cancel_order/",
					data: { 'order_id' : order_id },
					cache: false,
					success: function (response) {
						me.closest("tr").slideToggle();
					}, error: function () {
						console.log('Something went wrong..');
					}
				});
			})
		},
		order: function(){
			return this.delegate(cartConf.order, "click", function(){
				if($("input[name=read_terms]").length > 0) {
					if($("input[name=read_terms]").is(':checked')) {
						// console.log("try");
						if($(this).data("action") == 0) {
							config.doc.process_all();
							return false;
						}
					} else {
						alert("Please read our our terms and condition.");
						return false;
					}
				}
				var me = $(this),
				data = me.closest("#order_form").serialize();
				jQuery.ajax({
					type: "POST",
					url: config.base_url+"/orders/add_order/",
					data: data,
					cache: false,
					success: function (response) {
						if(response == 0) {
							alert("Success!");
							location.href=config.base_url+"/cart";
						} else if(response == "invalid_date"){
							alert("Delivery date should not be lower or equal than date today.");
							return false;
						} else {
							location.href=config.base_url+"/orders";
						}
					}, error: function () {
						console.log('Something went wrong..');
					}
				});
			});
		},
		archive: function(){
			return this.delegate(cartConf.archive, "click", function(){
				var me = $(this), 
				id = me.data("entry-id");
				if(!confirm("Are you sure you want to remove this to cart?")) return false;
				jQuery.ajax({
					type: "POST",
					url: config.base_url+"/cart/remove_cart/",
					data: { 'id' : id },
					cache: false,
					success: function (response) {
						me.closest("tr").slideToggle();
					}, error: function () {
						console.log('Something went wrong..');
					}
				});
			});
		},
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
	config.doc.view();
	config.doc.billing();
	config.doc.status();
	config.doc.bydate();
	config.doc.category();
	config.doc.order();
	config.doc.remove();
	config.doc.append();
	config.doc.cancel();
	config.doc.archive();
	config.doc.suggestion();
	config.doc.quantity();
	config.doc.cartarray();
	config.doc.add_ons_show();
	config.doc.add_ons();
	config.doc.add_ons_remove();
	config.doc.add_ons_close();

	var deleteConf = {
		archive: "a.delete",
		specific: ".specific-delete"
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
			return this.delegate(deleteConf.specific, "click", function(){
				var me = $(this),
				id = me.data("entry-id");
				type = me.data("type");
				if(!confirm("Are you sure you want to delete this?")) return false;
				
				jQuery.ajax({
					type: "POST",
					url: config.base_url+"/advertise/img_delete/",
					data: { 'id' : id, 'type' : type },
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
	
	var salesConf = {
		gen: '.generator',
		date: '.sales-date',
		face: '.generated-report-interface',
		print: '.print'
	}

	var salesFunc = {
		report: function() {
			return this.delegate(salesConf.gen, "click", function(){
				var me = $(this), action = me.data("action");
				var date = $(salesConf.date).val();
				
				$(".generated-report-interface").html("Loading sales...");
				jQuery.ajax({
					type: "POST",
					url: config.base_url+"/sales/date/",
					data: { 'date' : date, 'action': action },
					cache: false,
					success: function (response) {
						if(response == "none") {
							$(".generated-report-interface").html("No sales..");
						} else {
							$(".generated-report-interface").html(response);
						}
					}, error: function () {
						console.log('Something went wrong..');
					}
				})
			})
		},
		print: function() {
			return this.delegate(salesConf.print, "click", function(){
				window.print();
			})
		}
	}

	$.extend(config.doc, salesFunc);
	config.doc.report();
	config.doc.print();

}(jQuery, window, document));
