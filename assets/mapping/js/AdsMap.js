/**
 * @copyright 2014 Locotec (PTY) LTD
 * @author Keith Simon
 * @param map
 * @param clusterOptions
 * @param spiderOptions
 * @param h2cOptions
 * @param optOptions
 * @constructor
 * Icons https://www.iconfinder.com/icons/101900/location_pin_question_icon#size=128
 */

function AdsMap(map, clusterOptions, spiderOptions, h2cOptions, optOptions) {
	var self = this;
	this.map = map;

	this.allowLoad = true;//Are there any missing scripts.
	this.missingScripts = {};
	this.scriptLoadInterval = false;

	var assetTypes = AdsMap.ASSET_TYPES;
	delete assetTypes[0];
	//Remove the unkown for the legend
	this.optOptions = $.extend({}, {
		markers: [],
		mode: 'select',//select | input
		jsBase: '/assets/mapping/js/',
		urlBase: '',
		fillColours: {//Used for Radii
			print: '#AA0000',
			radio: '#00AA00',
			search: '#0000AA'
		},
		showRadii: true,
		showLegend: true,
		showSearchPOIButton: false,
		showFilterButton: false,
		currentFilterCriteria: {},//This gets attached to snapshots
		assetTypes: assetTypes,//The types of assets
		assetMedia: AdsMap.ASSET_MEDIA//The icon relating to the asset
	}, optOptions);

	this.clusterOptions = $.extend({}, {
		imagePath: this.optOptions.urlBase + '/assets/mapping/images/m',
		maxZoom: 14
	}, clusterOptions);

	this.spiderOptions = $.extend({}, {
		keepSpiderfied: true
	}, spiderOptions);


	this.h2cOptions = $.extend({}, {
		proxy: this.optOptions.urlBase + '/assets/mapping/src/proxy/index.php',
		logging: false,
		useCors: true
	}, h2cOptions);

	//These are user dropped markers we use to search for nearby POI's
	this.searchMarkers = [];


	this.spider = false;
	this.markerCluster = false;

	this.filters = {};//Put all radius filters in here, so when we refresh the map we can remove the markers that should not be displayed


	//Check if all scripts have been loaded, if not load them and wait
	this.allowLoad = this.check_scripts();

	var event = document.createEvent('Event');
	event.initEvent('AdsMaploaded', true, true);

	if (this.allowLoad) {
		//Call the build code
		this.build_map();
		document.dispatchEvent(event);
	} else {
		//Wait until all scripts are loaded
		this.scriptLoadInterval = setInterval(function () {
			var all_loaded = true;
			for (var i in self.missingScripts) {
				if (self.missingScripts[i] == 1) {
					all_loaded = false;
				}
			}
			if (all_loaded) {
				//Stop checking.
				clearInterval(self.scriptLoadInterval);
				//Call the build code.
				self.build_map();
				document.dispatchEvent(event);
			}
		}, 500);
	}
};

AdsMap.prototype.add_message = function(message, delay) {
	var self = this;
	delay = delay || 8;
	var milliseconds = delay * 1000;
	var div = document.createElement('div');
	div.innerHTML = '<h4>'+message+'</h4>';
	this.map.controls[google.maps.ControlPosition.TOP_RIGHT].push(div);
	setTimeout(function() {
		self.map.controls[google.maps.ControlPosition.TOP_RIGHT].pop();
	}, milliseconds);


};

AdsMap.prototype.get_filter_text = function () {
	var values = [];
	for (var key in this.optOptions.currentFilterCriteria) {
		var value = this.optOptions.currentFilterCriteria[key];
		values.push(key + ': ' + value);
	}
	var text = values.join("\r\n");
	return text;
};

AdsMap.prototype.add_asset = function (options) {
	var self = this;
	var listener = google.maps.event.addListener(this.map, 'click', function (event) {
		google.maps.event.removeListener(listener);
		options = $.extend({}, {
			adsMap: self,
			position: event.latLng
		}, options);
		var asset = new AdsMap.Asset(options);
	});


};

