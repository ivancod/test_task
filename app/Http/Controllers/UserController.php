<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\{JsonResponse, RedirectResponse, Response};
use Illuminate\View\View;
use App\Services\UserService;

class UserController extends Controller
{
    private UserService $userService;

    /**
     * UserController constructor
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a dashboard of the user
     *
     * @param string $url
     * @return View
     */
    public function dashboard($url): View
    {
        try {
            $this->userService->checkUrl($url);
        } catch (\Exception $th) {
            abort($th->getCode(), $th->getMessage());
        }

        return view('pages.dashboard');
    }
   
    /**
     * Create a new user
     * 
     * @return JsonResponse
     */
    public function register(): JsonResponse
    {
        try {
            request()->validate([
                'name' => 'required',
                'phone' => 'required|unique:users',
            ]);
        } catch (\Illuminate\Validation\ValidationException $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ])->setStatusCode($th->status);
        }

        try {
            $data = $this->userService->create(request());
        } catch (\Exception $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ])->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    /**
     * Regenerate access URL
     * 
     * @return RedirectResponse
     */
    public function regenerateUrl(): RedirectResponse
    {
        $url = request()->input('url');

        try {
            $user = $this->userService->regenerateUrl($url);
        } catch (\Exception $th) {
            abort(500, $th->getMessage());
        }

        return redirect()->route('dashboard', $user->access_url);
    }

    /**
     * Deactivate access URL
     * 
     * @return RedirectResponse
     */
    public function deactivateUrl(): RedirectResponse
    {
        $url = request()->input('url');

        try {
            $this->userService->deactivateUrl($url);
        } catch (\Exception $th) {
            abort(500);
        }

        return redirect('/');
    }

    /**
     * Show user history
     * 
     * @return JsonResponse
     */
    public function history(): JsonResponse
    {
        $url = request()->input('url');

        try {
            $user = $this->userService->history($url);
        } catch (\Exception $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ])->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }

    /**
     * Try play in game 'imfeelinglucky'
     * 
     * @return JsonResponse
     */
    public function imfeelinglucky(): JsonResponse
    {
        $url = request()->input('url');

        try {
            $result = $this->userService->imfeelinglucky($url);
        } catch (\Exception $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ])->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'status' => 'success',
            'data' => $result
        ]);
    }
}
