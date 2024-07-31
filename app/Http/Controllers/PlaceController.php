<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlaceRequest;
use App\Http\Requests\EditPlaceRequest;
use App\Http\Requests\getPlaceRequest;
use App\Repositories\PlaceRepository;

class PlaceController extends BaseController
{
    /**
     * @var PlaceRepository
     */
    private $placeRepos = null;

    public function __construct(PlaceRepository $placeRepository)
    {
        $this->placeRepos = $placeRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(getPlaceRequest $request)
    {
        $data = $this->placeRepos->allQuery($request->all())->get()->toArray();
        return $this->sendResponse($data, 'Todos os lugares encontrados');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlaceRequest $request)
    {
        $created = $this->placeRepos->create(
            [
                'name' => $request->name,
                'state_id' => $request->state_id,
                'city_id' => $request->city_id,
            ]
        );
        if ($created) {
            return $this->sendResponse($created, 'Local criado com sucesso!');
        }
        return $this->sendError('Erro ao criar local');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $place = $this->placeRepos->find($id);
        if ($place) {
            return $this->sendResponse($place, 'Local encontrado');
        }
        return $this->sendError('Local não encontrado');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditPlaceRequest $request, $id)
    {
        $updated = $this->placeRepos->update($request->all(), $id);
        if ($updated) {
            return $this->sendResponse($updated, 'Local atualizado com sucesso!');
        }
        return $this->sendError('Erro ao atualizar local');
    }
}