AdsMap.prototype.filter_markers_in_radius = function (allow_multiple, post_callback) {
	var self = this;
	var count = 0;
	var listener = google.maps.event.addListener(self.map, 'click', function (event) {
		var filter_id = Math.floor(Math.random() * 99999) + 1;
		var current_radius = '';
		if (!allow_multiple) {
			google.maps.event.removeListener(listener);
		}
		var clickMarker = new google.maps.Marker({
			position: event.latLng,
			visible: true,
			map: self.map,
			icon: self.optOptions.urlBase + '/assets/mapping/images/user_marker.png',
			poi_markers: [],
			circle: new google.maps.Circle({
				map: self.map,
				fillColor: self.optOptions.fillColours['search'],
				strokeColor: AdsMap.luminosity(self.optOptions.fillColours['search'], -0.3),
				strokeOpacity: 1,
				strokeWeight: 1,
				visible: false
			})
		});//Use this marker when a user is inputting elements
		clickMarker.circle.bindTo('center', clickMarker, 'position');
		var random_id = Math.floor(Math.random() * 999999) + 1;
		var content = '<div style="width: 180px; height: 80px;" id="' + random_id + '">Loading...</div>';
		var $form = $(
			'<div>' +
				'<input class="form-control mapping_poi_radius" type="number" placeholder="Radius (km)" /><br/>' +
				'<button style="margin: 0" class="btn btn-danger btn-xs pull-right">Remove</button>' +
				'</div>'
		);
		var map_markers = self.optOptions.markers;
		$form.find('input').on('keyup', function (e) {
			var value = $(this).val().trim();
			current_radius = value = isNaN(value) ? 0 : value;
			if (value == 0) {
				delete self.filters[filter_id];//Delete the filter
			} else {

				//Add the filter to the filters array
				var meters = value * 1000;
				self.filters[filter_id] = {
					position: clickMarker.position,
					radius: meters
				};

				clickMarker.circle.setRadius(meters);
				clickMarker.circle.setVisible(true);
			}
			self.run_filters();
		});

		//Open the info window
		infoWindow(clickMarker);
		google.maps.event.addListener(clickMarker, 'click', function () {
			infoWindow(clickMarker);
		});

		//Opens and repopulates the info window
		function infoWindow(marker) {
			$form.find('input:first').val(current_radius);
			var info = new google.maps.InfoWindow({
				content: content
			});
			info.open(self.map, marker);
			setTimeout(function () {
				$('#' + random_id).html($form);
			}, 600);
		}

		//Clicking the remove button
		$form.find('button').on('click', function () {

			clickMarker.setMap(null); //removes the marker
			clickMarker.circle.setMap(null);
			self.remove_filters('radius');
		});
		if (typeof post_callback == 'function') {
			post_callback();
		}
	});
};

/**
 *
 * @param type 'radius' / 'type'
 */
AdsMap.prototype.remove_filters = function(type) {
	for (var i in this.filters) {
		var filter = this.filters[i];
		if (!type) {
			delete this.filters[i];
			continue;
		}
		if (filter.hasOwnProperty(type)) {
			delete this.filters[i];
			continue;
		}
	}
	this.run_filters();
};

AdsMap.prototype.run_filters = function () {
	var self = this;
	this.spider.clearMarkers();
	this.markerCluster.clearMarkers();


	//Filter out types first.
	for (var i = 0; i < this.optOptions.markers.length; i++) {

		var displayMarker = true;
		var marker = this.optOptions.markers[i];

		for (var g in this.filters) {

			var filter = this.filters[g];
			if (filter.hasOwnProperty('type')) {
				if (marker.type == filter.type) { //The marker matches the filter type, don't display it
					displayMarker = false;
				}
			}
			if (filter.hasOwnProperty('radius') && filter.radius > 0) {
				//Its a radius filter
				var distance = google.maps.geometry.spherical.computeDistanceBetween(marker.position, filter.position);

				if (distance > filter.radius) {
					//It is outside the radius, do not show it.
					displayMarker = false;
				}
			}
		}
		if (displayMarker) {
			marker.setMap(this.map);
			this.spider.addMarker(marker);
			this.markerCluster.addMarker(marker);
		}else{
			marker.setMap(null);
		}


	}
};


