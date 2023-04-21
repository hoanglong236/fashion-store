<?php

namespace App\Http\Controllers;

use App\Common\Constants;
use App\DataFilterConstants\ProductSorterConstants;
use App\Http\Requests\ProductSearchRequest;
use App\Services\CommonService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $commonService;
    private $productService;

    public function __construct()
    {
        $this->commonService = new CommonService();
        $this->productService = new ProductService();
    }

    public function findByCategorySlug($categorySlug)
    {
        $data = $this->getCommonDataForProductsPage();
        $data['products'] = $this->productService->getCustomProductsByCategorySlug($categorySlug);
        $data['brands'] = $this->productService->retrieveBrandsFromCustomProducts($data['products']);

        return view('pages.product.products-page', ['data' => $data]);
    }

    private function getCommonDataForProductsPage()
    {
        $categoryTrees = $this->commonService->getCategoryTrees();
        $bestSellerProducts = $this->productService->getBestSellerProducts(
            Constants::BEST_SELLER_PRODUCTS_SIDEBAR_COUNT
        );

        return [
            'pageTitle' => 'Products',
            'categoryTrees' => $categoryTrees,
            'bestSellerProducts' => $bestSellerProducts,
            'sorterOptions' => ProductSorterConstants::toArray(),
        ];
    }

    public function showDetails($productSlug)
    {
        $categoryTrees = $this->commonService->getCategoryTrees();
        $product = $this->productService->findProductBySlug($productSlug);
        $productImages =  $this->productService->getProductImagesByProductId($product->id);
        $relatedProducts = $this->productService->getRelatedProductsByProductId($product->id);

        $data = [
            'pageTitle' => $product->name,
            'categoryTrees' => $categoryTrees,
            'product' => $product,
            'productImages' => $productImages,
            'relatedProducts' => $relatedProducts,
        ];

        return view('pages.product.product-details-page', ['data' => $data]);
    }

    public function search(ProductSearchRequest $productSearchRequest)
    {
        $productSearchProperties = $productSearchRequest->validated();

        $data = $this->getCommonDataForProductsPage();
        $data['products'] = $this->productService->searchCustomProducts($productSearchProperties);
        $data['brands'] = $this->productService->retrieveBrandsFromCustomProducts($data['products']);

        return view('pages.product.products-page', ['data' => $data]);
    }
}
