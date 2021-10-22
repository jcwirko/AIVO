<?php

namespace App\Adapters;

use App\Contracts\MusicaService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SpotifyAdapter implements MusicaService
{
	private $clientId;
	private $clientSecret;
	private $apiUrl;
	private $accountsUrl;
	private $token;

	public function __construct()
	{
		$this->clientId = config('services.spotify.client_id');
		$this->clientSecret = config('services.spotify.client_secret');
		$this->apiUrl = config('services.spotify.api_url');
		$this->accountsUrl = config('services.spotify.accounts_url');
		$this->token = $this->getToken();
	}

	public function getArtistas(string $banda)
	{
		try {
			$response = Http::asForm()->withHeaders(['Authorization' => $this->token])
				->get("{$this->apiUrl}search", [
					'type' => 'artist',
					'q' => $banda
				]);

			return $response->json();
		} catch(\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function getDiscografia(string $idBanda)
	{
		try {
			$response = Http::asForm()->withHeaders(['Authorization' => $this->token])
				->get("{$this->apiUrl}artists/{$idBanda}/albums");

			return $response->json();
		} catch(\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	private function getToken()
	{
		$token = Cache::get('spotify-token');

		if(is_null($token)) {
			try {
				$response = Http::asForm()->withHeaders([
					'Authorization' => "Basic " . base64_encode("$this->clientId:$this->clientSecret"),
				])->post("{$this->accountsUrl}token", [
					'grant_type' => 'client_credentials'
				]);

				$token = "{$response['token_type']} {$response['access_token']}";

				Cache::put('spotify-token', " $token", $response['expires_in']);
			} catch(\Exception $e) {
				Log::error($e->getMessage());
			}
		}

		return $token;
	}
}