AdsMap.prototype.search_poi = function (allow_multiple, post_callback) {
	var self = this;
	//Before click

	var listener = google.maps.event.addListener(self.map, 'click', function (event) {
		if (!allow_multiple) {
			google.maps.event.removeListener(listener);
		}
		var marker_count = self.searchMarkers.length;
		var holder_id = 'mapping_poi_holder_' + marker_count;

		//Create marker at user dropped position
		var clickMarker = new google.maps.Marker({
			position: event.latLng,
			visible: true,
			map: self.map,
			icon: self.optOptions.urlBase + '/assets/mapping/images/user_marker.png',
			poi_markers: [],
			circle: new google.maps.Circle({
				map: self.map,
				fillColor: self.optOptions.fillColours['search'],
				strokeColor: AdsMap.luminosity(self.optOptions.fillColours['search'], -0.3),
				strokeOpacity: 1,
				strokeWeight: 1,
				visible: false
			})
		});//Use this marker when a user is inputting elements
		clickMarker.circle.bindTo('center', clickMarker, 'position');
		self.searchMarkers.push(clickMarker);

		//Keyword and distance
		$('#mapping_poi_holder').remove();
		var content = '<div style="width: 400px; height: 30px;" id="' + holder_id + '" >Loading...</div>';
		var $form = $(
			'<div>' +
				'<div class="mapping_poi_input">' +
				'<input class="mapping_poi_keyword" type="text" placeholder="Keyword"/>' +
				'<input  class="mapping_poi_radius" type="number" placeholder="Radius (km)" />' +
				'<button onclick="return false; ">Search</button>' +
				'</div>' +
				'<div class="mapping_poi_result" style="display: none">' +
				'Searching For: <span class="label label-default mapping_poi_keyword"></span> &nbsp;' +
				'Within: <span class="label label-default mapping_poi_radius"></span> &nbsp;' +
				'Found: <span class="badge badge-default mapping_poi_results"></span>' +
				'<a class="pull-right" href="javascript:">Edit</a>' +
				'</div>' +
				'</div>'
		);

		//Switch between display and input
		$form.swap = function (show_input, keyword, radius, result_count) {
			if (show_input) {
				this.find('.mapping_poi_input').show();
				this.find('.mapping_poi_result').hide();
			} else {
				this.find('.mapping_poi_input').hide();
				this.find('.mapping_poi_result').show();
				this.find('.mapping_poi_result .mapping_poi_keyword').html(keyword);
				this.find('.mapping_poi_result .mapping_poi_radius').html(Math.floor(radius / 1000) + ' km');
				this.find('.mapping_poi_result .mapping_poi_results').html(result_count);

			}
		}.bind($form);

		//Info window
		var info = new google.maps.InfoWindow({
			content: content
		});
		info.open(self.map, clickMarker);
		$form.find('.mapping_poi_result a').on('click', function () {
			$form.swap(true);
		});
		//Does the search
		$form.find('button').on('click', function () {
			for (var i in clickMarker.poi_markers) {
				clickMarker.poi_markers[i].setMap(null);
			}
			clickMarker.poi_markers = [];
			var $keyword = $form.find('.mapping_poi_keyword');
			var keyword = $keyword.val();
			var $radius = $form.find('.mapping_poi_radius');
			var radius = $radius.val();
			radius = radius * 1000;//Meters
			clickMarker.circle.setRadius(radius);
			clickMarker.circle.setVisible(true);

			$form.swap(false, keyword, radius, 0);
			var _params = {
				radius: radius,
				key: 'AIzaSyBi-335G0k407L2OmkhP583V1Gz5YW6JOE',
				location: event.latLng,
				query: keyword
			}
			var service = new google.maps.places.PlacesService(self.map);
			var poiInfo = new google.maps.InfoWindow({
				content: ''
			});
			service.textSearch(_params, function (data, status) {
				if (status == google.maps.places.PlacesServiceStatus.OK) {
					var valid_results = 0;
					for (var i in data) {
						(function (i) {
							//Check if marker is within radius
							var poi_location = data[i].geometry.location;
							var distance = google.maps.geometry.spherical.computeDistanceBetween(event.latLng, poi_location);

							if (distance <= radius) {
								var marker = new google.maps.Marker({
									map: self.map,
									position: poi_location,
									icon: self.optOptions.urlBase + '/assets/mapping/images/poi_found_marker.png',
									title: data[i].name + '<br/>' + data[i].formatted_address
								});
								clickMarker.poi_markers.push(marker);
								google.maps.event.addListener(marker, 'click', function() {
									poiInfo.setContent(marker.title);
									poiInfo.open(self.map, marker);
								});

								valid_results++;
							}

						})(i);
					}
					$form.swap(false, keyword, radius, valid_results);
				} else {
					$form.swap(false, keyword, radius, 0);
				}

			});

		});
		google.maps.event.addListener(info, 'closeclick', function () {
			clickMarker.setMap(null); //removes the marker
			clickMarker.circle.setMap(null);
			for (var i in clickMarker.poi_markers) {
				clickMarker.poi_markers[i].setMap(null);
			}
			clickMarker.poi_markers = [];
			// then, remove the infowindows name from the array
		});
		setTimeout(function () {
			$('#' + holder_id).html($form);
		}, 900)
		if (typeof post_callback == 'function') {
			post_callback();
		}


	});
};

