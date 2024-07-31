<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlaceRequest;
use App\Http\Requests\EditPlaceRequest;
use App\Http\Requests\getPlaceRequest;
use App\Repositories\PlaceRepository;
use Illuminate\Http\JsonResponse;

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
     *
     * @param getPlaceRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(getPlaceRequest $request): JsonResponse
    {
        $data = $this->placeRepos->allQuery($request->all())->get()->toArray();
        return $this->sendResponse($data, 'Todos os lugares encontrados');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePlaceRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePlaceRequest $request): JsonResponse
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
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $place = $this->placeRepos->find($id);
        if ($place) {
            return $this->sendResponse($place, 'Local encontrado');
        }
        return $this->sendError('Local não encontrado');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditPlaceRequest $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EditPlaceRequest $request, $id): JsonResponse
    {
        $updated = $this->placeRepos->update($request->all(), $id);
        if ($updated) {
            return $this->sendResponse($updated, 'Local atualizado com sucesso!');
        }
        return $this->sendError('Erro ao atualizar local');
    }
}
