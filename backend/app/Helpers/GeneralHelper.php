<?php

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

function convertTypeOfPagination(LengthAwarePaginator $paginate): array
{
    return [
        "total" => $paginate->total(),
        "per_page" => $paginate->perPage(),
        "current_page" => $paginate->currentPage(),
        "last_page" => $paginate->lastPage(),
    ];
}

function getItems(Request $request, array $query, Builder $builder): \Illuminate\Contracts\Pagination\LengthAwarePaginator
{
    if ($request->has('sortBy') && $request->has('order')) {
        $builder->orderBy($request->get('sortBy'), $request->get('order'));
    }
    $itemPerPage = $request->has('itemsPerPage') ? (int)$request->get('itemsPerPage') : 10;
    $pageNumber = $request->has('currentPage') ? (int)$request->get('currentPage') : 1;
    return $builder->paginate($itemPerPage, ['*'], 'page', $pageNumber);
}

function returnItemsWithPagination($builder, $items): JsonResponse
{
    return response()->json([
        "status" => true,
        "message" => __('messages.success'),
        "pagination" => convertTypeOfPagination($builder),
        "data" => $items,
    ], 200);
}

function getItemsByRelationship(Request $request, HasMany $builder): JsonResponse
{
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

function getPermissions(Collection $permissions): array
{
    return array_map(function ($item) {
        return $item['name'];
    }, $permissions->toArray());
}

function returnSuccessResponse($data, $status = 200): JsonResponse
{
    return response()->json([
        "status" => true,
        "message" => __('messages.success'),
        "data" => $data,
    ], $status);
}

function returnMessageResponse($message, $status = 200): JsonResponse
{
    return response()->json([
        "status" => true,
        "message" => $message,
    ], $status);
}

function returnFailureResponse($message, $status = 500): JsonResponse
{
    return response()->json([
        "status" => false,
        "message" => $message,
    ], $status);
}

function getMoneyFormat($price): string
{
    if (!is_float($price))
        return number_format($price, 0, ',', '.').'₫';
    else
        return number_format($price, 2, '.', ',').'₫';
}
