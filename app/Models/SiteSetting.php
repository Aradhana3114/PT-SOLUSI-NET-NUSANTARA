<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $guarded = [];

    public static function current(): self
    {
        return static::query()->firstOrCreate([], ['site_name' => 'PT Solusi Nusantara']);
    }

    /**
     * Koordinat untuk peta di halaman kontak: dari kolom latitude/longitude,
     * atau dicoba diambil dari maps_url jika berisi koordinat.
     *
     * @return array{lat: float, lng: float}|null
     */
    public function mapCoordinates(): ?array
    {
        if (is_numeric($this->latitude) && is_numeric($this->longitude)) {
            return ['lat' => (float) $this->latitude, 'lng' => (float) $this->longitude];
        }

        $url = (string) $this->maps_url;

        if (
            preg_match('/@(-?\d+\.\d+),(-?\d+\.\d+)/', $url, $m)
            || preg_match('/!3d(-?\d+\.\d+)!4d(-?\d+\.\d+)/', $url, $m)
            || preg_match('/[?&](?:q|query|ll)=(-?\d+\.\d+),(-?\d+\.\d+)/', $url, $m)
        ) {
            return ['lat' => (float) $m[1], 'lng' => (float) $m[2]];
        }

        return null;
    }
}
