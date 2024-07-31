<?php

namespace App\Repositories;

use App\Models\Place;
use App\Repositories\BaseRepository;

/**
 * Class ApplianceLineRepository
 * @package App\Repositories
 * @version August 14, 2020, 4:04 pm UTC
*/

class PlaceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'city_id',
        'state_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Place::class;
    }
}
