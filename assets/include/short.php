<?php

$rand = rand(1,500);

 ?>

<div id="cds-maps-wp-preview-<?php echo $rand; ?>" style="margin: 30px 0px;width:<?php echo $a['width']; ?>;height:<?php echo $a['height']; ?>;"></div>
<script>
    var centersTXT_<?php echo $rand; ?> = '<?php echo $a['centers']; ?>',
        titlesTXT_<?php echo $rand; ?> = '<?php echo $a['titles']; ?>',
        descsTXT_<?php echo $rand; ?> = '<?php echo $a['descs']; ?>',
        centersSplit_<?php echo $rand; ?> = centersTXT_<?php echo $rand; ?>.split('|'),
        titlesSplit_<?php echo $rand; ?> = titlesTXT_<?php echo $rand; ?>.split('|'),
        descsSplit_<?php echo $rand; ?> = descsTXT_<?php echo $rand; ?>.split('|');

    var geocoder_<?php echo $rand; ?> = new google.maps.Geocoder(),
        map_<?php echo $rand; ?> = new google.maps.Map(document.getElementById('cds-maps-wp-preview-<?php echo $rand; ?>'), {
          zoom: <?php echo $a['zoom']; ?>,
          styles: '',
          mapTypeControl: true,
          zoomControl: true,
          draggable: <?php echo $a['drag'] ?>,
          mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            mapTypeIds: ['roadmap', 'terrain','satellite','hybrid']
          },
        });

    var infowindow_<?php echo $rand; ?> = new google.maps.InfoWindow();

    function addMarker_<?php echo $rand; ?>(addresses,x){
      jQuery.getJSON('http://maps.googleapis.com/maps/api/geocode/json?address='+addresses[x]+'&sensor=false', null, function (data) {
        var p = data.results[0].geometry.location;
        var latlng = new google.maps.LatLng(p.lat, p.lng);
        var name_address = data.results[0].formatted_address;

        var marker_<?php echo $rand; ?> =  new google.maps.Marker({
            position: latlng,
            map: map_<?php echo $rand; ?>,
            animation: google.maps.Animation.DROP
        });

        marker_<?php echo $rand; ?>.addListener('click', function() {
           infowindow_<?php echo $rand; ?>.setContent('<div class="cds-maps-wp"><h3>'+titlesSplit_<?php echo $rand; ?>[x]+'</h3><p>'+descsSplit_<?php echo $rand; ?>[x]+'</p><small>'+name_address+'</small></div>');
           infowindow_<?php echo $rand; ?>.open(map_<?php echo $rand; ?>, this);
        });

      });
    }

    geocoder_<?php echo $rand; ?>.geocode( { 'address': centersSplit_<?php echo $rand; ?>[1] }, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
            var p, name_address,latlng;
            map_<?php echo $rand; ?>.setCenter(results[0].geometry.location);
            for (var i = 0; i < centersSplit_<?php echo $rand; ?>.length; i++) {
              addMarker_<?php echo $rand; ?>(centersSplit_<?php echo $rand; ?>,i);
            }
          } else {
            alert("No results found");
          }
        }else {
          alert("Please set address: " + status);
        }
    });
</script>
