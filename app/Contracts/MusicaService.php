<?php

namespace App\Contracts;

interface MusicaService
{
	public function getArtistas(string $banda);
	public function getDiscografia(string $idBanda);
}