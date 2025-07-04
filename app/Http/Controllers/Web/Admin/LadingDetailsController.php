<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BillOfLadingDetail;
use App\Models\BillOfLanding;

class LadingDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        
        $query = BillOfLadingDetail::with(['shipperDetails', 'consigneeDetails']);
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
            $q->where('unique_id', 'like', "%{$search}%")
            ->orWhere('notify_party', 'like', "%{$search}%")
            //   ->orWhere('pier', 'like', "%{$search}%")
            //   ->orWhere('vessel', 'like', "%{$search}%")
            //   ->orWhere('port_of_dischard', 'like', "%{$search}%")
            //   ->orWhere('port_of_loading', 'like', "%{$search}%")
            //   ->orWhere('place_of_delivery', 'like', "%{$search}%")
            //   ->orWhere('document_no', 'like', "%{$search}%")
            //   ->orWhere('expert_referent', 'like', "%{$search}%")
            //   ->orWhere('forwarding_agent_reference', 'like', "%{$search}%")
            //   ->orWhere('point_and_country_of_origin', 'like', "%{$search}%")
            //   ->orWhere('domestic_routing_export_instruction', 'like', "%{$search}%")
            //   ->orWhere('delivery_agent', 'like', "%{$search}%")
            //   ->orWhere('mark_and_no', 'like', "%{$search}%")
            //   ->orWhere('no_of_packages', 'like', "%{$search}%")
            //   ->orWhere('desc_of_packages', 'like', "%{$search}%")
            //   ->orWhere('delivery_list', 'like', "%{$search}%")
              ->orWhereHas('shipperDetails', function ($q) use ($search) {
                  $q->where('unique_id', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%");
              })
              ->orWhereHas('consigneeDetails', function ($q) use ($search) {
                  $q->where('unique_id', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%");
              });
            });
        }

        $billOfLadingDetails = $query->latest()
            ->paginate($perPage)
            ->appends(['search' => $search, 'per_page' => $perPage]);
        if (request()->ajax()) {
            return view('admin.lading_details.table', compact('billOfLadingDetails'))->render();
        }
        // If not an AJAX request, return the main view
        return view('admin.lading_details.index', compact('billOfLadingDetails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $billOfLadings = BillOfLanding::all();
       return view('admin.lading_details.create', compact('billOfLadings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validate = $request->validate([
            'shipperDetails_id' => 'required|exists:bill_of_landings,id',
            'consigneeDetails_id' => 'required|exists:bill_of_landings,id',
            'notify_party' => 'nullable|string',
            'pier' => 'nullable|string',
            'vessel' => 'nullable|string',
            'port_of_dischard' => 'nullable|string',
            'port_of_loading' => 'nullable|string',
            'place_of_delivery' => 'nullable|string',
            'document_no' => 'nullable|string',
            'expert_referent' => 'nullable|string',
            'forwarding_agent_reference' => 'nullable|string',
            'point_and_country_of_origin' => 'nullable|string',
            'domestic_routing_export_instruction' => 'nullable|string',
            'delivery_agent' => 'nullable|string',
            'mark_and_no' => 'nullable|string',
            'no_of_packages' => 'nullable|string',
            'desc_of_packages' => 'nullable|string',
            'delivery_list' => 'nullable|string',
        ]);
        BillOfLadingDetail::create($validate);
        return redirect()->route('admin.lading_details.index')->with('success', 'Lading details created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $billOfLadingDetail = BillOfLadingDetail::with(['shipperDetails','consigneeDetails'])->findOrFail($id);
        $billOfLadings = BillOfLanding::all();
        return view('admin.lading_details.edit', compact('billOfLadingDetail', 'billOfLadings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validate = $request->validate([
            'shipperDetails_id' => 'required|exists:bill_of_landings,id',
            'consigneeDetails_id' => 'required|exists:bill_of_landings,id',
            'notify_party' => 'nullable|string',
            'pier' => 'nullable|string',
            'vessel' => 'nullable|string',
            'port_of_dischard' => 'nullable|string',
            'port_of_loading' => 'nullable|string',
            'place_of_delivery' => 'nullable|string',
            'document_no' => 'nullable|string',
            'expert_referent' => 'nullable|string',
            'forwarding_agent_reference' => 'nullable|string',
            'point_and_country_of_origin' => 'nullable|string',
            'domestic_routing_export_instruction' => 'nullable|string',
            'delivery_agent' => 'nullable|string',
            'mark_and_no' => 'nullable|string',
            'no_of_packages' => 'nullable|string',
            'desc_of_packages' => 'nullable|string',
            'delivery_list' => 'nullable|string',
            'email' => 'nullable|string|email',
        ]);
        $billOfLadingDetail = BillOfLadingDetail::findOrFail($id);
        $billOfLadingDetail->update($validate);
        return redirect()->route('admin.lading_details.index')->with('success', 'Lading details updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $billOfLadingDetail = BillOfLadingDetail::findOrFail($id);
        $billOfLadingDetail->delete();
        return redirect()->route('admin.lading_details.index')->with('success', 'Lading details deleted successfully.');
    }

    public function billOfLading($id)
    {
        $shipperDetails = BillOfLanding::findOrFail($id);
        return response()->json($shipperDetails);
    }

    public function billOfLadingPdf($id)
    {
        $billOfLading = BillOfLadingDetail::with(['shipperDetails', 'consigneeDetails'])->findOrFail($id);

        $pdf = \PDF::loadView('admin.bill_of_lading.pdf.bill-of-lading-pdf', compact('billOfLading'));
        
        $pdf->setPaper('A4', 'portrait');

        // First return the PDF as a response to load it
        // Then you can call download() on the client side if needed
        return $pdf->stream('bill_of_lading_' . $billOfLading->unique_id . '.pdf');
    }
}
