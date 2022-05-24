<?php

namespace App\Smart;

/**
 * @OA\Schema(
 *     type="object",
 *     title="Car storring request",
 *     description="Some simple request createa as example",
 * )
 */
class CarBusyStore
{
    /**
     * @OA\Property(
     *     title="User",
     *     description="User of key for storring",
     *     example="4",
     * )
     *
     * @var int
     */
    public $user_id;

    /**
     * @OA\Property(
     *     title="Car",
     *     description="Value for storring",
     *     example="7",
     * )
     *
     * @var int
     */
    public $car_id;
}
