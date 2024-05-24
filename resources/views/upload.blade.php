@extends('layouts.template')

@section('content')
  <div class="container">
    <div class="card shadow">
      <div class="card-header">
        <h5><i class="fa-solid fa-upload"></i> Upload Photo Geotag</h5>
      </div>
      <div class="card-body">
        <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label">Name *</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label for="photo" class="form-label">Photo *</label>
            <input type="file" class="form-control" id="photo" name="photo"
              onchange="uploadimage()">
          </div>
					<div class="mb-3">
						<div class="row">
							<div class="col">
								<label for="latitude" class="form-label">Latitude</label>
								<input type="text" class="form-control" id="latitude" name="latitude" readonly>
							</div>
							<div class="col">
								<label for="longitude" class="form-label">Longitude</label>
								<input type="text" class="form-control" id="longitude" name="longitude" readonly>
							</div>
						</div>
					</div>
          <div class="mb-3">
            <img id="image-preview" class="img-thumbnail border border-0" alt="" width="400">
          </div>
					<div class="mb-3">
						<small class="text-primary"><i>* must be filled</i></small>
					</div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save</button>
        </form>
      </div>
    </div>
		<div class="text-center mt-3">
			<small><i><a href="https://unsorry.net" target="_blank" class="text-decoration-none text-secondary">unsorry@2024</a></i></small>
		</div>
  </div>
@endsection

@section('style')
  <style>
    .container {
      margin-top: 100px;
      margin-bottom: 50px;
    }
		.card-footer {
			text-align: end;
		}
  </style>
@endsection

@section('script')
<script>
	function uploadimage() {
		// get file photo
		var photo = document.getElementById('photo');
		var filephoto = photo.files[0];

		// set preview image
		document.getElementById('image-preview').src = window.URL.createObjectURL(filephoto);

		// get exif data
		var exif = EXIF.getData(filephoto, function() {
			// check if photo has GPS data
			if (this.exifdata.GPSLatitude === undefined || this.exifdata.GPSLongitude === undefined) {
				alert('Your photo does not have GPS data. Please upload another photo.');
				return;
			} else {
				// get latitude and longitude
				var latitude = EXIF.getTag(this, "GPSLatitude");
				var longitude = EXIF.getTag(this, "GPSLongitude");
	
				// check if latitude is negative and convert DMS to DD
				if (EXIF.getTag(this, "GPSLatitudeRef") == "S") {
					lat = -1*(latitude[0] + latitude[1] / 60 + latitude[2] / 3600);
				} else {
					lat = latitude[0] + latitude[1] / 60 + latitude[2] / 3600;
				}

				// check if longitude is negative and convert DMS to DD
				if (EXIF.getTag(this, "GPSLongitudeRef") == "W") {
					lon = -1*(longitude[0] + longitude[1] / 60 + longitude[2] / 3600);
				} else {
					lon = longitude[0] + longitude[1] / 60 + longitude[2] / 3600;
				}
	
				// set value to input
				document.getElementById('latitude').value = lat.toFixed(7);
				document.getElementById('longitude').value = lon.toFixed(7);
			}
		});

	}
</script>
@endsection
