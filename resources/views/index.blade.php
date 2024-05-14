@extends('layouts.template')

@section('content')
  <div id="map"></div>

	<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1000; margin-bottom: 20px;">
    <div id="noDataToast" class="toast align-items-center text-bg-warning border-0" role="alert"
      aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">
          No data points
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
          aria-label="Close"></button>
      </div>
    </div>
  </div>
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
	var map = L.map('map').setView([-2.6111900,118.6523400], 5);

	// init basemap
	var basemap = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 18,
		attribution: '<a href="https://unsorry.net" target="_blank" class="text-decoration-none">unsorry@2024</a>',
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
					"<p>Updated at: " + feature.properties.updated_at + "</p>" +
          "<p><img src='{{ asset('storage/images') }}/" + feature.properties.photo +
          "' class='img-thumbnail' alt=''></p>" +
          "<hr>" +
          "<div class='d-flex flex-row'>" +
						"<a href='{{ url('edit') }}/" + feature.properties.id + "' class='btn btn-sm btn-warning me-2 text-dark' role='button' title='Edit'><i class='fa-solid fa-pen-to-square'></i></a>" +
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
			if (points.getLayers().length) {
				map.fitBounds(points.getBounds());
			} else {
				console.log('No data points');
				var toastLive = document.getElementById('noDataToast')
				var toast = new bootstrap.Toast(toastLive)

				toast.show()
			}
		});
</script>
@endsection