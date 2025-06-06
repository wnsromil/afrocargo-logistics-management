<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\ContainerSize;
use App\Models\DefaultContainerSize;

class CBMCalculatoarController extends Controller
{
    //
    public function FreightContainerSize(Request $request): View
    {
        $ContainerSizes = ContainerSize::all(); // Ya query ke according filter bhi kar sakte ho

        return view('admin.cbm_calculatoar.FreightContainerSize.Freight_Container_List', [
            'containerSizes' => $ContainerSizes
        ]);
    }


    public function FreightCalculator(Request $request): View
    {
        $ContainerSizes = ContainerSize::all();
        return view('admin.cbm_calculatoar.FreightCalculator.Port_wise_freight', [
            'containerSizes' => $ContainerSizes
        ]);
    }

    public function FreightShipping(Request $request): View
    {
        return view('admin.cbm_calculatoar.FreightShipping.SingleShippingContainer');
    }


    public function FreightShipping_PDF(Request $request): View
    {
        return view('admin.cbm_calculatoar.freightShipping_PDF.Pdf_view');
    }

    public function ContainerSizeStore(Request $request)
    {
        // Step 1: Validation (optional but recommended)
        $request->validate([
            'id' => 'required|array',
            'length' => 'required|array',
            'length.*' => 'required|numeric|min:0',
            'breadth' => 'required|array',
            'breadth.*' => 'required|numeric|min:0',
            'height' => 'required|array',
            'height.*' => 'required|numeric|min:0',
            'volume' => 'required|array',
            'volume.*' => 'required|numeric|min:0',
            'tare_weight' => 'required|array',
            'tare_weight.*' => 'required|numeric|min:0',
            'max_weight' => 'required|array',
            'max_weight.*' => 'required|numeric|min:0',
        ]);


        // Step 2: Loop through each row's data
        foreach ($request->id as $index => $id) {
            $container = ContainerSize::find($id);
            if ($container) {
                $container->length = $request->length[$index];
                $container->breadth = $request->breadth[$index];
                $container->height = $request->height[$index];
                $container->volume = $request->volume[$index];
                $container->tare_weight = $request->tare_weight[$index];
                $container->max_weight = $request->max_weight[$index];
                $container->save();
            }
        }

        return redirect()->back()->with('success', 'All container sizes updated successfully.');
    }

    //Api function 
    public function getDefaultContainerSizes()
    {
        $defaults = DefaultContainerSize::all();

        return response()->json($defaults);
    }
}
