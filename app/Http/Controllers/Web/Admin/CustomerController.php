<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\{User, Menu, Container, Warehouse, Country};
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $customers = User::when($this->user->role_id != 1, function ($q) {
            return $q->where('warehouse_id', $this->user->warehouse_id);
        })->where('role_id', 3)->latest()->paginate(5);


        return view('admin.customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        $warehouses = Warehouse::where('status', 'Active')->get();
        $countries = Country::all();
        return view('admin.customer.create', compact('roles', 'warehouses', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // try {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'contact_no1' => 'required|digits:10',
                'email' => 'required|string|max:255|unique:users,email',
                'alternate_mobile_no' => 'nullable|digits:10',
                'address_1' => 'required|string|max:255',
                'country' => 'required|string|exists:countries,id',
                'state' => 'required|string',
                'city' => 'required|string',
                'Zip_code' => 'required|string|max:10',
                'username' => 'required|string|max:255|unique:users,username',
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required|string',
                'latitude' => 'nullable|numeric', // Optional
                'longitude' => 'nullable|numeric' // Optional
            ]);

            $imagePaths = [];
            foreach (['signature', 'contract_signature', 'license_picture'] as $imageType) {
                if ($request->hasFile($imageType)) {
                    $file = $request->file($imageType);
                    $fileName = time() . '_' . $imageType . '.' . $file->getClientOriginalExtension();
                    $filePath = $file->storeAs('uploads/customer', $fileName, 'public');
                    $imagePaths[$imageType] = 'uploads/customer/' . $fileName; // Store path in DB
                }
            }


            // 🛠 Mapping Request Fields to Database Fields
            $userData = [
                'name'          => $validated['first_name'],
                'email'          => $validated['email'],
                'phone'   => $validated['contact_no1'],
                'phone_2'      => $validated['alternate_mobile_no'] ?? null, // Optional Field
                'address'        => $validated['address_1'],
                'address_2'        => $request->Address_2,
                'country_id'     => $validated['country'],
                'state_id'       => $validated['state'],
                'city_id'        => $validated['city'],
                'pincode'            => $validated['Zip_code'],
                'password'       => Hash::make($validated['password']),
                'status'      => ($request->status === 'on') ? 'Inactive' : 'Active',
                'company_name'        => $request->company_name,
                'apartment'        => $request->apartment,
                'username'      => $validated['username'],
                'latitude'       => $validated['latitude'] ?? null, // Optional Field
                'longitude'      => $validated['longitude'] ?? null, // Optional Field
                'website_url'        => $request->website_url,
                'write_comment'        => $request->write_comment,
                'read_comment'        => $request->read_comment,
                'language'        => $request->language,
                'year_to_date'        => $request->year_to_date,
                'license_number'        => $request->license_number,
                'warehouse_id'        => $request->warehouse_id,
                'signature_img' => $imagePaths['signature'] ?? null,
                'contract_signature_img' => $imagePaths['contract_signature'] ?? null,
                'license_document' => $imagePaths['license_picture'] ?? null,
                'signup_type' => 'for_admin'
            ];
            if (!empty($request->license_expiry_date)) {
                $userData['license_expiry_date'] = Carbon::createFromFormat('m/d/Y', $request->license_expiry_date)->format('Y-m-d');
            }

            if (!empty($request->signature_date)) {
                $userData['signature_date'] = Carbon::createFromFormat('m/d/Y', $request->signature_date)->format('Y-m-d');
            }

            // 📌 Create User
            $user = User::create($userData);

            return redirect()->route('admin.customer.index')
                ->with('success', 'User created successfully');
        // } catch (\Illuminate\Validation\ValidationException $e) {
        //     // Validation Errors dikhane ke liye
        //     return response()->json(['errors' => $e->errors()], 422);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('admin.customer.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('admin.customer.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);

        return redirect()->route('admin.customer.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('admin.customer.index')
            ->with('success', 'User deleted successfully');
    }
}