AdsMap.prototype.snapshot = function (options) {
	options = options || {};
	options = $.extend({}, this.h2cOptions, options);
	var map_id = '#' + this.map.getDiv().getAttribute('id');
	$(map_id).scrollTop(1).parents('.modal').scrollTop(1);
	setTimeout(function() {
		html2canvas($(map_id), options);
	}, 5);

};


AdsMap.prototype.build_map = function () {
	var self = this;
	this.spider = new OverlappingMarkerSpiderfier(this.map, this.spiderOptions);
	this.markerCluster = new MarkerClusterer(this.map, this.optOptions.markers, this.clusterOptions);
	for (var i in this.optOptions.markers) {
		(function (i) {
			var marker = self.optOptions.markers[i];
			if (!marker.icon && marker.type) {
				marker.setIcon(self.optOptions.urlBase + 'assets/mapping/images/media_' + marker.type + '.png');
			}
			self.spider.addMarker(marker);
			//Draw any radius elements required.
			var hasRadius = marker.hasOwnProperty('radius') && !isNaN(marker.radius) && marker.radius > 0;
			var forceShow = marker.force_show_radius;


			if (hasRadius) {
				var circle = new google.maps.Circle({
					//map: self.map,
					radius: marker.radius,
					fillColor: self.optOptions.fillColours[marker.type],
					strokeColor: AdsMap.luminosity(self.optOptions.fillColours[self.optOptions.assetTypes[marker.type]], -0.3),
					strokeOpacity: 1,
					strokeWeight: 1
				});
				self.optOptions.markers[i]._circle = circle;//Store reference to circle.
				circle.bindTo('center', marker, 'position');
				google.maps.event.addListener(circle, 'click', function () {
					circle.setMap(null);
					marker.circleVisible = false;
				});
				if (self.optOptions.showRadii || forceShow) {
					//Display the circle automatically
					circle.setMap(self.map);
				} else {
					//Only show the circle on click
					google.maps.event.addListener(marker, 'click', function () {
						if (marker.circleVisible) {
							circle.setMap(null);
							marker.circleVisible = false;
						} else {
							circle.setMap(self.map);
							marker.circleVisible = true;
						}
					});
				}
			}
		})(i);
	}
	if (self.optOptions.showSearchPOIButton) {
		var searchPOIButton = document.createElement('button');

		searchPOIButton.innerHTML ='Search POI';
		searchPOIButton.className = 'btn btn-default btn-sm';

		searchPOIButton.onclick = function() {
			if (typeof self.optOptions.showSearchPOIButton == 'function') {
				return self.optOptions.showSearchPOIButton();
			}else{
				self.add_message('Please click on the map.', 10);
				self.search_poi();
				return false;
			}

		};
		this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(searchPOIButton);
	}

	if (self.optOptions.showFilterButton) {
		var filterButton = document.createElement('button');
		filterButton.innerHTML = 'Filter By Radius';
		filterButton.className = 'btn btn-default btn-sm';
		filterButton.onclick = function() {
			if (typeof  self.optOptions.showFilterButton == 'function') {
				return self.optOptions.showFilterButton();
			}else{
				self.filter_markers_in_radius();
				self.add_message('Please click on the map.', 10);
				return false;
			}

		}
		this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(filterButton);
	}

	if (self.optOptions.showLegend) {
		var html = this.build_legend();
		this.map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(html);
	}
};

