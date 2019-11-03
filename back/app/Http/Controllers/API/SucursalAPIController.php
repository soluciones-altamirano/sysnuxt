<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSucursalAPIRequest;
use App\Http\Requests\API\UpdateSucursalAPIRequest;
use App\Models\Sucursal;
use App\Repositories\SucursalRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SucursalController
 * @package App\Http\Controllers\API
 */

class SucursalAPIController extends AppBaseController
{
    /** @var  SucursalRepository */
    private $sucursalRepository;

    public function __construct(SucursalRepository $sucursalRepo)
    {
        $this->sucursalRepository = $sucursalRepo;
    }

    /**
     * Display a listing of the Sucursal.
     * GET|HEAD /sucursals
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $sucursals = $this->sucursalRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($sucursals->toArray(), 'Sucursals retrieved successfully');
    }

    /**
     * Store a newly created Sucursal in storage.
     * POST /sucursals
     *
     * @param CreateSucursalAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSucursalAPIRequest $request)
    {

        $request->merge(['empresa_id' => 1]);

        $sucursal = $this->sucursalRepository->create($request->all());

        return $this->sendResponse($sucursal->toArray(), 'Sucursal saved successfully');
    }

    /**
     * Display the specified Sucursal.
     * GET|HEAD /sucursals/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Sucursal $sucursal */
        $sucursal = $this->sucursalRepository->find($id);

        if (empty($sucursal)) {
            return $this->sendError('Sucursal not found');
        }

        return $this->sendResponse($sucursal->toArray(), 'Sucursal retrieved successfully');
    }

    /**
     * Update the specified Sucursal in storage.
     * PUT/PATCH /sucursals/{id}
     *
     * @param int $id
     * @param UpdateSucursalAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSucursalAPIRequest $request)
    {



        /** @var Sucursal $sucursal */
        $sucursal = $this->sucursalRepository->find($id);

        if (empty($sucursal)) {
            return $this->sendError('Sucursal not found');
        }

        $request->merge(['empresa_id' => 1]);

        $sucursal = $this->sucursalRepository->update($request->all(), $id);

        return $this->sendResponse($sucursal->toArray(), 'Sucursal updated successfully');
    }

    /**
     * Remove the specified Sucursal from storage.
     * DELETE /sucursals/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Sucursal $sucursal */
        $sucursal = $this->sucursalRepository->find($id);

        if (empty($sucursal)) {
            return $this->sendError('Sucursal not found');
        }

        $sucursal->delete();

        return $this->sendResponse($id, 'Sucursal deleted successfully');
    }
}
