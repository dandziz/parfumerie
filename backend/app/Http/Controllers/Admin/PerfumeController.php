<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\InternalServerErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Perfume\AddImagesRequest;
use App\Http\Requests\Admin\Perfume\UpdateImageIndexRequest;
use App\Http\Requests\Admin\Perfume\UpdatePerfumeRequest;
use App\Models\Perfume;
use App\Services\ImageService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfumeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->except(['itemPerPage', 'page']);
        $perfumes = Perfume::query();
        return getItems($request, $query, $perfumes);
    }

    /**
     * Store a newly created resource in storage.
     * @throws InternalServerErrorException
     */
    public function store(UpdateImageIndexRequest $request): JsonResponse
    {
        $user = Auth::guard('api')->user();
        $data = $request->validated() + ['user_id' => $user->id];
        try {
            $perfume = Perfume::query()->create($data);
            if ($request->images && count($request->images) > 0) {
                (new ImageService())->storeProductImages($request->images, $perfume);
            }
            $array = json_decode($request->get('price'));
            if (is_array($array)) {
                foreach ($array as $price) {
                    $perfume->price()->create([
                        'perfume_id' => $perfume->id,
                        'capacity' => $price[0],
                        'import_price' => $price[1],
                        'price' => $price[2],
                    ]);
                }
            }
            return returnSuccessResponse($perfume, 201);
        } catch (Exception $exception) {
            throw new InternalServerErrorException();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Perfume $perfume)
    {
        //
    }

    public function getImages(Perfume $perfume)
    {
        $images = $perfume->media;
        return returnSuccessResponse($images);
    }

    public function addImages(AddImagesRequest $request, Perfume $perfume)
    {
        if ($request->images && count($request->images) > 0) {
            $count = $perfume->media()->count();
            if (10 - $count >= count($request->images)) {
                (new ImageService())->storeProductImages($request->images,
                    $perfume, $count + 1);
                return returnSuccessResponse(null);
            } else {
                return returnFailureResponse('Số lượng hình ảnh đã đạt đến giới hạn.', 400);
            }
        }
    }

    /**
     * @throws InternalServerErrorException
     */
    public function deleteImage(Request $request, Perfume $perfume): JsonResponse
    {
        try {
            $image = $request->image;
            (new ImageService())->unlinkImage($image->img, $image->thumb);
            $image->delete();
            return response()->json([], 204);
        } catch (Exception $exception) {
            throw new InternalServerErrorException();
        }
    }

    public function updateDefaultImage(Request $request, Perfume $perfume): JsonResponse
    {
        $image = $request->image;
        if ($image->type == 1) {
            return returnFailureResponse('Hình ảnh hiện đã là mặc định.', 400);
        } else {
            $perfume->media()->where('type', 1)->update(['type' => 0]);
            $image->update(['type' => 1]);
            return returnMessageResponse('Cập nhật ảnh đại diện cho nước hoa thành công!');
        }
    }

    public function updateDefaultMLImage(Request $request, Perfume $perfume): JsonResponse
    {
        $image = $request->image;
        if ($image->type == 2) {
            return returnFailureResponse('Hình ảnh hiện đã là mặc định cho ML bình thường.', 400);
        } else {
            $perfume->media()->where('type', 2)->update(['type' => 0]);
            $image->update(['type' => 2]);
            return returnMessageResponse('Cập nhật ảnh mặc định ML cho nước hoa thành công!');
        }
    }

    public function updateDefaultFullboxImage(Request $request, Perfume $perfume): JsonResponse
    {
        $image = $request->image;
        if ($image->type == 3) {
            return returnFailureResponse('Hình ảnh hiện đã là mặc định cho FULL BOX.', 400);
        } else {
            $perfume->media()->where('type', 3)->update(['type' => 0]);
            $image->update(['type' => 3]);
            return returnMessageResponse('Cập nhật ảnh mặc định FULL BOX cho nước hoa thành công!');
        }
    }

    /**
     * @throws InternalServerErrorException
     */
    public function updateImageIndex(UpdateImageIndexRequest $request, Perfume $perfume): JsonResponse
    {
        try {
            $array = $request->get('array');
            foreach ($array as $item) {
                $perfume->media()->where('id', $item['id'])
                    ->update(['img_sort' => $item['img_sort']]);
            }
            return returnMessageResponse('Cập nhật vị trí hiển thị ảnh thành công');
        } catch (Exception $exception) {
            throw new InternalServerErrorException();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Perfume $perfume)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePerfumeRequest $request, Perfume $perfume)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Perfume $perfume)
    {
        //
    }
}
