<?php

namespace DevChallenge\Http\Controllers;

use Illuminate\Http\Request;
use DevChallenge\Http\Requests\ProductRequest;
use DevChallenge\Http\Controllers\ApiBaseController;
use DevChallenge\Models\Product;
use DevChallenge\Models\Category;

class ProductController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return $this->sendResponse($products->toArray(), '');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create([
            'category_id' => $request->category,
            'description' => $request->description,
            'price' => $request->price
        ]);

        return $this->sendResponse($product->toArray(), 'Produto adicionado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        if(!$product) {
            return $this->sendError('Produto não encontrado');
        }

        return $this->sendResponse($product->toArray(), '');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);
        $category = Category::find($request->category);

        if(!$product) {
            return $this->sendError('Produto não encontrado');
        }

        if(!$category) {
            return $this->sendError('Categoria não encontrada');
        }

        $product->category_id = $request->category;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();

        return $this->sendResponse($product->toArray(), 'Produto atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if(!$product) {
            return $this->sendError('Produto não encontrado');
        }
        $product->delete();

        return $this->sendResponse('', 'Produto deletado com sucesso');
    }
}
