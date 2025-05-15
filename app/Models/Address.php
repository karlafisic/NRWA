<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Address
 * 
 * @property int $address_id
 * @property string $address
 * @property string|null $address2
 * @property string $district
 * @property int $city_id
 * @property string|null $postal_code
 * @property string $phone
 * @property mixed $location  // Promijenjeno iz geometry u mixed
 * @property Carbon $last_update
 * 
 * @property City $city
 * @property Collection|Customer[] $customers
 * @property Collection|Staff[] $staff
 * @property Collection|Store[] $stores
 */
class Address extends Model
{
    protected $table = 'address';
    protected $primaryKey = 'address_id';
    public $timestamps = false;

    protected $casts = [
        'city_id' => 'int',
        'last_update' => 'datetime',
        // Uklonite 'location' => 'geometry' jer uzrokuje probleme
    ];

    protected $fillable = [
        'address',
        'address2',
        'district',
        'city_id',
        'postal_code',
        'phone',
        'location',
        'last_update'
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function customers()
    {
        return $this->hasMany(Customer::class, 'address_id');
    }

    public function staff()
    {
        return $this->hasMany(Staff::class);
    }

    public function stores()
    {
        return $this->hasMany(Store::class, 'address_id');
    }

    /**
     * Accessor za location - pretvara binarni format u koordinate
     */
    public function getLocationAttribute($value)
    {
        if ($value === null) {
            return null;
        }

        $point = \DB::selectOne('SELECT ST_X(?) as longitude, ST_Y(?) as latitude', [$value, $value]);
        return [
            'longitude' => $point->longitude,
            'latitude' => $point->latitude
        ];
    }

    /**
     * Mutator za location - pretvara koordinate u geometrijski format
     */
    public function setLocationAttribute($value)
    {
        if (is_array($value) && isset($value['longitude'], $value['latitude'])) {
            $this->attributes['location'] = \DB::raw(
                "ST_GeomFromText('POINT(" . $value['longitude'] . " " . $value['latitude'] . ")')"
            );
        } elseif ($value === null) {
            $this->attributes['location'] = null;
        }
    }
}