<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    function get()
    {
        $data = Product::all();
        return response()->json(
            [
                "message" => "GET method success",
                "data" => $data
            ]
        );
    }

    function getById($id)
    {
        $data = Product::where('id', $id)->first();

        if ($data) {
            return response()->json(
                [
                    "message" => "GET method success",
                    "data" => $data
                ]
            );
        }

        return response()->json(
            [
                "message" => "GET method FAILED, id=" . $id . " not found"
            ]
        );
    }

    function post(Request $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->active = $request->active;
        $product->description = $request->description;

        $product->save();

        return response()->json(
            [
                "message" => "POST method success",
                "data" => $product
            ]
        );
    }

    function put($id, Request $request)
    {
        $product = Product::where('id', $id)->first();
        if ($product) {
            $product->name = $request->name ? $request->name : $product->name;
            $product->price = $request->price ? $request->price : $product->price;
            $product->quantity = $request->quantity ? $request->quantity : $product->quantity;
            $product->active = $request->active ? $request->active : $product->active;
            $product->description = $request->description ? $request->description : $product->description;

            $product->save();
            return response()->json(
                [
                    "message" => "PUT method success",
                    "data" => $product
                ]
            );
        }
        return response()->json(
            [
                "message" => "PUT method FAILED, id=" . $id . " not found"
            ]
        );
    }

    function delete($id)
    {
        $data = Product::where('id', $id)->first();

        if ($data) {
            $data->delete();
            return response()->json(
                [
                    "message" => "DELETE method success, id=".$id,
                ]
            );
        }

        return response()->json(
            [
                "message" => "DELETE method FAILED, id=" . $id . " not found"
            ]
        );
    }
}
