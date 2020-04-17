<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

abstract class ApiController extends Controller
{
//    /**
//     * ApiController constructor.
//     */
//    public function __construct()
//    {
////        $this->middleware('auth:api');
//    }

    /**
     * @param $status
     * @param $body
     * @param $httpCode
     * @return JsonResponse
     */
    private function send($status, $body, $httpCode) : JsonResponse
    {
        return response()->json([
            'status'=> $status,
            'data' => $body
        ])->setStatusCode($httpCode);
    }

    /**
     * @param $body
     * @return JsonResponse
     */
    protected function success($body) : JsonResponse
    {
        return $this->send('success', $body, 200);
    }

    /**
     * @return JsonResponse
     */
    protected function created($body) : JsonResponse
    {
        return $this->send('created', $body, 201);
    }

    /**
     * @param $body
     * @return JsonResponse
     */
    protected function badRequest($body) : JsonResponse
    {
        return $this->send('bad_request', $body, 400);
    }

    /**
     * @param null $body
     * @return JsonResponse
     */
    protected function unauthorized($body = null) : JsonResponse
    {
        if(is_null($body)) {
            $body = "You are unauthorized to make this request.";
        }
        return $this->send('unauthorized', $body, 401);
    }

    /**
     * @param null $body
     * @return JsonResponse
     */
    protected function forbidden($body = null) : JsonResponse
    {
        if(is_null($body)) {
            $body = "Forbidden";
        }
        return $this->send('forbidden', $body, 403);
    }

    /**
     * @param null $body
     * @return JsonResponse
     */
    protected function notFound($body = null) : JsonResponse
    {
        if(is_null($body)) {
            $body = "Unable to find requested content.";
        }
        return $this->send('not_found', $body, 404);
    }

    /**
     * @param null $body
     * @return JsonResponse
     */
    protected function error($body = null) : JsonResponse
    {
        if(is_null($body)) {
            $body = "There was an internal server error.";
        }
        return $this->send('internal_server_error', $body, 500);
    }

    /**
     * @param null $body
     * @return JsonResponse
     */
    protected function accepted($body = null) : JsonResponse
    {
        if(is_null($body)) {
            $body = "The request has been accepted and will processed shortly.";
        }
        return $this->send('accepted', $body, 202);
    }

    /**
     * @return JsonResponse
     */
    protected function deleted() : JsonResponse
    {
        return $this->send('deleted', 'The requested entity has been deleted', 200);
    }
}
