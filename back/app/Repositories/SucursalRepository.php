<?php

namespace App\Repositories;

use App\Models\Sucursal;
use App\Repositories\BaseRepository;

/**
 * Class SucursalRepository
 * @package App\Repositories
 * @version November 3, 2019, 10:07 pm UTC
*/

class SucursalRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'direccion',
        'telefono',
        'email',
        'slug',
        'empresa_id'
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
        return Sucursal::class;
    }
}
