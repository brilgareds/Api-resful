<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use App\Http\Controllers\ApiController;

class BuyerCategoryController extends ApiController
{
    /**
     * BuyerCategoryController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Buyer $buyer
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Buyer $buyer)
    {
        $categories = $buyer->transactions()
            ->with('product.categories')
            ->get()
            ->pluck('product.categories')
            ->collapse()
            ->unique('id')
            ->values();

        return $this->showAll($categories);
    }
}