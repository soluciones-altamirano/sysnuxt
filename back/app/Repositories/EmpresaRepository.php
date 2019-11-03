<?php

namespace App\Repositories;

use App\Models\Empresa;
use App\Repositories\BaseRepository;

/**
 * Class EmpresaRepository
 * @package App\Repositories
 * @version November 3, 2019, 6:28 pm UTC
*/

class EmpresaRepository extends BaseRepository
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
        'slogan'
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
        return Empresa::class;
    }
}
