<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Api;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Lang;
use App\Models\Product;
use App\Models\Branch;
use App\Models\Notification;
use App\Models\Provider;
use App\Models\Category;
use App\Models\SubCategory;

class TelegramController extends Controller
{
    protected $telegram;

    /**
     * Create a new controller instance.
     *
     * @param  Api  $telegram
     */
    public function __construct(Api $telegram)
    {
        $this->telegram = $telegram;
    }

    public function send(Request $req)
    {
        App::setLocale('id');
        // $response = Telegram::bot('mybot')->getMe();

        $text =  Lang::get('notification.request_product', [
            'product' => 'Telkomsel 2GB',
            'branch' => 'Zia Ponsel',
            'stock' => 0,
            'quota' => 2,
            'unit' => 'GB',
            'description' => 'lorem ipsum',
        ], 'id');

        $response = $this->telegram->sendMessage([
            'chat_id' => '-838846598',
            'text' =>  $text,
            'parse_mode' => 'html'
        ]);

        return $this->createdResponse($response);
    }

    public function request(Request $req)
    {
        App::setLocale('id');
        $productID = $req['product_id'];
        $user = Auth::user();
        $branch = Branch::where('id', '=', $user->branch_id)->first();

        if($productID) {
            $product = Product::where('id', '=', $productID)->fisrt();

            $text =  Lang::get('notification.request_product', [
                'product' => $product->description,
                'branch' => $branch->name,
                'stock' => 0,
                'quota' => $product->quota,
                'unit' => $product->unit,
                'description' => $product->description,
            ], 'id');

            $dataID = 0;
            DB::beginTransaction();
            try {
                $dataID = Notification::create([
                    'type' => 'telegram',
                    'sender' => $user->id,
                    'subject' => 'Permintaan untuk penambahan stock product di '.$branch->name,
                    'data' => json_encode(['message' => $text], JSON_PRETTY_PRINT),
                    'created_at' => now(),
                    'created_by' => $user->id,
                ])->id;
                DB::commit();

                $response = $this->telegram->sendMessage([
                    'chat_id' => '-838846598',
                    'text' =>  $text,
                    'parse_mode' => 'html'
                ]);

                $find = Notification::where('id', '=', $dataID)->first();
                $find->response = $response;
                $find->updated_at = now();
                $find->updated_by = $user->id;
                $find->save();

                return $this->createdResponse([]);
            } catch (Exception $e) {
                DB::rollback();
                return $this->sendError(null, $e->getMessage());
            }

        } else {
            $categoryID = $req['category_id'];
            if ($categoryID) {
                $subCategoryID = $req['sub_category_id'];
                $providerID = $req['provider_id'];

                $category = Category::find($categoryID);
                $provider = Provider::find($providerID);
                $subCategory = SubCategory::find($subCategoryID);

                $text =  Lang::get('notification.request_provider', [
                    'provider' => $provider->name,
                    'isPrabayar' => $subCategory->name,
                    'branch' => $branch->name,
                    'stock' => 0,
                ], 'id');

                $dataID = 0;
                DB::beginTransaction();
                try {
                    $dataID = Notification::create([
                        'type' => 'telegram',
                        'sender' => $user->id,
                        'subject' => 'Permintaan untuk penambahan stock '.$category->name.' di '.$branch->name,
                        'data' => json_encode(['message' => $text], JSON_PRETTY_PRINT),
                        'created_at' => now(),
                        'created_by' => $user->id,
                    ])->id;
                    DB::commit();

                    $response = $this->telegram->sendMessage([
                        'chat_id' => '-838846598',
                        'text' =>  $text,
                        'parse_mode' => 'html'
                    ]);

                    $find = Notification::where('id', '=', $dataID)->first();
                    $find->response = $response;
                    $find->updated_at = now();
                    $find->updated_by = $user->id;
                    $find->save();

                    return $this->createdResponse([]);
                } catch (Exception $e) {
                    DB::rollback();
                    return $this->sendError(null, $e->getMessage());
                }
            }
            return $this->sendError(null, 'Product id not found');
        }

    }
}
