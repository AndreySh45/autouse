<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\CarBusyStoreRequest;

class CarController extends Controller
{
    /**
     * @OA\Get(
     *     path="/cars",
     *     operationId="carsAll",
     *     tags={"Cars"},
     *     summary="Display a listing of the resource",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="The page number",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *         @OA\JsonContent(ref="#/components/schemas/CarShowRequest"),
     *     )
     * )
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $car = Car::where('status', '=', 1)->paginate(3);

        return response()->json($car, 201);
    }

    /**
     * @OA\Post(
     *     path="/cars",
     *     operationId="Create",
     *     tags={"Cars"},
     *     summary="Create yet another example record",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *         @OA\JsonContent(ref="#/components/schemas/CarShowRequest")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CarBusyStore")
     *     )
     * )
     *
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\CarBusyStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarBusyStoreRequest $request): JsonResponse
    {
        $data = $request->all();
        $user = User::find($data['user_id']);
        if (is_null($user)) {
            return response()->json('User not found.');
        }
        $car = Car::find($data['car_id']);
        if (is_null($car)) {
            return response()->json('Car not found.');
        }
        if ($car['status'] === 1){
            return response()->json('Car '.$car['name'].' with number '. $car['number']. ' is busy.');
        } else {
            $car['status'] = 1;
            $user->car()->save($car);
        }

        return response()->json($user, 200);
    }

    /**
     * Display the specified resource.
     *
     * @OA\Get(
     *     path="/cars/{id}",
     *     operationId="carGet",
     *     tags={"Cars"},
     *     summary="Get car by ID",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of car",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *         @OA\JsonContent(ref="#/components/schemas/CarShowRequest")
     *     ),
     * )
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = Car::findOrFail($id);

        if ($car['status'] === 1){
            return response()->json('Car '.$car['name'].' with number '. $car['number'].'- User '.$car->user['name']);
        } else {
            return response()->json('Car '.$car['name'].' with number '. $car['number']. 'is not busy');
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * * @OA\Delete(
     *     path="/cars/{id}",
     *     operationId="carFree",
     *     tags={"Cars"},
     *     summary="Release by ID",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of car",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Car is free",
     *     ),
     * )
     *
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->user()->dissociate();
        $car->status = 0;
        $car->save();

        return response()->json('Car '.$car['name'].' with number '. $car['number']. ' is free.');


    }
}
