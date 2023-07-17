<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function update(Request $request, Role $role)
    {
        // authorize the user's action
        $this->authorize('update', $role);

        // update the post
        $role->update($request->all());

        return redirect()->route('DashShowBlog', $role);
    }

    public function create(Request $request, Role $role)
    {
        // authorize the user's action
        $this->authorize('create', $role);

        // update the post
        $role->create($request->all());

        return redirect()->route('DashShowBlog', $role);
    }

    public function delete(Request $request, Role $role)
    {
        // authorize the user's action
        $this->authorize('delete', $role);

        // update the post
        $role->delete($request->all());

        return redirect()->route('DashShowBlog', $role);
    }
}
