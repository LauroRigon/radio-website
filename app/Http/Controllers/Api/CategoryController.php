<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CategoryController extends Controller
{

    /**
     * Retorna todas as categorias
     *
     *@return \Illuminate\Http\Response
     */
    public function getCategories(Request $request) {
        $categories = Category::all();

        return $categories;
    }
}
