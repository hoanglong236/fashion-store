<?php

namespace App\Services;

use App\Common\Constants;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use stdClass;

class ProductService
{
    public function getCustomProductsByCategorySlug($categorySlug)
    {
        return DB::table('products')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->join('brands', 'brands.id', '=', 'products.brand_id')
            ->select([
                'products.id',
                'products.name',
                'products.slug',
                'products.price',
                'products.discount_percent',
                'products.main_image_path',
                'brands.id as brand_id',
                'brands.name as brand_name',
                'brands.slug as brand_slug',
            ])
            ->where([
                'products.delete_flag' => false,
                'categories.delete_flag' => false,
                'categories.slug' => $categorySlug,
                'brands.delete_flag' => false,
            ])
            ->paginate(Constants::ITEMS_PER_PRODUCTS_PAGE);
    }

    private function escapeKeyword($keyword)
    {
        $search = array('%', '_');
        $replace = array('\%', '\_');
        return str_replace($search, $replace, $keyword);
    }

    public function searchCustomProducts($productSearchProperties)
    {
        $keyword = $productSearchProperties['keyword'];
        $escapedKeyword = $this->escapeKeyword($keyword);

        return DB::table('products')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->join('brands', 'brands.id', '=', 'products.brand_id')
            ->select([
                'products.id',
                'products.name',
                'products.slug',
                'products.price',
                'products.discount_percent',
                'products.main_image_path',
                'brands.id as brand_id',
                'brands.name as brand_name',
                'brands.slug as brand_slug',
            ])
            ->where([
                'products.delete_flag' => false,
                'categories.delete_flag' => false,
                'brands.delete_flag' => false,
            ])
            ->where(function ($query) use ($escapedKeyword) {
                $query->where('products.name', 'LIKE', '%' . $escapedKeyword . '%')
                    ->orWhere('products.slug', 'LIKE', '%' . $escapedKeyword . '%')
                    ->orWhere('categories.name', 'LIKE', '%' . $escapedKeyword . '%')
                    ->orWhere('brands.name', 'LIKE', '%' . $escapedKeyword . '%');
            })
            ->paginate(Constants::ITEMS_PER_PRODUCTS_PAGE);
    }

    public function getBestSellerProducts($productCount)
    {
        return Product::where(['delete_flag' => false])->limit($productCount)->get();
    }

    public function findProductBySlug($productSlug)
    {
        return Product::where(['delete_flag' => false, 'slug' => $productSlug])->first();
    }

    public function getProductImagesByProductId($productId)
    {
        return ProductImage::where('product_id', $productId)->get();
    }

    public function getRelatedProductsByProductId($productId)
    {
        $product = Product::where([
            'delete_flag' => false,
            'id' => $productId,
        ])->first();

        return DB::table('products')
            ->select([
                'products.*',
                DB::raw('CASE WHEN brand_id = ' . $product->brand_id . ' THEN 1 ELSE 0 END as brand_expected'),
                DB::raw('CASE WHEN category_id = ' . $product->category_id . ' THEN 1 ELSE 0 END as category_expected')
            ])
            ->where('delete_flag', false)
            ->where('id', '!=', $product->id)
            ->where(function ($query) use ($product) {
                $query->orWhere('brand_id', $product->brand_id)
                    ->orWhere('category_id', $product->category_id);
            })
            ->orderByDesc('brand_expected')
            ->orderByDesc('category_expected')
            ->limit(Constants::RELATED_PRODUCTS_COUNT)
            ->get();
    }

    public function retrieveBrandsFromCustomProducts($customProducts)
    {
        $brands = [];
        $brandIds = [];

        foreach ($customProducts as $customProduct) {
            if (in_array($customProduct->brand_id, $brandIds)) {
                continue;
            }

            array_push($brandIds, $customProduct->brand_id);

            $brand = new stdClass();
            $brand->id = $customProduct->brand_id;
            $brand->name = $customProduct->brand_name;
            $brand->slug = $customProduct->brand_slug;
            array_push($brands, $brand);
        }

        return $brands;
    }

    public function getProductById($productId)
    {
        return Product::where(['delete_flag' => false, 'id' => $productId])->first();
    }
}