AdsMap.prototype.build_legend = function () {
	var self = this;
	var div = document.createElement('div');
	div.className = 'mapping_legend';
	div.style.background = 'white';
	div.style.backgroundColor = 'rgba(255,255,255,0.6)';
	div.style.padding = '10px';

	var html = '<div style="height: 32px;"><b>Legend</b></div>';
	for (var asset_id in this.optOptions.assetTypes) {
		var asset_name = this.optOptions.assetTypes[asset_id];
		var asset_img = this.optOptions.urlBase + 'assets/mapping/images/' + this.optOptions.assetMedia[asset_id];
		html +=
			'<div class="mapping_legend">' +
				'<input type="checkbox" checked="checked" data-type="' + asset_id + '" id="mapping_legend_asset_' + asset_id + '" /><label for="mapping_legend_asset_' + asset_id + '"><img src="' + asset_img + '" /> ' + asset_name + '</label>' +
				'</div>'
	}
	div.innerHTML = html;
	$(div).find('input').on('change', function () {
		var asset_type_id = $(this).attr('data-type');
		var apply_filter = !$(this).is(':checked');//If the box is unchecked, then apply the filter, otherwise remove it
		
                            
                //for pintos
             //    for(var i = 0; i < document.getElementById("mec_id").length; i++) {
            //        if(document.getElementById("mec_id").options[i].value.charAt(0) == asset_type_id) { 
           //          document.getElementById("mec_id").options[i].selected = true;
            //     }else{
            //         document.getElementById("mec_id").options[i].selected = false;
            //     }
           //      }
                               
                                 
                if (apply_filter) {
			self.filters['type_' + asset_type_id] = {
				type: asset_type_id
			};
		}else{
			delete self.filters['type_' + asset_type_id];
		}
		self.run_filters();
	});
	return div;
};

/**
 * Checks that all the scripts have been loaded.
 */
AdsMap.prototype.check_scripts = function () {
	var required = {
		'MarkerClusterer': 'markerclusterer.js',
		'OverlappingMarkerSpiderfier': 'oms.min.js',
		'html2canvas': 'html2canvas.js'
	};
	for (var objName in required) {
		this.missingScripts[objName] = 1;
		if (!window.hasOwnProperty(objName)) {
			console.log('Script not found ' + objName + ' loading...');
			this.load_script(objName, required[objName]);
			this.allowLoad = false;
		} else {
			//The script has been loaded.
			this.missingScripts[objName] = 0;
		}
	}
};

AdsMap.prototype.load_script = function (key, url) {
	var self = this;
	$.getScript(this.optOptions.urlBase + this.optOptions.jsBase + url, function () {
		self.missingScripts[key] = 0;
	});

};

/** Static Functions */
/**
 * Change the luminosity of a colour
 * @param colour
 * @param luminosity
 * @returns {string}
 */
AdsMap.luminosity = function (colour, luminosity) {
	colour = new String(colour).replace(/[^0-9a-f]/gi, '');
	if (colour.length < 6) {
		colour = colour[0] + colour[0] + colour[1] + colour[1] + colour[2] + colour[2];
	}
	luminosity = luminosity || 0;

	// convert to decimal and change luminosity
	var newColour = "#", c, i, black = 0, white = 255;
	for (i = 0; i < 3; i++) {
		c = parseInt(colour.substr(i * 2, 2), 16);
		c = Math.round(Math.min(Math.max(black, c + (luminosity * white)), white)).toString(16);
		newColour += ("00" + c).substr(c.length);
	}
	return newColour;
};

/** Campaigns */
AdsMap.Campaign = function (adsMap, options, oldCampaign) {
	this.adsMap = adsMap;
	this.options = $.extend({}, {
		url: ''
	}, options);
	this.campaignDetails = $.extend({}, {
		id: 0,
		images: {
			user: {},
			map: {}
		}
	}, oldCampaign);


};

