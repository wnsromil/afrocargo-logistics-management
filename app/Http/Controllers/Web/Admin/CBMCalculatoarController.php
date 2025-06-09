<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\ContainerSize;

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
        return view('admin.cbm_calculatoar.FreightCalculator.Port_wise_freight');
    }

    public function FreightShipping(Request $request): View
    {
        return view('admin.cbm_calculatoar.FreightShipping.SingleShippingContainer');
    }


    public function FreightShipping_PDF(Request $request): View
    {
        return view('admin.cbm_calculatoar.freightShipping_PDF.Pdf_view');
    }
}
