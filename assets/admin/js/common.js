jQuery(document).ready(function () {

	jQuery(document).on("click", ".deleteUser", function () {
		var userId = $(this).data("userid"),
			hitURL = baseURL + "deleteUser",
			currentRow = $(this);

		var confirmation = confirm("Are you sure to delete this user ?");
		if (confirmation) {
			jQuery.ajax({
				type: "POST",
				dataType: "json",
				url: hitURL,
				data: { userId: userId }
			}).done(function (data) {
				console.log(data);
				currentRow.parents('tr').remove();
				if (data.status = true) { alert("User successfully deleted"); }
				else if (data.status = false) { alert("User deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	$(".overlay").hide();
	$("#dataTable").dataTable({
		"pageLength": 50,
	});
	$('#dataTable').on('draw.dt', function (e, settings, len) {
		$('input').iCheck({
			checkboxClass: 'icheckbox_minimal-blue',
			radioClass: 'iradio_minimal-blue',
		});
	});
	$(document).on("click", ".remove_item", function (e) {
		e.preventDefault();
		var id = $(this).data('id');
		var price = $(this).data('price');
		var qty = $(this).data('qty');
		var disc = $(this).data('disc');
		var item_prc = parseFloat((price * qty) - disc);
		const rowid = id.split("_");
		var line_items = $(this).closest(`.line_items`);
		var line_length = line_items.children().length;
		if (line_length == 1) {
			$("#dataTable_backend").find(`.${rowid[0]}`).remove();
		} else {
			$("#dataTable_backend").find(`.item_${id}`).remove();
			var cur_price = $("#dataTable_backend").find(`.${rowid[0]}`).children('.prices').text();
			var new_price = parseFloat(cur_price) - item_prc;
			var price_to_add = new_price.toFixed(2);
			var price_td = $("#dataTable_backend").find(`.${rowid[0]}`);
			price_td.children('.prices').children('span').text(price_to_add);
			price_td.children('.prices').children('#product_price').remove();
			price_td.children('.prices').append(`<input type="hidden" name="products[${rowid[0]}][total_price]" value="${price_to_add}" id="product_price" disabled="">`);
		}
		return false;
	});

	$(document).on("click", ".merge_item1", function (e) {
		e.preventDefault();
		var mythis = $(this);
		var cur_order_id = mythis.data('order_id');
		var cur_line_id = mythis.data('line_id');
		return false;
		var table_ref = mythis.parentsUntil("#dataTable_backend");
		var result_arr = [];
		table_ref.children('tr').each(function (index) {
			var id = $(this).find('.line_items').children('div').attr('class');//$( this ).find( ".order_row_id" ).text();	
			//.split( '_' )
			id = id != undefined ? id.split('_') : null;
			id = id.length == 3 ? id[1] : id[1] + '_' + id[3];
			/**/

			if (id != cur_order_id) {
				var sr_no = $(this).find(".sr_no").text();
				var title = $(this).find(".title").text();
				var line_id = $(this).find(".inline").next().attr('class');
				result_arr.push({ "sr": sr_no, "order_id": id, "title": title, 'line_id': line_id });
			}
		});
		$('#merge_order_box').on('show.bs.modal', function (e) {
			var body = `<input type="hidden" id="order_id" value="${cur_order_id}"/>
			<input type = "hidden" id="line_id" value= "${cur_line_id}" />
			<select class="form-control select2" id="move_to_id" >`;
			let count = 1;
			result_arr.forEach(element => {
				body += `<option value="${element.order_id}" data-line_id="${element.line_id}" >
                        ${element.sr} :
                        ${element.order_id} 
                         ${element.title}</option>`;
				count++;
			});
			body += `</select>`;
			$(this).find('.modal-body').html(body);
		});
		$("#merge_order_box").modal('show');
		$('.select2').select2();

		return false;
	});

	$(document).on("click", ".split_item1", function (e) {
		e.preventDefault();
		console.log($(this).data('order_id'));
		var id = $(this).data('order_id');

		return false;
		var local_array = [];
		var new_this = $(this);
		var prices_update_instance = new_this.parents('tr').children('.prices');
		var price_arr = [];
		// current line_items class name 
		var cur_row = new_this.closest(`tr`);
		var copied_row = cur_row.clone(true);
		var current_selected_item = cur_row.find('.line_items');
		var prices = copied_row.find(".prices").text();
		var items_count = current_selected_item.children('div').length;
		current_selected_item.children('div').each(function (index) {
			var real_price = $(this).find('.title .text-justify').children('.real_prc').html();
			var disc = $(this).find('.title .text-justify').children('.disc').html();
			var prc = parseFloat(real_price) - parseFloat(disc);
			price_arr.push(prc);
		});
		const sum = price_arr.reduce((partialSum, a) => partialSum + a, 0);
		// var tax = parseFloat(prices) - sum;
		// tax = tax / items_count;
		var count = 0;
		new_row = ``;

		current_selected_item.children('div').each(function (index) {

			var cur_items_class = $(this).attr('class');
			var item_class = cur_items_class != undefined ? cur_items_class.split("_") : null;
			if (index == 0) {
				var new_prc = price_arr[index];
				new_prc = new_prc.toFixed(2);
				$(this).find(`#order_price_${item_class[1]}_${item_class[2]}`).val(new_prc);
				copied_row.find(".line_items").find(`.${cur_items_class}`).remove();
			} else {

				if (item_class != null) {
					var newRowClass = count % 2 == 0 ? "even" : "odd";
					var order_row_id = copied_row.find('.order_row_id').text();
					var sr_no = copied_row.find('.sr_no').text();
					var date = copied_row.find('.order_date').text();
					var customer_name = copied_row.find('.customer_name').text();
					var address = copied_row.find('.address').text();
					var number = copied_row.find('.number').text();
					var getway = copied_row.find('.getway').text();
					$(this).find(".inline").children("div .icheckbox_minimal-blue").remove();
					$(this).find(".inline .remove_item").before(`<input type="checkbox" class="form-check-input btn-space" data-id="${item_class[2]}_${count}" />`);
					/* remove btn id changed */
					$(this).find(".inline .remove_item").removeAttr(`data-id`);
					$(this).find(".inline .remove_item").attr(`data-id`, `${item_class[1]}_${count}`);
					/* merge_item btn data order id changed */
					$(this).find(".inline .merge_item").removeAttr(`data-order_id`);
					$(this).find(".inline .merge_item").attr(`data-order_id`, `${item_class[1].trim()}_${count}`);
					/* merge_item btn data line id changed */
					$(this).find(".inline .merge_item").removeAttr(`data-line_id`);
					$(this).find(".inline .merge_item").attr(`data-line_id`, `${item_class[2].trim()}_${count}`);

					var updated_weight = `<div class="form-inline">
						<div class="form-group">
							<input type="text" class="form-control max_width" id="weight_${item_class[1]}_${count}" name="products[${item_class[1]}_${count}][weight]" value="1" disabled="">
						</div>
					</div>`;
					var row_hidden_fields = $(this).find('.hidden_fields').children();
					row_hidden_fields.each(function (index) {
						var name = $(this).attr("name");
						var names = name.split('[');
						names[1] = item_class[1] + '_' + count + ']';
						name = names.join('[');
						$(this).removeAttr('name');
						$(this).attr('name', name);
						//console.log(name);
					});

					$(this).find(`.${item_class[2]}`).attr('class', `${item_class[2].trim()}_${count} hidden_fields`);
					var new_prc = price_arr[index];
					new_prc = new_prc.toFixed(2);
					$(this).find(`#order_price_${item_class[1]}_${item_class[2]}`).val(new_prc);
					$(this).find(`#order_id_${item_class[1]}_${item_class[2]}`).val(`${item_class[1]}_${count}`);
					$(this).find(`#order_price_${item_class[1]}_${item_class[2]}`).attr('id', `order_price_${item_class[1]}_${item_class[2].trim()}_${count}`);
					$(this).find(`#order_id_${item_class[1]}_${item_class[2]}`).attr('id', `order_id_${item_class[1]}_${item_class[2].trim()}_${count}`);
					$(this).find(`#item_id_${item_class[1]}_${item_class[2]}`).attr('id', `item_id_${item_class[1]}_${item_class[2].trim()}_${count}`);
					new_row += `<tr class="${order_row_id}_${count} ${newRowClass}" role="row">
							<td class="sr_no sorting_1">${sr_no}.${count}</td>
							<td class="order_row_id">${order_row_id}_${count}</td>
							<td class="order_date">${date}</td>
							<td class="line_items"><div class="item_${item_class[1]}_${item_class[2].trim()}_${count}">${$(this).html()}</div></td>
							<td class="customer_name">${customer_name}</td>
							<td class="address">${address}</td>
							<td class="prices">${new_prc}</td>
							<td class="number">${number}</td>
							<td class="getway">${getway}</td>
							<td class="weight">${updated_weight}</td>
							</tr>`;
					/* creating new row for table ends */
					$(this).remove();
				}
			}
			count = count + 1;
		});
		$(cur_row).after(new_row);
		/* getting sum of the Products */
		var new_price_to_update = price_arr[0];
		prices_update_instance.text(new_price_to_update.toFixed(2));
		$('input').iCheck({
			checkboxClass: 'icheckbox_minimal-blue',
			radioClass: 'iradio_minimal-blue',
		});
		/* remove split button */
		new_this.parent().find(".split_item ").remove();
		return false;
	});
	//split_item end
	var merge_arr = [];
	$('#merge_order_box').on('hide.bs.modal', function (e) {
		$(this).find('.modal-body').html();
	});

	$(document).on("click", ".move_line_items1", function (e) {
		e.preventDefault();

		console.log('here');
		return false;
		var move_to = $(this).parent(".modal-footer").prev('.modal-body').find('#move_to_id').val();
		var from_id = $(this).parent(".modal-footer").prev('.modal-body').find('#order_id').val();
		var from_line_id = $(this).parent(".modal-footer").prev('.modal-body').find('#line_id').val();
		var cur_item = $(`.${from_id}`).find(`.line_items`).children();
		if (cur_item.length > 1) {
			var parentEle = $(`.item_${from_id}_${from_line_id}`);
			var from_items_price = parentEle.find(`.title .text-justify .real_prc`).text();
			var from_items_discount = parentEle.find(`.title .text-justify .disc`).text();
			var real_prc = parseFloat(from_items_price) - parseFloat(from_items_discount);
			var price_field = $("#dataTable_backend").find(`.${from_id}`).find('.prices').children('span');
			var new_price = parseFloat(price_field.text() - real_prc);
			price_field.text(parseFloat(new_price).toFixed(2));/**/
		}
		var lc_obj = {};
		lc_obj['order_id'] = from_id;
		lc_obj['line_id'] = from_line_id;
		lc_obj['status'] = false;
		if (localStorage["removable_arr"] == undefined) {
			merge_arr.push(lc_obj);
			localStorage["removable_arr"] = JSON.stringify(merge_arr);
		} else {
			var removable_arr = JSON.parse(localStorage["removable_arr"]);
			removable_arr.push(lc_obj);
			localStorage["removable_arr"] = JSON.stringify(removable_arr);
		}
		var app_to = $("#dataTable_backend").find(`.${move_to}`).children('.line_items');
		var child_order_id;
		var new_id;
		if (check(from_id) == true) {
			new_id = from_id.split("_");
			child_order_id = `.item_${new_id[0]}_${from_line_id}`;
		} else {
			child_order_id = `.item_${from_id}_${from_line_id}`;
		}
		var copy_ele = $(`.${from_id}`).find(`.line_items`).children(child_order_id).clone(true);
		$(`.${from_id}`).find(`.line_items`).children(child_order_id).remove();
		copy_ele.children('.hidden_fields').children().each(function (index) {
			var name = $(this).attr("id");
			var ids = name.split('_');
			ids[2] = move_to;
			name = ids.join('_');
			$(this).removeAttr('id');
			$(this).attr('id', name);
			var order_id_txt = ids.length == 4 ? `order_id_${move_to}_${ids[3]}` : `order_id_${move_to}_${ids[3]}_${ids[4]}`
			if (name == order_id_txt) {
				$(this).val(move_to);
			}
		});
		var change_item_row_name = copy_ele.attr('class');
		var new_item_class = change_item_row_name.split('_');
		new_item_class[1] = move_to;
		change_item_row_name = new_item_class.join('_');
		copy_ele.removeAttr('class');
		copy_ele.attr('class', change_item_row_name);
		copy_ele_edit = copy_ele.children();
		for (let index = 0; index < copy_ele_edit.length; index++) {
			const element = copy_ele_edit[index];
			if ($(element).attr('type') == 'hidden') {
				//console.log(element);
				/** changing id attr */
				var id = $(element).attr('id');
				var ids = id.split('_');
				ids[2] = move_to;
				id = ids.join('_');
				$(element).removeAttr('id');
				$(element).attr('id', id);

				/** changing name attr */
				var name = $(element).attr('name');
				var names = name.split('[');
				names[1] = move_to + ']';
				name = names.join('[');
				$(element).removeAttr('name');
				$(element).attr('name', name);
			}
		}
		var moving_items_price = copy_ele.find(`.title .text-justify .real_prc`).text();
		var moving_items_discount = copy_ele.find(`.title .text-justify .disc`).text();
		var real_prc = parseFloat(moving_items_price) - parseFloat(moving_items_discount);
		var price_field = $("#dataTable_backend").find(`.${move_to}`).find('.prices').children('span');
		var new_price = parseFloat(real_prc) + parseFloat(price_field.text());
		price_field.text(new_price);

		$("#dataTable_backend").find(`.${move_to}`).find('.prices').children('#product_price').val(new_price);
		$("#dataTable_backend").find(`.${move_to}`).find('.prices').children('#product_price').removeAttr('disabled');
		copy_ele.appendTo(app_to);

		var from_child_count = $(`.${from_id}`).find(`.line_items`).children('div');
		if (!from_child_count.length > 0) {
			$("#dataTable_backend").find(`.${from_id}`).remove();
		}
		$("#merge_order_box").modal('hide');
		$('input').iCheck({
			checkboxClass: 'icheckbox_minimal-blue',
			radioClass: 'iradio_minimal-blue',
		});
		return false;
	});

	$(document).on("click", ".geo_btn", function (e) {
		e.preventDefault();
		var address = $(this).data('address');
		var order_id = $(this).data('id');
		console.log('btn init ', order_id);
		var modal_title = 'Find Lat and Long';
		var body = `<div id="map_canvas" class="iframe-container"></div>
                    <input type="text" class="form-control" id="address" value="${address}"/>
                    <input type="hidden" class="form-control" id="data-order" value="${order_id}"/>
                    <div class="lat_long_html"></div>`;
		var btn_text = 'Find Geo Code';
		$('#geobox').on('show.bs.modal', function (e) {
			$(this).find('.modal-body').html(body);
			$(this).find('.modal-footer').children('.btn-primary').text(btn_text);
			$(this).find('.modal-footer').children('.action_btn').attr('id', 'geo_code');
		});
		$('#geobox').modal('show');
	});

	$(document).on('click', '#geo_code', function (e) {
		e.preventDefault();
		var address = $("#geobox").find('.modal-body #address').val();
		var order_id = $("#geobox").find('.modal-body #data-order').val();
		$.ajax({
			url: `https://maps.googleapis.com/maps/api/geocode/json?address=${address}&key=AIzaSyCybC8ESUTry3oYozpluxRPp1ZdLIG_tus`,
			type: 'get',
			beforeSend: function () {
				$("#geobox").find('.modal-body #loading').html('<div class="overlay"> <i class="fa fa-refresh fa-spin"></i></div>');
			},
			success: function (data) {
				if (data.status == 'OK') {
					var response = data.results;
					var output = '<div class="row">';
					response.forEach(element => {
						output += `<div class="col-sm-6 pull-left">
                                <p> formatted Address:- ${element.formatted_address} </p>
                                    </div>
                                <div class="col-sm-6 pull-right">
                                    <p> lat:${element.geometry.location.lat} and lang:${element.geometry.location.lng}</p>
                                    <a href="#" class="btn btn-primary btn-sm btn-text btn_grab_geocode" data-lat="${element.geometry.location.lat}"
                                     data-lang="${element.geometry.location.lng}" data-order="${order_id}"><i class="fa fa-map-marker" aria-hidden="true"></i> Add</a>
                                </div`;

						initialize(element.formatted_address, element.geometry.location.lat, element.geometry.location.lng);
						//initAutocomplete(element.geometry.location.lat, element.geometry.location.lng);
					});
					output += '</div>';
					$("#geobox").find('.modal-body .lat_long_html').html(output);
				} else if (data.status === "OVER_QUERY_LIMIT") {
					$("#geobox").find('.modal-body .lat_long_html').html(`<p class="alert alert-danger">${data.error_message}</p>`);
				} else {
					$("#geobox").find('.modal-body .lat_long_html').html('<p class="alert alert-danger">No Result Found with this Address Please Try Again with Another address </p>');
				}
				$('#merge_order_box').on('hide.bs.modal', function (e) {
					$(this).find('.modal-body').html();
				});
			},
			error: function (err) {
				console.log(err.responseText);
			}
		});
	});

	$(document).on("click", ".btn_grab_geocode", function (e) {
		e.preventDefault();
		var row_id = $(this).data('order');
		var line_class = row_id.split('_');
		var parent = $("#dataTable").find(`.item_${row_id}`).parent();
		var lat = $(this).data('lat');
		var long = $(this).data('lang');
		var geo_keys = {
			"lat": lat,
			"long": long
		};
		parent.children('div').each(function (index) {
			//console.log( $( this ) );
			var output = `<input type="hidden" disabled="" name="products[${line_class[0]}][items][${index}][lat]" value="${geo_keys.lat}" id="product_lat_${row_id}">
                <input type="hidden" disabled="" name="products[${line_class[0]}][items][${index}][long]" value="${geo_keys.long}" id="product_long_${row_id}">
                `;
			$(this).find(`.hidden_fields`).append(output);
		});
		parent.find(".inline").children('.geo_btn').hide();
		$('#geobox').on('hide.bs.modal', function (e) {
			$("#geobox").find('.modal-body .lat_long_html').html();
			$(this).find('.modal-footer').children('.action_btn').attr('data-order', "");
		});
		$("#geobox").modal("hide");
		return true;
	});

	$(document).on('ifToggled', "input", function (e) {
		var lineItemDiv = $(this).data('id');
		var lineItem = $(this).parent().parent().next().children();

		for (let index = 0; index < lineItem.length; index++) {
			const element = lineItem[index];
			if ($(element).attr('type') == 'hidden') {
				var check = $(element).attr('disabled');
				if ($(this).prop("checked")) {
					$(element).removeAttr('disabled');
				} else {
					$(element).attr('disabled', true);
				}
			}
		}
		var parent_id = $(this).parent().parent().parent().attr('class');
		parent_id = parent_id.split("_");
		$(this).parent().find(`.${lineItemDiv}`).children(`#order_price_${parent_id[1]}_${parent_id[2]}`).removeAttr('disabled');
		var weight_id = parent_id.length == 4 ? 'weight_' + parent_id[1] + '_' + parent_id[2] : 'weight_' + parent_id[1];
		var weight_check = $(`#${weight_id}`).attr("disabled");
		if (weight_check == "disabled") {
			$(`#${weight_id}`).removeAttr('disabled');
		}
		/*else {
			$( `#${weight_id}` ).attr( 'disabled', true );
		}*/
	});

	$('.select2').select2({
		dropdownAutoWidth: true
	})

	//Date picker
	$('.datepicker').datepicker({
		autoclose: true,
		format: 'dd/mm/YY',

	});
	setTimeout(function () {
		$(".alert-dismissable").remove();
	}, 5000);

	$('input').iCheck({
		checkboxClass: 'icheckbox_minimal-blue',
		radioClass: 'iradio_minimal-blue',
	});

	$(document).on("click", ".apply_uc", function (e) {
		e.preventDefault();
		var row_id = $(this).data('row');
		var uc = $(this).data('uc');
		var id = row_id.split('_');
		var line_child = $(`.${row_id}`).find(".line_items").children().children('.hidden_fields').append(`<input type="hidden" name="products[${id[1]}][uc]"  value="${uc}">`);
		//console.log(line_child);
		$(this).hide();
	});

	$(document).ajaxStart(function () {
		Pace.restart();
	});

	/*
	setInterval(function () {
		
		$.ajax({
			url: baseURL + 'ajax/notifications',
			type: 'get',
			data: { timestamp: Date.now() },
			beforeSend: function () {
				console.log('started');
				Pace.ignore();
			},
			success: function (data) {
				var dec_data = JSON.parse(data);
				$("#notification_center").append(`<li>${dec_data}</li>`);
				//console.log(data);
			},
			error: function (err) {
				console.log(err.responseText);
			}
		});
	}, 10000);*/
});

// Speed up calls to hasOwnProperty
var hasOwnProperty = Object.prototype.hasOwnProperty;

function isEmpty(obj) {

	// null and undefined are "empty"
	if (obj == null) return true;

	// Assume if it has a length property with a non-zero value
	// that that property is correct.
	if (obj.length > 0) return false;
	if (obj.length === 0) return true;

	// If it isn't an object at this point
	// it is empty, but it can't be anything *but* empty
	// Is it empty?  Depends on your application.
	if (typeof obj !== "object") return true;

	// Otherwise, does it have any properties of its own?
	// Note that this doesn't handle
	// toString and valueOf enumeration bugs in IE < 9
	for (var key in obj) {
		if (hasOwnProperty.call(obj, key)) return false;
	}

	return true;
}

function initialize(address, let, long) {
	geocoder = new google.maps.Geocoder();
	var latlng = new google.maps.LatLng(let, long);
	var myOptions = {
		zoom: 15,
		center: latlng,
		mapTypeControl: false,
		mapTypeControlOptions: {
			style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
		},
		navigationControl: true,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	if (geocoder) {
		geocoder.geocode({
			'address': address
		}, function (results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
					map.setCenter(results[0].geometry.location);

					var infowindow = new google.maps.InfoWindow({
						content: '<b>' + address + '</b>',
						size: new google.maps.Size(100, 50)
					});

					var marker = new google.maps.Marker({
						position: results[0].geometry.location,
						map: map,
						title: address
					});
					google.maps.event.addListener(marker, 'click', function () {
						infowindow.open(map, marker);
					});
				} else {
					alert("No results found");
				}
			} else {
				alert("Geocode was not successful for the following reason: " + status);
			}
		});
	}
}


function passToCourier(data, urls) {
	return new Promise((resolve, reject) => {
		$.ajax({
			url: baseURL + urls,
			type: 'POST',
			data: data,
			success: function (data) {
				resolve(data)
			},
			error: function (error) {
				reject(error)
			},
		})
	});
}

function fetch_balance() {
	$.ajax({
		url: baseURL + 'returns/balance',
		type: "get",
		success: function (data) {
			var dec_data = JSON.parse(data);
			$("#wallet_bal").html(' ' + dec_data.message);
		},
		error: function (err) {
			$("#wallet_bal").html(' ' + err.responseText);
		}
	});
	return true;
}