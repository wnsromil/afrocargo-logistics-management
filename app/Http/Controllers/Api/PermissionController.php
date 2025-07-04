<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PermissionController extends Controller
{
    //

    public function getUserPermissions(Request $request)
    {
        try{

            $user = $request->user();
            $userId = $user->id;
            $userPermissions = $user->getAllPermissions()->pluck('name');
            $roles = $user->getRoleNames();

            // Get all permissions for filter dropdown
            $permissions = Permission::orderBy('name')->get()->map(function ($permission) use ($userPermissions,$userId) {
                return [
                    'id' => $permission->id,
                    'user_id' => $userId,
                    'name' => $permission->name,
                    'guard_name' => $permission->guard_name,
                    'isAllowed' => $userPermissions->contains($permission->name),
                    // 'isAllowed' => true
                ];
            });

            return response()->json([
                // 'user'=>$user,
                'permissions' => $permissions,
                'userPermissions' => $userPermissions,
                'roles' => $roles,
                
            ]);
        } catch (\Exception $e) {
            // Log the exception and return a proper error response
            \Log::error($e);
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching permissions.'
            ], 500);
        }
    }

    public function updatePermissions(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,name'
        ]);

        $currentUser = $request->user();
        if (!$currentUser->hasRole('admin')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Only admin can assign permissions.'
            ], 403);
        }
        $userId = $request->input('user_id');
        $user = User::findOrFail($userId);
        $user->syncPermissions($validated['permissions'] ?? []);

        return response()->json([
            'success' => true,
            'message' => 'Permissions updated successfully',
            'userPermissions' => $user->getAllPermissions()->pluck('name')
        ]);
    }

}
