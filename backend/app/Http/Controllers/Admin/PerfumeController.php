<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\InternalServerErrorException;
use App\Exceptions\NotFoundApiException;
use App\Exceptions\UnauthorizedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Perfume\AddImagesRequest;
use App\Http\Requests\Admin\Perfume\StorePerfumeRequest;
use App\Http\Requests\Admin\Perfume\UpdateImageIndexRequest;
use App\Http\Requests\Admin\Perfume\UpdatePerfumePriceRequest;
use App\Http\Requests\Admin\Perfume\UpdatePerfumeRequest;
use App\Http\Requests\Admin\PerfumePrice\StorePerfumePriceRequest;
use App\Models\Media;
use App\Models\Perfume;
use App\Models\PerfumePrice;
use App\Services\ImageService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PerfumeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = $request->except(['itemPerPage', 'page']);
        $perfumes = Perfume::query();
        $perfumes = getItems($request, $query, $perfumes);
        $data = collect($perfumes->items());
        $data->each(function ($perfume) {
            $perfume->setAttributeVisibility();
        });
        return returnItemsWithPagination($perfumes, $data);
    }

    /**
     * Store a newly created resource in storage.
     * @throws InternalServerErrorException
     */
    public function store(StorePerfumeRequest $request): JsonResponse
    {
        $user = Auth::guard('api')->user();
        $data = $request->validated() + ['user_id' => $user->id];
        try {
            $perfume = Perfume::query()->create($data);
            if ($request->images && count($request->images) > 0) {
                (new ImageService())->storeProductImages($request->images, $perfume);
            }
            $array = json_decode($request->get('prices'));
            if (is_array($array)) {
                foreach ($array as $price) {
                    $perfume->price()->create([
                        'perfume_id' => $perfume->id,
                        'capacity' => $price[0],
                        'import_price' => $price[1],
                        'price' => $price[2],
                        'quantity' => (int)$price[3]
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
    public function show(Perfume $perfume): JsonResponse
    {
        $image = $perfume->media;
        $data = $perfume->makeVisible('product_information')
                ->makeHidden('media')->toArray() + ['images' => $image->toArray()];
        return returnSuccessResponse($data);
    }

    public function getImages(Perfume $perfume): JsonResponse
    {
        $images = $perfume->media->each(function ($item) {
            $item->setAttributeVisibility();
        });
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
        } else {
            return returnFailureResponse('Không tìm thấy hình ảnh nào cần tải lên.', 400);
        }
    }

    /**
     * @throws InternalServerErrorException
     * @throws NotFoundApiException
     */
    public function deleteImage(Request $request, Perfume $perfume, Media $media): JsonResponse
    {
        try {
            if ($perfume->media()->where('id', $media->id)->count() < 1) {
                throw new NotFoundApiException();
            }
            (new ImageService())->unlinkImage($media->img, $media->thumb);
            $media->delete();
            return response()->json([], 204);
        } catch (NotFoundApiException $exception) {
            throw new NotFoundApiException();
        } catch (Exception $exception) {
            throw new InternalServerErrorException();
        }
    }

    /**
     * @throws NotFoundApiException
     * @throws InternalServerErrorException
     */
    public function updateDefaultImage(Request $request, Perfume $perfume, Media $media): JsonResponse
    {
        try {
            if ($perfume->media()->where('id', $media->id)->count() < 1) {
                throw new NotFoundApiException();
            }
            if ($media->type == 1) {
                return returnFailureResponse('Hình ảnh hiện đã là mặc định.', 400);
            } else {
                $perfume->media()->where('type', 1)->update(['type' => 0]);
                $media->update(['type' => 1]);
                return returnMessageResponse('Cập nhật ảnh đại diện cho nước hoa thành công!');
            }
        }  catch (NotFoundApiException $exception) {
            throw new NotFoundApiException();
        } catch (Exception $exception) {
            throw new InternalServerErrorException();
        }
    }

    /**
     * @throws NotFoundApiException
     * @throws InternalServerErrorException
     */
    public function updateDefaultMLImage(Request $request, Perfume $perfume, Media $media): JsonResponse
    {
        try {
            if ($perfume->media()->where('id', $media->id)->count() < 1) {
                throw new NotFoundApiException();
            }
            if ($media->type == 2) {
                return returnFailureResponse('Hình ảnh hiện đã là mặc định cho ML bình thường.', 400);
            } else {
                $perfume->media()->where('type', 2)->update(['type' => 0]);
                $media->update(['type' => 2]);
                return returnMessageResponse('Cập nhật ảnh mặc định ML cho nước hoa thành công!');
            }
        }  catch (NotFoundApiException $exception) {
            throw new NotFoundApiException();
        } catch (Exception $exception) {
            throw new InternalServerErrorException();
        }
    }

    /**
     * @throws NotFoundApiException
     * @throws InternalServerErrorException
     */
    public function updateDefaultFullboxImage(Request $request, Perfume $perfume, Media $media): JsonResponse
    {
        try {
            if ($perfume->media()->where('id', $media->id)->count() < 1) {
                throw new NotFoundApiException();
            }
            if ($media->type == 3) {
                return returnFailureResponse('Hình ảnh hiện đã là mặc định cho FULL BOX.', 400);
            } else {
                $perfume->media()->where('type', 3)->update(['type' => 0]);
                $media->update(['type' => 3]);
                return returnMessageResponse('Cập nhật ảnh mặc định FULL BOX cho nước hoa thành công!');
            }
        }  catch (NotFoundApiException $exception) {
            throw new NotFoundApiException();
        } catch (Exception $exception) {
            throw new InternalServerErrorException();
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
     * @throws InternalServerErrorException
     */
    public function getPrices(Perfume $perfume): JsonResponse
    {
        try {
            $prices = $perfume->price;
            $prices->each(function ($price) {
                $price->setAttributeVisibility();
            });
            return returnSuccessResponse($prices);
        } catch (Exception $exception) {
            throw new InternalServerErrorException();
        }
    }

    /**
     * @throws InternalServerErrorException
     */
    public function addPrice(StorePerfumePriceRequest $request, Perfume $perfume): JsonResponse
    {
        try {
            $price = $perfume->price()->create($request->validated());
            return returnSuccessResponse($price, 201);
        } catch (Exception $exception) {
            throw new InternalServerErrorException();
        }
    }

    /**
     * @throws InternalServerErrorException
     */
    public function updatePrice(UpdatePerfumePriceRequest $request, Perfume $perfume, PerfumePrice $perfumePrice): JsonResponse
    {
        try {
            $perfume->price()->where('id', $perfumePrice->id)->update($request->validated());
            return response()->json([], 204);
        } catch (Exception $exception) {
            throw new InternalServerErrorException();
        }
    }

    /**
     * @throws InternalServerErrorException
     */
    public function deletePrice(Perfume $perfume, PerfumePrice $perfumePrice): JsonResponse
    {
        try {
            $perfume->price()->where('id', $perfumePrice->id)->delete();
            return response()->json([], 204);
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
     * @throws InternalServerErrorException
     */
    public function update(UpdatePerfumeRequest $request, Perfume $perfume): JsonResponse
    {
        try {
            $perfume->update($request->validated());
            return response()->json([], 204);
        } catch (Exception $exception) {
            throw new InternalServerErrorException();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Perfume $perfume)
    {
        //
    }
}
