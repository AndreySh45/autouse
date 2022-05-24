<?php

namespace App\Smart;

/**
 * @OA\Schema(
 *     type="object",
 *     title="Car showing request",
 *     description="Some simple request createa as example",
 * )
 */
class CarShowRequest
{
    /**
     * @OA\Property(
     *     title="User",
     *     description="Unique ID",
     *     example="1",
     * )
     *
     * @var int
     */
    public $user_id;

    /**
     * @OA\Property(
     *     title="Car",
     *     description="Unique ID",
     *     example="3",
     * )
     *
     * @var int
     */
    public $car_id;

}
