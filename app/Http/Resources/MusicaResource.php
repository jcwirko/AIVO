<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MusicaResource extends JsonResource
{
	public function toArray($request)
	{
		$albumsData = parent::toArray($request);
		$data = [];

		if(isset($albumsData['items'])) {
			foreach($albumsData['items'] as $item) {
				$data[] = [
					'name' => $item['name'],
					'release' => $item['release_date'] ?? null,
					'tracks' => $item['total_tracks'] ?? null,
					'cover' => $this->getCovers($item)
				];
			}
		}

		return $data;
	}

	private function getCovers($covers)
	{
		$data = [];
		$images = $covers['images'] ?? null;

		if(!is_null($images)) {
			foreach($images as $image) {
				$data[] = [
					'height' => $image['height'],
					'width' => $image['width'],
					'url' => $image['url'],
				];
			}
		}

		return $data;
	}
}
