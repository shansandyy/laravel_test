<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Log;
use  App\Models\Product;

class shortUrlService
{
    public function __construct()
    {
    }

    /**
     * report($exception) 
     *handler to SQL:log_errors
     */
    public function upadateProduct($r)
    {
        try {
            if (empty($r['id'])) {
                return ['id' => __('exceptions.REQUEST_EMPTY')];
            };
            if (empty($r['price'])) {
                return ['price' => __('exceptions.REQUEST_EMPTY')];
            };

            Product::find($r['id'])->update([
                'price' => $r['price']
            ]);

            log::info('商品價格修改成功', ['id' => $r['id'], 'price' => $r['price']]);
            return __('exceptions.SUCCESS');
        } catch (\Throwable $exception) {
            log::info('商品價格修改失敗', ['data' => $exception]);
            report($exception);

            return $exception;
        }
    }
}