AdsMap.Campaign.prototype.get_new_image_id = function (type) {
	var id = Math.floor(Math.random() * 9999) + 1;
	var images = this.campaignDetails.images[type];

	while (images.hasOwnProperty(id)) {
		id = Math.floor(Math.random() * 9999) + 1;
	}

	images[id] = {};
	return id;

};
AdsMap.Campaign.prototype.edit = function () {
	var self = this;
	var html =
		'<form action="' + this.options.url + '" method="POST">' +
			'<div class="mapping_campaign_holder">' +
			'<div class="loading"></div>' +
			'<div class="mapping_campaign_map_images mapping_campaign_custom_images">' +
			'<div style="width:100%"><h4>Map Images</h4><button class="btn btn-success js-mapping_snapshot" data-loading-text="Loading...">Snapshot Map</button></div>' +
			'</div>' +
			'<div class="mapping_campaign_user_images mapping_campaign_custom_images">' +
			'<div style="width:100%"><h4>Your Images</h4><button class="btn btn-success js-user_image" onclick="return false;" data-loading-text="Loading...">Add Image</button></div>' +
			'</div>' +
			'<button class="btn btn-primary pull-right js-submit">Submit</button>'
	'</div>' +
	'</form>';
	var $html = $(html);
	$html.fix_shadows = function () {
		$html.find('.mapping_campaign_custom_images').hide();
		$html.find('.mapping_campaign_custom_images').each(function () {
			this.offsetHeight
		});
		$html.find('.mapping_campaign_custom_images').show();
	}
	if ($('.mapping_loading').length == 0) {
		$('body').append('<div class="mapping_loading"></div>');
	}
	$html.show_loading = function (show) {
		show = (typeof show == 'undefined') ? true : show;
		if (show) {
			$('.mapping_loading').show();
		} else {
			$('.mapping_loading').hide();
		}
	};
	var $snapshot_btn = $html.find('.js-mapping_snapshot');
	var $add_image = $html.find('.js-user_image');
	var $submit_btn = $html.find('.js-submit');

	$submit_btn.on('click', function () {

		$html.show_loading(true);
		//Check if there are any "file" objects in the campaign, if there are, it means we have to do an old school post.
		var submit_form = false;
		for (var i in self.campaignDetails.images.user) {
			var item = self.campaignDetails.images.user[i];
			if (typeof item.fileInput != 'undefined') {
				submit_form = true;
				break;
			}
		}
		if (submit_form) {
			$html.show_loading(false);
			return true;
		}

		var formData = new FormData();

		formData.append('campaign_id', self.campaignDetails.id);
		//Load User Uploads
		for (var i in self.campaignDetails.images.user) {
			var item = self.campaignDetails.images.user[i];
			var item_id = 'user_' + i;
			formData.append(item_id + '_description', item.description);
			formData.append(item_id + '_image', item.image);
		}
		//Load Map Snapshots
		for (var i in self.campaignDetails.images.map) {
			var item = self.campaignDetails.images.map[i];
			var item_id = 'map_' + i;
			formData.append(item_id + '_description', item.description);
			formData.append(item_id + '_image', item.image);
		}

		$.ajax({
			url: self.options.url,
			type: 'POST',
			data: formData,
			async: false,
			success: function (data) {
				$html.show_loading(false);
				if (typeof self.options.onsuccess == 'function') {
					self.options.onsuccess();
				}
			},
			cache: false,
			contentType: false,
			processData: false
		})
		return false;
		//
	});

	$snapshot_btn.on('click', function () {
		$html.show_loading(true);
		$snapshot_btn.button('loading').attr('disabled', true);
		self.adsMap.snapshot({
			onrendered: function (canvas) {
				//document.body.appendChild( canvas );
				var img = canvas.toDataURL("image/png");
				var $image = AdsMap.Campaign.image(self, img, 'map', self.adsMap.get_filter_text());
				$html.find('.mapping_campaign_map_images').append($image);
				$snapshot_btn.button('reset').attr('disabled', false);
				$html.fix_shadows();
				$html.show_loading(false);

			}
		})
	});

	//<input type="file" accept=".png,.jpeg,.jpg,.bmp"/>
	$add_image.on('click', function () {
		//Add a wrapped file input control
		var $new_input = AdsMap.Campaign.file_input();
		$html.find('.mapping_campaign_user_images').append($new_input);
		var $file_upload = $new_input.find('input');
		//When a user selects a file, replace the temp input with the actual image.
		$file_upload.on('change', function () {
			var files = this.files;
			if (files && files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {

					var img_string = e.target.result;
					var $image = AdsMap.Campaign.image(self, img_string, 'user');
					$new_input.replaceWith($image);
					//This is to redraw the box shadows correctly
					$html.fix_shadows();
				}
				reader.readAsDataURL(files[0]);
			} else {
				var $image = AdsMap.Campaign.image(self, self.adsMap.optOptions.urlBase + 'assets/mapping/images/no-preview.jpg', 'user', '', $new_input.find('input')[0]);
				$new_input.replaceWith($image);
				$html.fix_shadows();
			}
		});
		$new_input.find('input').click();
	});

	return $html;
};

