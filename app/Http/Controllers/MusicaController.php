<?php

namespace App\Http\Controllers;

use App\Adapters\SpotifyAdapter;
use App\Http\Resources\MusicaResource;

class MusicaController extends Controller
{
	private $spotifyAdapter;

	public function __construct(SpotifyAdapter $spotifyAdapter)
	{
		$this->spotifyAdapter = $spotifyAdapter;
	}

	public function getArtistas()
	{
		$banda = request()->get('q');

		$artistas = $this->spotifyAdapter->getArtistas($banda);

		return response()->json($artistas);
	}

	public function getDiscografia()
	{
		$idBanda = request()->get('q');

		$discografia = $this->spotifyAdapter->getDiscografia($idBanda);

		return MusicaResource::make($discografia);
	}
}
