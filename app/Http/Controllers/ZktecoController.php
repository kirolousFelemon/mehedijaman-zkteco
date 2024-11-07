<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Raysulkobir\ZktecoLaravel\Lib\ZKTeco;

class ZktecoController extends Controller
{
    protected $zkTeco;
    public function __construct(ZKTeco $zkTeco)
    {
        $this->zkTeco = $zkTeco;
    }

    public function getAttendanceData()
    {
        try {
            // Retrieve attendance logs
            $device = new ZKTeco();
            $device->connect();
            $getAllAttendanceData = $device->getAttendance();
            // Return the logs as JSON response
            
            return response()->json([
                'success' => true,
                'data' => $getAllAttendanceData
            ]);
        } catch (\Exception $e) {
            // Handle connection errors or failed fetch
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getUsers()
    {
        try {
            // Retrieve user data
            $users = $this->zkTeco->getUsers();

            // Return the users as JSON response
            return response()->json([
                'success' => true,
                'data' => $users
            ]);
        } catch (\Exception $e) {
            // Handle connection errors or failed fetch
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function __destruct()
    {
        // Close connection to the device
        $this->zkTeco->disconnect();
    }
}
