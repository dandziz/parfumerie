<?php

use Illuminate\Pagination\LengthAwarePaginator;

function convertTypeOfPagination(LengthAwarePaginator $paginate) {
    return [
        "total" => $paginate->total(),
        "per_page" => $paginate->perPage(),
        "current_page" => $paginate->currentPage(),
        "last_page" => $paginate->lastPage(),
    ];
}
