@extends('layouts.template')

@section('content')
  <div id="map"></div>
@endsection

@section('style')
<style>
	#map {
		margin-top: 55px;
		height: calc(100vh - 56px);
		width: 100%;
	}

	.leaflet-popup {
		width: 340px;
	}
</style>
@endsection

@section('script')
<script>
	// init map
	var map = L.map('map').setView([-7.7911905, 110.3708839], 14);

	// init basemap
	var basemap = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 18,
		attribution: '<a href="https://unsorry.net" target="_blank">unsorry@2024</a>',
	});

	// add basemap to map
	basemap.addTo(map);

	/* GeoJSON Points */
	var points = L.geoJson(null, {
      onEachFeature: function(feature, layer) {
        var popupContent = "<h5>" + feature.properties.name + "</h5>" +
          "<p>" + feature.properties.description + "</p>" +
          "<p>Coordinates: " + feature.geometry.coordinates + "</p>" +
					"<p>Created at: " + feature.properties.created_at + "</p>" +
          "<p><img src='{{ asset('storage/images') }}/" + feature.properties.photo +
          "' class='img-thumbnail' alt=''></p>" +
          "<hr>" +
          "<div class='d-flex flex-row'>" +
          "<form action='{{ url('/destroy/') }}/" + feature.properties.id + "' method='POST'>" +
          '{{ csrf_field() }}' + '{{ method_field('DELETE') }}' +
          "<button type='submit' class='btn btn-sm btn-danger text-light' onclick='return confirm(`Are you sure you want to delete point " +
        feature.properties.name + "?`)' title='Delete'><i class='fa-solid fa-trash-can'></i></button>" +
          "</form>" +
          "</div>";
        layer.on({
          click: function(e) {
            points.bindPopup(popupContent);
          },
          mouseover: function(e) {
            points.bindTooltip(feature.properties.name);
          },
        });
      },
    });
    $.getJSON("{{ route('geojson.points') }}", function(data) {
      points.addData(data);
      map.addLayer(points);
			map.fitBounds(points.getBounds());
    });
</script>
@endsection