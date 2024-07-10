<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Repositories\AuthRepository;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    use ResponseTrait;

    public function __construct(private AuthRepository $auth)
    {
        $this->auth = $auth;
    }

    public function login(LoginRequest $request)
    {
        try {
            $data = $this->auth->login($request->all());

            return $this->responseSuccess($data, 'Logged in successfully.',200);
        } catch (Exception $exception) {
            return $this->responseError([], $exception->getMessage(),401);
        }
    }

       public function testInsertPerformance()
{
    $startTime = microtime(true);
    $batchSize = 1000; // Start with 1000 records per batch
    $totalInsertedRecords = 0;
    $maxTimeInSeconds = 1;

    while (true) {
        $records = [];

        for ($i = 0; $i < $batchSize; $i++) {
            $records[] = [
                'name' => 'User ' . uniqid(),
                'email' => uniqid() . '@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('users1')->insert($records);
        $totalInsertedRecords += $batchSize;

        $currentTime = microtime(true);
        if (($currentTime - $startTime) >= $maxTimeInSeconds) {
            break;
        }
    }

    $executionTime = microtime(true) - $startTime;
    Log::info("Inserted $totalInsertedRecords records in $executionTime seconds.");
    return response()->json([
        'total_inserted_records' => $totalInsertedRecords,
        'execution_time' => $executionTime,
    ]);
}

    
}
