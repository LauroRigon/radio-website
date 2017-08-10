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
        return view('dashboard.category.index');
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

        $messages = [
            'required' => 'Este campo é obrigatório!',
            'name.unique' => 'Esta categoria já existe!'
        ];
        $validator = Validator::make($data, [
            'name' => 'required|unique:categories',
            'description' => 'required'
        ],$messages);

        /*Retorna os erros se ouver*/
        if ($validator->fails()){
            return response()->json(
                $validator->errors()
                , 422);
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

        $messages = [
            'required' => 'Este campo é obrigatório!',
            'name.unique' => 'Esta categoria já existe!'
        ];
        $validator = Validator::make($data, [
            'name' => 'required|unique:categories,name,'.$id->id,
            'description' => 'required'
        ], $messages);

        if ($validator->fails()){
            return response()->json([
                $validator->errors()
            ], 422);
        }

        $updatedCategory = $id->update([
            'name' => ucfirst($data['name']),
            'description' => ucfirst($data['description'])
        ]);
        dd($updatedCategory);
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
            'status' => 'Categoria deletada com sucesso!'
        ], 200);
    }

    /**
     * Retorna todas as categorias
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategories() {
        $categories = Category::paginate(10);

        return response()->json([
            $categories
        ], 200);
    }
}
