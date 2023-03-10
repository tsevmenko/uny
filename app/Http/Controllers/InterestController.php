<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\InterestRequest;
use App\Models\Interest;
use Illuminate\Http\JsonResponse;
use function response;

class InterestController extends Controller
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
    public function index(): JsonResponse
    {
        $interests = Interest::orderBy('id', 'desc')->get();

        return response()->json($interests);
    }

    /**
     * Display the specified resource.
     *
     * @param Interest $interest
     * @return JsonResponse
     */
    public function show(Interest $interest): JsonResponse
    {
        return response()->json($interest);
    }

    /**
     * Find resource by chosen field.
     *
     * @param string $by
     * @param string $value
     * @return JsonResponse
     */
    public function find(string $by, string $value): JsonResponse
    {
        $result = Interest::where($by, '=', $value)->firstOrFail();

        return response()->json($result);
    }
}
