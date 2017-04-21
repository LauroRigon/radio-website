<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.category.index')->with('categories', $categories);
    }

    /**
     * Armazena no banco uma categoria
     *
     * @param  \Illuminate\Http\Request  $request(name, description)
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->input();

        $validator = Validator::make($data, [
            'name' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()){
            return response()->json([
                $validator->errors()
            ]);
        }

        $createdCategory = Category::create([
            'name' => ucfirst($data['name']),
            'description' => ucfirst($data['description'])
        ]);

        return $createdCategory;

    }


    /**
     * Atualiza no banco de dados uma categoria
     *
     * @param  \Illuminate\Http\Request  $request (name, description)
     * @param  int  $id (CategoryId)
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $id)
    {
        $data = $request->input();

        $validator = Validator::make($data, [
            'name' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()){
            return response()->json([
                $validator->errors()
            ]);
        }

        $updatedCategory = $id->update([
            'name' => ucfirst($data['name']),
            'description' => ucfirst($data['description'])
        ]);

        return response()->json([
            'status' => 'Atualizado com sucesso!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $id)
    {
        $id->delete();

        return response()->json([
            'status' => 'Deletado com sucesso!'
        ], 200);
    }
}
