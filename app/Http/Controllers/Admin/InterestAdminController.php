<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InterestRequest;
use App\Models\Interest;
use Illuminate\Http\JsonResponse;
use function response;

class InterestAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $interests = Interest::orderBy('id', 'desc')->get();

        return response()->json($interests);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param InterestRequest $request
     * @return JsonResponse
     */
    public function store(InterestRequest $request)
    {
        $this->authorize('interest_create');

        $request->validated();

        $interestId = Interest::create($request->post());

        return response()->json($interestId);
    }

    /**
     * Display the specified resource.
     *
     * @param Interest $interest
     * @return JsonResponse
     */
    public function show(Interest $interest)
    {
        return response()->json($interest);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param InterestRequest $request
     * @param Interest $interest
     * @return JsonResponse
     */
    public function update(InterestRequest $request, Interest $interest)
    {
        $this->authorize('interest_edit');

        $request->validated();

        $updatedInterest = $interest->fill($request->post())->save();

        return response()->json($updatedInterest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Interest $interest
     * @return JsonResponse
     */
    public function destroy(Interest $interest)
    {
        $this->authorize('interest_delete');

        $result = $interest->delete();

        return response()->json($result);
    }

    /**
     * Find resource by chosen field.
     *
     * @param Interest $interest
     * @return JsonResponse
     */
    public function find(string $by, string $value)
    {
        $result = Interest::where($by, '=', $value)->firstOrFail();

        return response()->json($result);
    }
}
