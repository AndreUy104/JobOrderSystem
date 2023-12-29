<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function show(){

        $monthlySales = Order::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(total) as total')
            ->groupBy('month')
            ->get();

        $monthlyOrderCounts = Order::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        return view('admin',[
            'users' => User::paginate(10),
            'monthSales' => $monthlySales,
            'monthTotalSales' => $monthlyOrderCounts,
        ]);
    }

    public function toggleAdminAccess(Request $request, $userId)
    {
        $user = User::find($userId);

        if ($user) {
            $user->is_admin = !$user->is_admin;
            $user->save();

            return redirect()->route('admin')->with('success', 'User updated successfully!');
        }

        return redirect()->route('admin')->with('error', 'User not found or error occurred!');

    }

}
