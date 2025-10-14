<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\sections;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    $sections = sections::all();
    $products = products::with('sections')->get();

    return view('products.products', compact('sections', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */


public function store(Request $request)
{
    // ------------1----------------
    // $request->validate([
    //     'Product_name' => [
    //         'required',
    //         Rule::unique('products')->where(function ($query) use ($request) {
    //             return $query->where('section_id', $request->section_id);
    //         }),
    //         'max:255',
    //     ],
    // ],[
    //     'Product_name.required' =>'يرجي ادخال اسم المنتج',
    //     'Product_name.unique' =>'اسم المنتج مسجل مسبقاً في هذا القسم',
    // ]);

    // //  dd('validation passed');
    // products::create([
    //     'Product_name' => $request->Product_name,
    //     'section_id' => $request->section_id,
    //     'description' => $request->description
    // ]);

    // session()->flash('Add', 'تم اضافة المنتج بنجاح');
    // return redirect('/products');
    // ------------2----------------
    // التحقق من البيانات
    $validatedData = $request->validate([
        'Product_name' => 'required|max:255|unique:products,Product_name,NULL,id,section_id,' . $request->section_id,
        'section_id'   => 'required|exists:sections,id',
        'description'  => 'nullable',
    ], [
        'Product_name.required' => 'يرجى إدخال اسم المنتج',
        'Product_name.unique'   => 'اسم المنتج مسجل مسبقًا في نفس القسم',
        'section_id.required'   => 'يرجى اختيار القسم',
        'section_id.exists'     => 'القسم المختار غير موجود',
    ]);
    // إنشاء المنتج
    Products::create($validatedData);

    // رسالة نجاح
    session()->flash('Add', 'تم إضافة المنتج بنجاح');

    return redirect()->back();
}





    /**
     * Display the specified resource.
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
        {
            // --------------1----------------
    //     $this->validate($request, [

    //         'Product_name' => 'required|unique:sections,Product_name',
    //         'description' => 'required',
    //     ],[

    //         'Product_name.required' =>'يرجي ادخال اسم القسم',
    //         'Product_name.unique' =>'اسم القسم مسجل مسبقا',
    //         'description.required' =>'يرجي ادخال البيان',

    //     ]);
    //      $id = sections::where('section_id', $request->section_id)->first()->id;

    //    $Products = Products::findOrFail($request->pro_id);

    //    $Products->update([
    //    'Product_name' => $request->Product_name,
    //    'description' => $request->description,
    //    'section_id' => $id,
    //    ]);

    //    session()->flash('Edit', 'تم تعديل المنتج بنجاح');
    //    return back();
    //     // return redirect('/products');
    //--------------2-----------------
    // التحقق من البيانات
    $validatedData = $request->validate([
        'Product_name' => "required|unique:products,Product_name,{$request->pro_id},id,section_id,{$request->section_id}",
        'section_id'   => 'required|exists:sections,id',
        'description'  => 'nullable',
    ], [
        'Product_name.required' => 'يرجى إدخال اسم المنتج',
        'Product_name.unique'   => 'اسم المنتج مسجل مسبقًا في نفس القسم',
        'section_id.required'   => 'يرجى اختيار القسم',
        'section_id.exists'     => 'القسم المختار غير موجود',
    ]);

    // إيجاد المنتج
    $product = Products::findOrFail($request->pro_id);

    // تحديث البيانات
    $product->update($validatedData);

    // رسالة نجاح
    // session()->flash('Edit', 'تم تعديل المنتج بنجاح');
    session()->flash('success', 'تم تعديل المنتج بنجاح');


    return redirect('products');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // --------------1----------------
        // $Products = Products::findOrFail($request->pro_id);
        // $Products->delete();
        // session()->flash('delete', 'تم حذف المنتج بنجاح');
        // return redirect('/products');
        // --------------2----------------
    $product = Products::findOrFail($request->pro_id);
    $product->delete();
    session()->flash('delete', 'تم حذف المنتج بنجاح');
    return redirect()->back();
    }
}
