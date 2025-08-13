<x-app-layout>

    <x-slot name="header">
        Manage Reward Points
    </x-slot>

    <x-slot name="cardTitle">
        <div class="d-flex innertopnav">
            <p class="subhead pheads">Manage Reward Points</p>
        </div>
    </x-slot>
    <form action="{{ route('admin.reward_point.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group-customer customer-additional-form">
            <div class="row">
                <h5>Order-Based Reward Points</h5>
                <div class="col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="order_min" class="foncolor">Minimum Order</label>
                        <input type="number" name="order_min" class="form-control inp"
                            placeholder="Enter Minimum  Order"
                            value="{{ old('order_min', $rewardData->order_min ?? '') }}">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="order_par_min_amount" class="foncolor">Minimum Amount per Order (to be
                            counted)</label>
                        <div class="d-flex align-items-center justify-content-between form-control">
                            <input class="no-border" type="number" name="order_par_min_amount" class="form-control inp"
                                placeholder="Only orders above this amount will be counted"
                                value="{{ old('order_par_min_amount', $rewardData->order_par_min_amount ?? '') }}"
                                style="width: 100%;">
                            <i class="fa-solid fa-dollar-sign" style="color: #595C5F;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row mt-3">
                <h5>Payment-Based Reward Points</h5>
                <div class="col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="amount_min_total_invoice" class="foncolor">
                            Minimum Total Payment
                        </label>
                        <div class="d-flex align-items-center justify-content-between form-control">
                            <input class="no-border" type="number" name="amount_min_total_invoice"
                                class="form-control inp" placeholder="Enter total payment required to earn points"
                                value="{{ old('amount_min_total_invoice', $rewardData->amount_min_total_invoice ?? '') }}"
                                style="width: 100%;">
                            <i class="fa-solid fa-dollar-sign" style="color: #595C5F;"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label for="reward_dollar" class="foncolor">Reward In Dollar</label>
                        <div class="d-flex align-items-center justify-content-between form-control">
                            <input class="no-border" type="number" name="reward_dollar" class="form-control inp"
                                placeholder="Reward In Dollar"
                                value="{{ old('reward_dollar', $rewardData->reward_dollar ?? '') }}"
                                style="width: 100%;">
                            <i class="fa-solid fa-dollar-sign" style="color: #595C5F;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="add-customer-btns text-end">
            <button type="button" onclick="redirectTo('{{route('admin.reward_point.index') }}')"
                class="btn btn-outline-primary custom-btn">Cancel</button>
            <button type="submit" class="btn btn-primary ">Submit</button>

        </div>
    </form>
</x-app-layout>