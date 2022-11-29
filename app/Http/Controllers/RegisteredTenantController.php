<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\RegisterTenantRequest;

class RegisteredTenantController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }
    public function store(RegisterTenantRequest $req)
    {
        $tenant = Tenant::create($req->validated());
        $tenant->createDomain(['domain' => $req->domain]);

        return redirect(
            tenant_route($tenant->domains->first()->domain, 'tenant.login')
        );
    }
}
