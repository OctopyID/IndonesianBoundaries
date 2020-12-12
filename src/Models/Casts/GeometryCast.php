<?php /** @noinspection PhpMissingParamTypeInspection */

namespace Octopy\Indonesian\Boundaries\Models\Casts;

use Illuminate\Database\Eloquent\Model;
use Octopy\Indonesian\Boundaries\Models\CityGeometry;
use Octopy\Indonesian\Boundaries\Models\ProvinceGeometry;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class GeometryCast implements CastsAttributes
{
    /**
     * @param  Model  $model
     * @param  string $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed|void
     * @noinspection PhpUndefinedVariableInspection
     */
    public function get($model, string $key, $value, array $attributes)
    {
        if ($model instanceof ProvinceGeometry) {
            $meta = $model->province->meta;
        } else if ($model instanceof CityGeometry) {
            $meta = $model->city->meta;
        }

        return array_merge([
            'center' => [
                'lat' => $meta['lat'],
                'lng' => $meta['long'],
            ],
        ], json_decode(json_encode($value->jsonSerialize()), true));
    }

    /**
     * @param  Model  $model
     * @param  string $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed|void
     */
    public function set($model, string $key, $value, array $attributes)
    {
        //
    }
}