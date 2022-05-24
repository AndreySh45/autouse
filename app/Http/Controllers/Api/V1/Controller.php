<?php

namespace App\Http\Controllers\Api\V1;

/**
 * @OA\Info(
 *     title="Use auto API documentation",
 *     version="1.0.1",
 *     @OA\Contact(
 *         email="and45@mail.ru"
 *     ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 * @OA\Tag(
 *     name="Cars",
 *     description="Cars use now",
 * )
 * @OA\Server(
 *     description="Use auto API server",
 *     url="http://autouse/api/V1"
 * )
 * @OA\SecurityScheme(
 *     type="apiKey",
 *     in="header",
 *     name="X-APP-ID",
 *     securityScheme="X-APP-ID"
 * )
 */

class Controller extends \App\Http\Controllers\Controller
{
}
