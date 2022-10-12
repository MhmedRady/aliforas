<?php

namespace App\Repositories\Seller;

use App\Models\Seller;
use App\Models\User;
use App\Models\SellerFile;
use App\Http\Controllers\Seller\SellerController;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model

/**
 * Class SellerRepository.
 */
class SellerRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */

    public function model()
    {
        return User::class;
    }

    public function store($request)
    {

        try{

        $data = $request;
        $code = genRandomCode();
        $mailData = ["name"=>$request["name"],"email"=>$request["email"],"code"=>$code];

        // return $data;

        // savemail_verified_ate user data
        DB::beginTransaction();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'verification_code' => $code,
            'email_verified_at' => now(),
            'contact_number' => $data['contact_number'],
            'password' => bcrypt($data['password']),

            'is_active' => 0,
            'is_seller' => 1
        ]);
        $user->is_seller = 1;
        $user->save();
        DB::commit();

        // if($user->save()){
        //     SellerController::mailJob($mailData);
        // }

        $seller_data = [
            $data['contact_number'],
            $data['name'],
            $data['email'],
            $data['account_legal_file'],

            "address"=>$data['address'],
            "lng"=>$data["lng"],
            "lat"=>$data["lat"]

        ];

        $doc = new SellerFile();

        if(request()->has('account_legal_file')){
            $file = request()->file('account_legal_file');
            $name = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('/upload/sellers', $name, 'public');

            $doc->name = $name;
            $doc->path = $path;
            $doc->user_id = $user->id;
            $doc->save();
        }else{
            $doc->name = NULL;
            $doc->path = NULL;
            $doc->user_id = $user->id;
            $doc->save();
        }


        $seller_data = array_merge($seller_data, [
            'document_id' =>request()['document_id'],
            'document_first_name' =>request()['document_first_name'],
            'document_last_name' =>request()['document_last_name'],
            'document_expiry_date' =>request()['document_expiry_date'],
            'pickup_city' =>request()['pickup_city'],
            'pickup_street' 	=>request()['pickup_street'],
            'pickup_contact_number' =>request()['pickup_contact_number'],
            'pickup_building_number'=>request()['pickup_building_number'],
            'store_name' 	=>request()['store_name'],
            'account_legal_type' =>request()['account_legal_type'],

            'user_id' => $user->id
        ]);

        DB::beginTransaction();
        Seller::create($seller_data);
        DB::commit();

        return redirect()->route('seller.login');

        }catch(\Exciption $e){
            DB::rollBack();
            return redirect()->route('seller.login');
        }

    }

    public function edit_profile()
    {
        $row = Auth::user();

        $seller = Seller::where("user_id",$row->id)->select(["pickup_city","pickup_street","address","lat","lng"])->get();

        $row["city"] = $seller[0]["pickup_city"];

        $row["street"] = $seller[0]["pickup_street"];

        $row["address"] = $seller[0]["address"];
        $row["lat"] = $seller[0]["lat"];
        $row["lng"] = $seller[0]["lng"];


        return view('seller.users.edit', compact('row'));
    }

    public function update_profile($request)
    {


        $user=Auth::user();
        $request->validate([
            'name'=>"required|min:5",
            'email'=>"required|unique:users,email,{$user->id}",
            'contact_number'=>"required|unique:users,contact_number,{$user->id}",
        ]);

        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'password' => isset($request->password) ?bcrypt($request->password) : $user->password,
            'contact_number' =>  $request->contact_number,
        ]);

        if (!is_null($request->address)) {
            Seller::where("user_id",$user->id)->update([
                "address"=>$request->address,
                "lat"=>$request->lat,
                "lng"=>$request->lng,
            ]);
        }

        Session::flash('success-sweet-alert',Lang::get('message.success'));
        return redirect()->route('seller.user.profile');
    }

    public function admin_update_seller($seller)
    {
        $user = User::where("id",$seller->id)->with(["seller","sellerFile"])->first()->makeVisible("password");

        if (!$seller->has("is_active")){
            $seller->request->add(['is_active'=>'0']);
        }else{
            $seller->request->add(['is_active'=>'1']);
        }

        if(!is_null($seller->password)){
            $seller->password = bcrypt($seller->password);
        }else{
            $seller->password = $user->password;
        }

        if(!is_null($seller->id_img)){

            if(isset($user->sellerFile->name)){
                if(is_file(public_path($user->sellerFile->path))){
                    unlink(public_path($user->sellerFile->path));
                }
            }

            $postImg = strtolower($seller->id_img->getClientOriginalExtension());
            $name = time().".{$postImg}";
            $file_path = public_path("upload/sellers");
            request()->id_img->move($file_path,$name);
            $file_path = "upload/sellers"."/".$name;
            $user->sellerFile->path = $file_path;
            $user->sellerFile->name = $name;
        }

        try{

            DB::beginTransaction();

            $user->update([
                "name"=>$seller->name,
                "email"=>$seller->email,
                "contact_number"=>$seller->contact_number,
                "is_active"=>$seller->is_active,
                "gender"=>$seller->gender,
                "password"=>$seller->password,
            ]);

            $user->seller->update([

                "document_id"=>$seller->document_id,
                "document_expiry_date"=>$seller->document_expiry_date,
                "pickup_city"=>$seller->pickup_city,
                "pickup_street"=>$seller->pickup_street,
                "pickup_contact_number"=>$seller->pickup_contact_number,
                "pickup_building_number"=>$seller->pickup_building_number,
                "store_name"=>$seller->store_name,
                "address"=>$seller->address,
                "lat"=>$seller->lat,
                "lng"=>$seller->lng,
            ]);

            if(isset($user->sellerFile)){
                SellerFile::where("user_id",$seller->id)->update([
                    "name" => $user->sellerFile->name,
                    "path" => $user->sellerFile->path,
                ]);
            }else{
                SellerFile::where("user_id",$seller->id)->update([
                    "name" => $user->sellerFile->name,
                    "path" => $user->sellerFile->path,
                ]);
            }
            DB::commit();

            return redirect()->back()->withErrors('msg', 'Data Not Updated Successfully');

        }catch(\Exsption $e){
            DB::rollBack();
            return redirect()->back()->withErrors('msg', 'Data Not Updated Try Again later');
        }

    }

}
