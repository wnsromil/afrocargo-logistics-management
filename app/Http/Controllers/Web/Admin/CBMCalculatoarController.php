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
        $portWiseFreight = PortWiseFreight::where('is_deleted', 'No')->get();
        return view('admin.cbm_calculatoar.FreightCalculator.Port_wise_freight', [
            'containerSizes' => $ContainerSizes,
            'countrys' => $Countrys,
            'portWiseFreights' => $portWiseFreight
        ]);
    }

    public function FreightShipping(Request $request): View
    {
        $ContainerSizes = ContainerSize::all();
        $Countrys = Country::all();
        return view('admin.cbm_calculatoar.FreightShipping.SingleShippingContainer', [
            'containerSizes' => $ContainerSizes,
            'countrys' => $Countrys,
        ]);
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
        $portFreightId = $request->input('port_wise_freights_id');

        // ✅ Only validate and create PortWiseFreight if ID is not present (i.e., new entry)
        if (empty($portFreightId)) {
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

            // ✅ Create new freight
            $freight = PortWiseFreight::create([
                'creator_user_id' => auth()->id(),
                'from_country' => $request->from_country_select,
                'from_port' => $request->from_port,
                'to_country' => $request->to_country_select,
                'to_port' => $request->to_port,
            ]);

            $portFreightId = $freight->id; // newly created id
        }

        // ✅ Step 2: Handle Container Records (Create or Update)
        $containerNames = $request->container_name;
        $freightPrices = $request->freight_price;
        $currencies = $request->currency;

        foreach ($freightPrices as $index => $freightPrice) {
            if (empty($freightPrice) || empty($currencies[$index])) {
                continue;
            }

            $container = ContainerSize::where('container_name', $containerNames[$index])->first();

            if ($container) {
                $existing = PortWiseFreightContainer::where([
                    ['port_freight_id', '=', $portFreightId],
                    ['container_size_id', '=', $container->id],
                ])->first();

                if ($existing) {
                    // ✅ Update if already exists
                    $existing->freight_price = $freightPrice;
                    $existing->currency = $currencies[$index];
                    $existing->save();
                } else {
                    // ✅ Create new if not exists
                    PortWiseFreightContainer::create([
                        'port_freight_id' => $portFreightId,
                        'container_size_id' => $container->id,
                        'freight_price' => $freightPrice,
                        'currency' => $currencies[$index],
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Freight container data saved or updated successfully.');
    }
    public function getContainersByPortFreightId($id)
    {
        try {
            // Get all container records by port_freight_id
            $containers = PortWiseFreightContainer::where('port_freight_id', $id)->get();

            // Get the portFreight data (first one will be same for all)
            $portFreight = PortWiseFreight::with('fromPort', 'toPort')->find($id);

            return response()->json([
                'status' => true,
                'message' => 'Data fetched successfully',
                'port_freight' => $portFreight,
                'container_size' => $containers
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error fetching data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroyPortFreight(string $id)
    {
        try {
            $portWiseFreight = PortWiseFreight::find($id);

            if (!$portWiseFreight) {
                return response()->json([
                    'status' => false,
                    'message' => 'Freight not found',
                ], 404);
            }

            $portWiseFreight->is_delete = 'Yes'; // or 1 if using boolean/integer
            $portWiseFreight->save();

            return response()->json([
                'status' => true,
                'message' => 'Freight deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getFreightShippingData(Request $request)
    {
        $request->validate([
            'from_country' => 'required|string',
            'from_port' => 'required|string',
            'to_country' => 'required|string',
            'to_port' => 'required|string',
            'containerSelect' => 'required|integer', // assuming container size id is integer
        ]);

        // Step 1: Find matching freight record
        $freight = PortWiseFreight::where('from_country', $request->from_country)
            ->where('from_port', $request->from_port)
            ->where('to_country', $request->to_country)
            ->where('to_port', $request->to_port)
            ->where('is_deleted', 'No')
            ->first();

        if (!$freight) {
            return response()->json([
                'success' => false,
                'message' => 'No matching freight record found.'
            ], 404);
        }

        // Step 2: Use the freight ID and containerSelect to find container data
        $containerData = PortWiseFreightContainer::where('port_freight_id', $freight->id)
            ->where('container_size_id', $request->containerSelect)
            ->first();

        $containerSizeData = ContainerSize::where('id', $request->containerSelect)->first();

        if (!$containerData) {
            return response()->json([
                'success' => false,
                'message' => 'Container data not found for selected freight and container size.'
            ], 404);
        }

        // Step 3: Return both freight and container data
        return response()->json([
            'success' => true,
            'freight_data' => $freight,
            'container_data' => $containerData,
            'containerSizeData' => $containerSizeData
        ], 200);
    }
}
