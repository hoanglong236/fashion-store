<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Log;

class CommonService
{
    public function getCategoryTrees()
    {
        $categories = Category::where([
            'delete_flag' => false,
            'parent_id' => null,
        ])->get();

        $categoryTrees = [];

        foreach ($categories as $category) {
            array_push($categoryTrees, $this->getCategoryTree($category));
        }

        return $categoryTrees;
    }

    private function getCategoryTree($category)
    {
        $categoryChildren = Category::where([
            'delete_flag' => false,
            'parent_id' => $category->id,
        ])->get();

        $categoryTree = $category->getAttributes();
        $categoryTree['children'] = [];

        foreach ($categoryChildren as $categoryChild) {
            array_push($categoryTree['children'], $this->getCategoryTree($categoryChild));
        }

        return $categoryTree;
    }
}
