@extends('layouts.template')

@section('content')
  <div class="container">
    <div class="card shadow">
      <div class="card-header">
        <h5><i class='fa-solid fa-pen-to-square'></i> Edit Data Photo Geotag</h5>
      </div>
      <div class="card-body">
        <form action="{{ route('update', $id) }}" method="POST">
          @csrf
					@method('PATCH')
          <div class="mb-3">
            <label for="name" class="form-label">Name *</label>
            <input type="text" class="form-control text-primary" id="name" name="name" value="{{ $point['name'] }}" required>
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control text-primary" id="description" name="description" rows="3">{{ $point['description'] }}</textarea>
          </div>
          <div class="mb-3">
						<div class="row">
							<div class="col">
								<label for="latitude" class="form-label">Latitude</label>
								<input class="form-control text-primary" id="latitude" name="latitude" value="{{ $point['latitude'] }}" disabled>
							</div>
							<div class="col">
								<label for="longitude" class="form-label">Longitude</label>
								<input class="form-control text-primary" id="longitude" name="longitude" value="{{ $point['longitude'] }}" disabled>
							</div>
						</div>
          </div>
          <div class="mb-3">
            <img src="{{ asset('storage/images/') . '/' . $point['photo'] }}" id="image-preview" class="img-thumbnail" alt="" width="400">
          </div>
					<div class="mb-3">
						<small class="text-primary"><i>* must be filled</i></small>
					</div>
      </div>
      <div class="card-footer">
				<div class="row">
					<div class="col">
						<a href="{{ route('index') }}" class="btn btn-secondary"><i class="fa-solid fa-circle-xmark"></i> Cancel</a>
					</div>
					<div class="col col-footer-right">
						<button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save</button>
					</div>
				</div>
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
		.col-footer-right {
			text-align: end;
		}
  </style>
@endsection

@section('script')
@endsection
