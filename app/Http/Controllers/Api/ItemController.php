<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Services\ItemService;
use Illuminate\Http\JsonResponse;

class ItemController extends Controller
{
    public function __construct(private readonly ItemService $service) {}

    public function index()
    {
        return ItemResource::collection($this->service->paginate());
    }

    public function store($request): ItemResource
    {
        return new ItemResource($this->service->create($request->validated()));
    }

    public function show(int $id): ItemResource
    {
        return new ItemResource($this->service->findOrFail($id));
    }

    public function update($request, int $id): ItemResource
    {
        return new ItemResource($this->service->update($id, $request->validated()));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }
}
