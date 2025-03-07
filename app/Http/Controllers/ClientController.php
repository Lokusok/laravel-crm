<?php

namespace App\Http\Controllers;

use App\Enums\Cache\ClientsEnum;
use App\Enums\PermissionsEnum;
use App\Http\Requests\Clients\StoreClientRequest;
use App\Http\Requests\Clients\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $cacheKey = ClientsEnum::CLIENTS_INDEX->value . ':' . ($request->page ?? '0');

        $clients = Cache::tags([ClientsEnum::GLOBAL_NAME->value])->remember($cacheKey, 30, function () {
            return Client::latest()->paginate(20);
        });

        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(StoreClientRequest $request)
    {
        $validated = $request->validated();

        Client::create($validated);

        return redirect()->route('clients.index');
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        $validated = $request->validated();

        $client->update($validated);

        return redirect()->route('clients.index');
    }

    public function destroy(Client $client)
    {
        Gate::authorize(PermissionsEnum::DELETE_CLIENTS->value);

        $client->delete();

        return redirect()->route('clients.index');
    }
}
