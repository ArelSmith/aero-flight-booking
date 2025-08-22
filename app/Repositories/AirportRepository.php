<?php

namespace App\Repositories;

use App\Models\Airport;
use App\Interfaces\AirportRepositoryInterface;

class AirportRepository implements AirportRepositoryInterface {
  public function getAllAirports()
  {
    return Airport::all();
  }

  public function getAirportBySlug($slug)
  {
    return Airport::where('slug', $slug)->first();
  }

  public function getAirportByIataCode($iataCode)
  {
    return Airport::where('iata_code', $iataCode)->first();
  }
}