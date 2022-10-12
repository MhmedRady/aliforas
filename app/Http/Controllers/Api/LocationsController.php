<?php

namespace App\Http\Controllers\Api;

use App\Models\State;
use App\Helpers\ApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Resources\StateResource;
use App\Http\Requests\NearestSellersRequest;
use App\Http\Resources\NearestSellerResource;
use App\Models\Auth\Seller;

class LocationsController extends Controller
{
    public function states(Request $request): JsonResponse
    {
        $states = State::when($request->countryId, fn ($q) =>  $q->where('country_id', $request->countryId))->get();
        return ApiHelpers::apiResponse('success', StateResource::collection($states), null);
    }

    public function stateCities(Request $request, State $state): JsonResponse
    {
        return ApiHelpers::apiResponse('success', CityResource::collection($state->cities), null);
    }

    public function nearestSellers(NearestSellersRequest $request): JsonResponse
    {
        $data = $request->validated();
        $sellerName = $request->get('seller');
        if ($request->has('lat') && $request->has('lng')&& $request->has('distance')){

            $availableBranches = $this->lngLatQuery($data);
            $branches = array_map(fn ($v) => (array)$v, $availableBranches);
            $availableSellersIds = array_column($branches, 'seller_id');
            $availableBranchesIds = array_column($branches, 'id');

            $availableSellers = Seller::query()->where([['is_active',true],['name','like', $sellerName.'%']])->whereIn('id', $availableSellersIds)
                ->with(['sellerBranch' => fn ($q) => $q->whereIn('id', $availableBranchesIds)->where('is_active', 1)])
                ->get()
                ->each(
                    fn ($seller) => $seller->sellerBranch->each(
                        fn ($q) =>  $q->distance = round(collect($branches)->where('id', $q->id)->first()['DISTANCE'], 2)
                    )
                );

        }else {
            $availableSellers = Seller::query()->where([['is_active',true],['name','like', $sellerName.'%']])->get();
        }


        return ApiHelpers::apiResponse('success', NearestSellerResource::collection($availableSellers));
    }

    private function lngLatQuery(array $data): array
    {
        $circle_radius = 6371;

        return DB::select("
            SELECT
                id,
                seller_id,
                (
                    $circle_radius * ACOS(
                        COS(RADIANS({$data['lat']})) * COS(RADIANS(lat)) * COS(
                            RADIANS(lng) - RADIANS({$data['lng']})
                        ) + SIN(RADIANS({$data['lat']})) * SIN(RADIANS(lat))
                    )
                ) AS DISTANCE
            FROM
                branches
            HAVING
                DISTANCE <= {$data['distance']};
        ");
    }
}
