<?php

namespace App\Http\Controllers;

use App\Models\Geotag;
use Illuminate\Http\Request;

class GeotagController extends Controller
{
	public function __construct()
	{
		$this->geotag = new Geotag();

		// Function to convert GPS coordinates from DMS (Degrees, Minutes, Seconds) to decimal
		function gps2Num($coordPart)
		{
			$parts = explode('/', $coordPart);
			if (count($parts) <= 0)
				return 0;
			if (count($parts) == 1)
				return $parts[0];
			return floatval($parts[0]) / floatval($parts[1]);
		}
	}
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$data = [
			'title' => 'Geotag Photos',
			'page' => 'geotag-photos',
		];

		return view('index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$data = [
			'title' => 'Upload Photo',
			'page' => 'upload-photo',
		];

		return view('upload', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$request->validate([
			'photo' => 'mimes:jpg,jpeg,png,bmp,gif|max:2048'
		], [
			'photo.mimes' => 'The image must be a file of type: jpg, jpeg, png, bmp, gif',
			'photo.max' => 'The image may not be greater than 2048 kilobytes',
		]);

		// if directory not exist create directory
		if (!is_dir('storage/images')) {
			mkdir('./storage/images', 0777);
		}

		if ($request->hasFile('photo')) {
			$photo = $request->file('photo');
			$exif = exif_read_data($photo, 0, true);

			if ($exif && isset($exif['GPS'])) {
				$GPSLatitudeRef = $exif['GPS']['GPSLatitudeRef'];
				$GPSLatitude    = $exif['GPS']['GPSLatitude'];
				$GPSLongitudeRef = $exif['GPS']['GPSLongitudeRef'];
				$GPSLongitude   = $exif['GPS']['GPSLongitude'];

				$lat_degrees = count($GPSLatitude) > 0 ? gps2Num($GPSLatitude[0]) : 0;
				$lat_minutes = count($GPSLatitude) > 1 ? gps2Num($GPSLatitude[1]) : 0;
				$lat_seconds = count($GPSLatitude) > 2 ? gps2Num($GPSLatitude[2]) : 0;

				$lon_degrees = count($GPSLongitude) > 0 ? gps2Num($GPSLongitude[0]) : 0;
				$lon_minutes = count($GPSLongitude) > 1 ? gps2Num($GPSLongitude[1]) : 0;
				$lon_seconds = count($GPSLongitude) > 2 ? gps2Num($GPSLongitude[2]) : 0;

				$lat_direction = ($GPSLatitudeRef == 'W' or $GPSLatitudeRef == 'S') ? -1 : 1;
				$lon_direction = ($GPSLongitudeRef == 'W' or $GPSLongitudeRef == 'S') ? -1 : 1;

				$latitude = $lat_direction * ($lat_degrees + ($lat_minutes / 60) + ($lat_seconds / (60 * 60)));
				$longitude = $lon_direction * ($lon_degrees + ($lon_minutes / 60) + ($lon_seconds / (60 * 60)));
			} else {
				return redirect()->back()->with('error', 'Failed to create location from geotag photo, your photo is not a geotagged photo.');
			}

			$photo_name = "photo_" . time() . "." . strtolower($photo->getClientOriginalExtension());
			$photo->move('storage/images', $photo_name);

			
		} else {
			return redirect()->back()->with('error', 'Failed to create location from geotag photo');
		}

		$data = [
			'name' => $request->name,
			'description' => $request->description,
			'latitude' => $latitude,
			'longitude' => $longitude,
			'photo' => $photo_name,
		];

		if (!$this->geotag->create($data)) {
			return redirect()->back()->with('error', 'Failed to create geotag photo');
		}

		return redirect()->to(route('index'))->with('success', 'Location from geotag photo created successfully');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		$data = [
			'title' => 'Edit Data',
			'page' => 'edit-data',
			'id' => $id,
			'point' => $this->geotag->find($id),
		];

		return view('edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$data = [
			'name' => $request->name,
			'description' => $request->description,
		];

		if (!$this->geotag->find($id)->update($data)) {
			return redirect()->back()->with('error', 'Failed to update data geotag photo');
		}

		return redirect()->to(route('index'))->with('success', 'Data geotag photo updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$photo = $this->geotag->find($id)->photo;

		if (!$this->geotag->destroy($id)) {
			return redirect()->back()->with('error', 'Failed to delete point geotag photo');
		}

		if ($photo != null) {
			unlink('storage/images/' . $photo);
		}

		return redirect()->back()->with('success', 'Data point geotag photo deleted successfully');
	}
}
