<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title }}</title>
  <link href="https://unsorry.net/assets-date/images/favicon.png" rel="shortcut icon" type="image/png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  @yield('style')
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark fixed-top" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><i class="fa-solid fa-camera-retro"></i> {{ $title }}</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{ route('index') }}"><i
                class="fa-solid fa-map-location-dot"></i> Map</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{ route('upload') }}"><i
                class="fa-solid fa-upload"></i> Upload</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#infoModal"><i
                class="fa-solid fa-circle-info"></i> Info</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  @yield('content')

  <!-- Modal Info -->
  <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="infoModalLabel"><i class="fa-solid fa-circle-info"></i> Info</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row mb-4">
            <div class="col">
              <h5 class="mb-3">Leaflet CRUD PostgreSQL Laravel</h5>
              <p class="mb-0">Stack:</p>
              <ul>
                <li>PHP Framework Laravel</li>
                <li>PostgreSQL - PostGIS</li>
              </ul>
              <p class="mb-0">Library:</p>
              <ul>
                <li>Leaflet JS</li>
                <li>Leaflet Draw</li>
                <li>ESRI Terraformer WKT Parser</li>
                <li>Bootstrap 5</li>
                <li>Font Awesome 6</li>
              </ul>
            </div>
          </div>

          <div class="row">
            <div class="col text-end">
              <small><a href="https://unsorry.net" target="_blank"
                  class="text-decoration-none text-secondary">unsorry@2024</a></small>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
						class="fa-solid fa-circle-xmark"></i> Close</button>
        </div>
      </div>
    </div>
  </div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js" integrity="sha512-7Pi/otdlbbCR+LnW+F7PwFcSDJOuUJB3OxtEHbg4vSMvzvJjde4Po1v4BR9Gdc9aXNUNFVUY+SK51wWT8WF0Gg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  @include('components.toast')
  @yield('script')
</body>

</html>
