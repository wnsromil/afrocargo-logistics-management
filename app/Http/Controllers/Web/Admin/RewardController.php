<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{AdminReward, UserReward};

class RewardController extends Controller
{
    //
    public function index()
    {
        $rewardData = AdminReward::where('created_id', auth()->id())->first();
        return view('admin.settings.reward_point', compact('rewardData'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_min' => 'required|numeric|min:0',
            'order_par_min_amount' => 'required|numeric|min:0',
            'order_par_reward_dollar' => 'required|numeric|min:0',
            'amount_min_total_invoice' => 'required|numeric|min:0',
            'reward_dollar' => 'required|numeric|min:0',
        ]);

        $reward = AdminReward::updateOrCreate(
            ['created_id' => auth()->id()],
            [
                'order_min' => $request->order_min,
                'order_par_min_amount' => $request->order_par_min_amount,
                'order_par_reward_dollar' => $request->order_par_reward_dollar,
                'amount_min_total_invoice' => $request->amount_min_total_invoice,
                'reward_dollar' => $request->reward_dollar,
            ]
        );

        return redirect()->route('admin.reward_point.index')->with('success', 'Reward point updated successfully!');
    }
}
