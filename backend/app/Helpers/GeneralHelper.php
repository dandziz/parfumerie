<?php

use Illuminate\Database\Eloquent\Builder;
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
    $itemPerPage = $request->has('itemPerPage') ? (int)$request->get('itemPerPage') : 10;
    $pageNumber = $request->has('page') ? (int)$request->get('page') : 1;
    $builder = $builder->paginate($itemPerPage, ['*'], 'page', $pageNumber);
    return response()->json([
        "status" => true,
        "message" => __('success'),
        "pagination" => convertTypeOfPagination($builder),
        "data" => $builder->items(),
    ], 200);
}
