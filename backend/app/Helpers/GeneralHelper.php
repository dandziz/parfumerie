<?php

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

function convertTypeOfPagination(LengthAwarePaginator $paginate) {
    return [
        "total" => $paginate->total(),
        "per_page" => $paginate->perPage(),
        "current_page" => $paginate->currentPage(),
        "last_page" => $paginate->lastPage(),
    ];
}

function getItems(Request $request, array $query, Builder $builder) {
    foreach ($query as $key => $item) {
        $builder->where($key, 'like', '%'.$item.'%');
    }
    $itemPerPage = $request->has('itemsPerPage') ? (int)$request->get('itemsPerPage') : 10;
    $pageNumber = $request->has('currentPage') ? (int)$request->get('currentPage') : 1;
    $builder = $builder->paginate($itemPerPage, ['*'], 'page', $pageNumber);
    return response()->json([
        "status" => true,
        "message" => __('messages.success'),
        "pagination" => convertTypeOfPagination($builder),
        "data" => $builder->items(),
    ], 200);
}

function getItemsByRelationship(Request $request, HasMany $builder) {
    if ($request->has('sortBy') && $request->has('order')) {
        $builder->orderBy($request->get('sortBy'), $request->get('order'));
    }
    $itemPerPage = $request->has('itemsPerPage') ? (int)$request->get('itemsPerPage') : 10;
    $pageNumber = $request->has('currentPage') ? (int)$request->get('currentPage') : 1;
    $builder = $builder->paginate($itemPerPage, ['*'], 'page', $pageNumber);
    return response()->json([
        "status" => true,
        "message" => __('messages.success'),
        "pagination" => convertTypeOfPagination($builder),
        "data" => $builder->items(),
    ], 200);
}

function getPermissions(Collection $permissions) {
    return array_map(function ($item) {
        return $item['name'];
    }, $permissions->toArray());
}

function returnSuccessResponse($data) {
    return response()->json([
        "status" => true,
        "message" => __('messages.success'),
        "data" => $data,
    ], 201);
}
