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
              onchange="document.getElementById('image-preview').src = window.URL.createObjectURL(this.files[0])">
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
@endsection
