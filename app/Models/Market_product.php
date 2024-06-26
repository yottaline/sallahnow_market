<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Market_product extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'product_code',
        'product_name',
        'product_store',
        'product_category',
        'product_subcategory',
        'product_photo',
        'product_desc',
        'product_price',
        'product_disc',
        'product_views',
        'product_show',
        'product_delete',
        'product_cerated'
    ];

    public static function fetch($id = 0, $params = null, $limit = null, $lastId = null)
    {
        $products = self::join('market_stores', 'product_store', 'store_id')
        ->join('market_categories', 'category_id', 'product_category')
        ->join('market_subcategories', 'subcategory_id', 'product_subcategory')->where('product_delete', 0)->limit($limit)->orderBy('product_id', 'DESC');

        if (isset($params['q']))
        {
            $products->where(function (Builder $query) use ($params) {
                $query->where('product_desc', 'like', '%' . $params['q'] . '%')
                ->orWhere('product_name', $params['q'])
                    ->orWhere('category_name',  'like', '%' . $params['q'] . '%')
                    ->orWhere('subcategory_name',  'like', '%' . $params['q'] . '%');
            });
            unset($params['q']);
        }

        if($lastId) $products->where('product_id', '<', $lastId);

        if($params) $products->where($params);

        if($id) $products->where('product_id', $id);

        return $id ? $products->first() : $products->get();
    }


    public static function fetchByIds($ids)
    {
        $products = self::join('market_stores', 'product_store', 'store_id')
        ->join('market_categories', 'category_id', 'product_category')
        ->join('market_subcategories', 'subcategory_id', 'product_subcategory')->where('product_delete', 0)->whereIn('product_id', $ids)->get();
        return $products;
    }

    public static function submit($param, $id)
    {
        if($id) return self::where('product_id', $id)->update($param) ? $id : false;
        $status = self::create($param);
        return $status ? $status->id : false;
    }
}