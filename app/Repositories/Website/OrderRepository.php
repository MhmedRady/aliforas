<?php
namespace App\Repositories\Website;

use App\Models\PriceQuoteOrder;
use App\Models\PriceQuoteOrderItem;
use App\Models\UserAddress;

use Illuminate\Support\Facades\Auth;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

class OrderRepository extends BaseRepository
{

    public function model()
    {
        return PriceQuoteOrder::class;
    }

    public function store($request)
    {

        if (Auth::guard('web')->check()){
            
            $userAddress = [
                'user_id'=>auth()->user()->id,
                'state_id'=>$request->input('state_id'),
                'city_id'=>20,
                'address'=>$request->input('address'),
                'postal_code'=>$request->input('postal_code'),
            ];

            auth()->user()->userAddress->update($userAddress);
            
            $PriceQuoteOrder = [
                'user_id'=>auth()->user()->id,
                'user_address_id'=>auth()->user()->userAddress->id,
                'first_name' =>$request->input('first_name'),
                'last_name' =>$request->input('first_name'),
                'email' =>$request->input('email'),
                'phone' =>$request->input('phone'),
            ];

            $PriceQuoteOrder_id = PriceQuoteOrder::query()->insertGetId($PriceQuoteOrder);

            foreach (userCart()->getContent() as $item)
            {
                PriceQuoteOrderItem::query()->create([
                    'product_id'=>$item->associatedModel->id,
                    'quantity'=>$item->quantity,
                    'price_quote_order_id'=>$PriceQuoteOrder_id
                ]);
            }

        }else{
            
            $userAddress = [
                'state_id'=>$request->input('state_id'),
                'city_id'=>$request->input('city_id'),
                'address'=>$request->input('address'),
                'postal_code'=>$request->input('postal_code'),
            ];

            $userAddress_id = UserAddress::query()->insertGetId($userAddress);

            $PriceQuoteOrder = [
                'user_address_id'=>$userAddress_id,
                'first_name' =>$request->input('first_name'),
                'last_name' =>$request->input('first_name'),
                'email' =>$request->input('email'),
                'phone' =>$request->input('phone'),
            ];
            $PriceQuoteOrder_id = PriceQuoteOrder::query()->insertGetId($PriceQuoteOrder);
            foreach (userCart()->getContent() as $item)
            {
                PriceQuoteOrderItem::query()->create([
                    'product_id'=>$item->associatedModel->id,
                    'quantity'=>$item->quantity->id,
                    'price_quote_order_id'=>$PriceQuoteOrder_id
                ]);
            }
        }

    }
}
