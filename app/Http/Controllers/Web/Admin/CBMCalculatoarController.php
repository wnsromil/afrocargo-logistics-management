<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\ContainerSize;
use App\Models\DefaultContainerSize;
use App\Models\Country;
use App\Models\Port;
use App\Models\PortWiseFreight;
use App\Models\PortWiseFreightContainer;

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
        $Countrys = Country::all();
        return view('admin.cbm_calculatoar.FreightCalculator.Port_wise_freight', [
            'containerSizes' => $ContainerSizes,
            'countrys' => $Countrys
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

    function getPortsByCountryName($countryName)
    {
        $ports = Port::where('country_code', $countryName)->orderBy('port_name', 'asc')->get();

        return response()->json([
            'status' => true,
            'message' => 'Ports fetched successfully.',
            'data' => $ports
        ]);
    }

    public function storePortFreight(Request $request)
    {
        $request->validate([
            'from_country_select' => 'required|string',
            'from_port' => 'required|integer',
            'to_country_select' => 'required|string',
            'to_port' => 'required|integer',
        ], [
            'from_country_select.required' => 'Please select from country.',
            'from_port.required' => 'Please select from port.',
            'to_country_select.required' => 'Please select to country.',
            'to_port.required' => 'Please select to port.',
        ]);

        // Step 1: Save main freight
        $freight = PortWiseFreight::create([
            'creator_user_id' => auth()->id(),
            'from_country' => $request->from_country_select,
            'from_port' => $request->from_port,
            'to_country' => $request->to_country_select,
            'to_port' => $request->to_port,
        ]);

        // Step 2: Loop through container data
        $containerNames = $request->container_name;
        $freightPrices = $request->freight_price;
        $currencies = $request->currency;

        foreach ($freightPrices as $index => $freightPrice) {
            // Agar freight_price ya currency blank ho to skip karo
            if (empty($freightPrice) || empty($currencies[$index])) {
                continue;
            }

            // Container name se container_size_id find karo
            $container = ContainerSize::where('container_name', $containerNames[$index])->first();

            if ($container) {
                PortWiseFreightContainer::create([
                    'port_freight_id' => $freight->id,
                    'container_size_id' => $container->id,
                    'freight_price' => $freightPrice,
                    'currency' => $currencies[$index],
                ]);
            }
        }


        return redirect()->back()->with('success', 'Freight data saved successfully.');
    }
}
