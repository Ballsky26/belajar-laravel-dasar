<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResponseController extends Controller
{
    public function response(Request $request): Response
    {
        return response("hello response");
    }
    public function header(Request $request): Response
    {
        $body = [
            'firstName' => 'Syaiful',
            'lastName' => 'Iqbal'
        ];

        return response(json_encode($body), 200)
            ->header('Content-Type', 'application/json')
            ->withHeaders([
                'Author' => 'Ballsky',
                'App' => 'Belajar Laravel'
            ]);
    }
    public function responseView(Request $request): Response
    {
        return response()
            ->view('hello', ['name' => 'Syaiful']);
    }
    public function responseJson(Request $request): JsonResponse
    {
        $body = [
            'firstName' => 'Syaiful',
            'lastName' => 'Iqbal'
        ];
        return response()
            ->json($body);
    }
    public function responseFile(Request $request): BinaryFileResponse
    {
        return response()
            ->file(storage_path('app/public/pictures/jual.png'));
    }

    public function responseDownload(Request $request): BinaryFileResponse
    {
        return response()
            ->download(storage_path('app/public/pictures/jual.png'));
    }
}
