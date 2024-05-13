<?php

namespace App\Http\Controllers;

use App\Models\Geotag;
use Illuminate\Http\Request;

class ApiController extends Controller
{
  public function __construct()
	{
		$this->geotag = new Geotag();
	}

	public function points()
	{
		$geotags = $this->geotag->all();
		$features = [];
		foreach ($geotags as $geotag) {
			$features[] = [
				'type' => 'Feature',
				'geometry' => [
					'type' => 'Point',
					'coordinates' => [
						$geotag->longitude,
						$geotag->latitude,
					],
				],
				'properties' => [
					'id' => $geotag->id,
					'name' => $geotag->name,
					'description' => $geotag->description,
					'photo' => $geotag->photo,
				],
			];
		}
		$geojson = [
			'type' => 'FeatureCollection',
			'features' => $features,
		];
		return response()->json($geojson)->setEncodingOptions(JSON_NUMERIC_CHECK);
	}
}