AdsMap.Campaign.file_input = function () {
	var $wrap = $('<div class="mapping_image_wrap"><input type="file" accept=".png,.jpeg,.jpg,.bmp"/></div>');
	return $wrap;
};

AdsMap.Campaign.image = function (campaign, img, type, description, fileInput) {

	var $wrap = $('<div class="mapping_image_wrap"></div>');
	var $remove = $('<a href="javascript:" class="close pull-right"><span class="glyphicon glyphicon-remove" style="color: #f00;"></span></a>');
	$wrap.append($remove);
	description = description || '';
	var $description = $('<textarea placeholder="Description">' + description + '</textarea>');

	var id = campaign.get_new_image_id(type);

	var $img;
	if (typeof img == 'string') {
		//Its a url, chances are this is loading an old campaign
		$img = $('<img src="' + img + '" />');
	} else {
		//It's an image object.
		$img = $(img);
	}
	$img.attr('data-id', id).attr('data-type', type);
	campaign.campaignDetails.images[type][id] = {
		image: img,//Use original blob / url
		description: description,
		fileInput: fileInput//This is only here if the browser is old, we use standard form post of file input
	};

	$description.on('change', function () {
		campaign.campaignDetails.images[type][id].description = $(this).val().trim();
	});

	$wrap.append($img);
	$wrap.append($description);
	$remove.on('click', function () {
		$wrap.remove();
		delete campaign.campaignDetails.images[type][id];
	});
	return $wrap;
};

/** Assets */
AdsMap.Asset = function (options) {

	this.options = $.extend({}, {
		adsMap: false,
		assetType: 0,
		position: false
	}, options);

	this.marker = false;
	this.radius = false;


	(function build(self) {
		var require_radius = false;
		console.log('Use array to find assets that need radius.');
		switch (self.options.assetType) {
			case 6:
			case 7:
				require_radius = true;
				break;
			default:
				require_radius = false;
				break;
		}
		var fillColour = self.options.adsMap.optOptions.fillColours[self.options.adsMap.optOptions.assetTypes[self.options.assetType].toLowerCase()];

		self.marker = new google.maps.Marker({
			position: self.options.position,
			map: self.options.adsMap.map,
			icon: self.options.adsMap.optOptions.urlBase + '/assets/mapping/images/' + self.options.adsMap.optOptions.assetMedia[self.options.assetType],
			circle: new google.maps.Circle({
				map: self.options.adsMap.map,
				fillColor: fillColour,
				strokeColor: AdsMap.luminosity(fillColour, -0.3),
				strokeOpacity: 1,
				strokeWeight: 1,
				visible: false
			})
		});
		self.marker.circle.bindTo('center', self.marker, 'position');
		var div_id = 'mapping_asset_info_' + Math.floor(Math.random() * 99999) + 1;
		var content = '<div id="' + div_id + '"></div>';
		var info = new google.maps.InfoWindow({
			content: content
		});
		setTimeout(function () {

		}, 300);
	})(this);
}

/**
 *
 * @param radius meters
 */
AdsMap.Asset.prototype.draw_radius = function (radius) {
	this.marker.circle.setRadius(radius);
	this.marker.circle.setVisible(true);
};


//Enum of asset types
AdsMap.ASSET_TYPES = {
	0: 'Undefined',
	1: 'Poster',
	2: 'Bench',
	3: 'Bus',
	4: 'Bus',
	5: 'Street Pole',
	6: 'Street Pole',
	7: 'Bill Board',
	8: 'Bill Board',
	9: 'Taxi TV Digital Network',
	10: 'Cafe Digital Network',
	11: 'Magazine Advert',
	12: 'Radio'
};
//Asset id -> image
AdsMap.ASSET_MEDIA = {
	0: 'unknown_asset.png',
	1: 'media_1.png',
	2: 'media_2.png',
	3: 'media_3.png',
	4: 'media_4.png',
	5: 'media_5.png',
	6: 'media_6.png',
	7: 'media_7.png',
	8: 'media_8.png',
	9: 'media_9.png',
	10: 'media_9.png',
	11: 'media_9.png',
	12: 'media_9.png'
};
