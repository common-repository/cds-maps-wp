jQuery(document).ready(function(){

    var input = document.getElementById('search-location');
    var searchBox = new google.maps.places.SearchBox(input);

    searchBox.addListener('places_changed', function() {
      var locations_result = jQuery('#search-location').val();
      jQuery('.locations').append('<div class="location"><div><span class="center">'+locations_result+'</span><i class="fa fa-times" aria-hidden="true"></i></div><div class="details"><input type="text" placeholder="Title"><textarea placeholder="Description"></textarea></div></div>');
      jQuery('.fa-times').click(function(){
        jQuery(this).closest('.location').remove();
      });
      jQuery('#search-location').val('');
    });

    jQuery('[href="#preview-3"]').click(function(){
          var markers = new Array([{'center': 'center','title':'title','desc':'description'}]);
          jQuery('.locations').find('.location').each(function(){
              var $this  = jQuery(this),
                  center = $this.find('.center').html(),
                  title  = ( $this.find('input').val() ) != 0 ? $this.find('input').val() : '',
                  description =  ( $this.find('textarea').val() ) != 0 ? $this.find('textarea').val() : '';
                  markers.push({'center': center,'title':title,'desc':description});
          });
          if ( markers.length > 1 ) {
            var jsonString = jQuery.parseJSON( jQuery('#json-style').val() );
            var zoomString = parseInt(jQuery('#zoom').val());
            var dragString = ( jQuery('#draggable:checked').val() == 'false' ? false : true);

            var geocoder = new google.maps.Geocoder(),
                map = new google.maps.Map(document.getElementById('map_preview'), {
                  zoom: zoomString,
                  styles: jsonString,
                  mapTypeControl: true,
                  zoomControl: true,
                  draggable: dragString,
                  mapTypeControlOptions: {
                    style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                    mapTypeIds: ['roadmap', 'terrain','satellite','hybrid']
                  },
                });

            var infowindow = new google.maps.InfoWindow();

            function addMarker(addresses,x){
              jQuery.getJSON('http://maps.googleapis.com/maps/api/geocode/json?address='+addresses[x]['center']+'&sensor=false', null, function (data) {
                var p = data.results[0].geometry.location;
                var latlng = new google.maps.LatLng(p.lat, p.lng);
                var name_address = data.results[0].formatted_address;

                var marker =  new google.maps.Marker({
                    position: latlng,
                    map: map,
                    animation: google.maps.Animation.DROP
                });

                marker.addListener('click', function() {
                   infowindow.setContent('<div class="cds-maps-wp"><h3>'+markers[x]['title']+'</h3><p>'+markers[x]['desc']+'</p><small>'+name_address+'</small></div>');
                   infowindow.open(map, this);
                });

              });
            }

            geocoder.geocode( { 'address': markers[1]['center'] }, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
                  var p, name_address,latlng;
                  map.setCenter(results[0].geometry.location);
                  for (var i = 0; i < markers.length; i++) {
                    addMarker(markers,i);
                  }
                } else {
                  alert("No results found");
                }
              }else {
                alert("Please set address: " + status);
              }
            });
          }else{
            alert('Please insert an address');
          }
    });

    jQuery( "#tabs" ).tabs();

    jQuery('button[name="button_gen_short_wp-maps-cds"]').click(function(){

       var ifDrag  = ( jQuery('#draggable:checked').val() == 'false' ? 'false' : 'true'),
           Zx      = ( jQuery('#zoom').val() ? jQuery('#zoom').val() : '14' ),
           Wx      = ( jQuery('#width').val() ? jQuery('#width').val() : '300px' ),
           Hx      = ( jQuery('#height').val() ? jQuery('#height').val() : '300px' ),
           centers = new Array(),
           titles  = new Array(),
           descs   = new Array();

       jQuery('.locations').find('.location').each(function(){
           var $this  = jQuery(this),
               center = $this.find('.center').html(),
               title  = ( $this.find('input').val() ) != 0 ? $this.find('input').val() : ' ',
               description =  ( $this.find('textarea').val() ) != 0 ? $this.find('textarea').val() : ' ';

               centers.push(center);
               titles.push(title);
               descs.push(description);

       });

       var html = '[cds-maps-wp-code centers="'+centers.join('|')+'" titles="'+titles.join('|')+'" descs="'+descs.join('|')+'" drag="'+ifDrag+'" zoom="'+Zx+'" width="'+Wx+'" height="'+Hx+'"]';

       jQuery('.cds-maps-wp-box').find('.results').find('code').html(html);
    });

});
