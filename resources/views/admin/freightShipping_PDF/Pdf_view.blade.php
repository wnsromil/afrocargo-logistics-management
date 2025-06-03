<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Container Wise Freight') }}
        </h2>
    </x-slot>
    <table
        style=" width:100% !important; color:black; font-family: 'Times New Roman', Times, serif;
           border-top: 2px solid black !important; border-bottom: 2px solid black !important; display: block; overflow-x: auto; white-space: nowrap;">

        <td colspan="4"
            style="font-size: 18px; font-weight: 700; text-align: center; padding: 10px 0; margin: 4px 0px;">Calculation
            Report</td>
        </tr>
        <tr>
            <td style="padding: 4px; margin-left:4px; background-color: white; vertical-align: middle; height:20px !important;">Customer:</strong></td>
            <td style="width:500px; height:20px !important;">tss</td>
            <td style="width:500px; height:20px !important;">Calculation #:</strong></td>
            <td style="width:500px; height:20px !important;">tss/1</td>
        </tr>
        <tr>
            <td style="width:500px; height:20px !important;">Container :</strong></td>
            <td style="width:500px; height:20px !important;">Standard 20 Feet</td>
            <td style="width:500px; height:20px !important;">Calculation date :</strong></td>
            <td style="width:500px; height:20px !important;">30/Jan/2021</td>
        </tr>
        <tr>
            <td style="width:500px; height:20px !important;">Container Dimension :</strong></td>
            <td style="width:500px; height:20px !important;">590 x 235 x 239 cm</td>
            <td style="width:500px; height:20px !important;">From :</strong></td>
            <td style="width:500px; height:20px !important;">India - Cochin</td>
        </tr>
        <tr>
            <td style="width:500px; height:20px !important;">Container Volume/Used Volume :</strong></td>
            <td style="width:500px; height:20px !important;">10.31695/33.2000</td>
            <td style="width:500px; height:20px !important;">To :</strong></td>
            <td style="width:500px; height:20px !important;">United States - Houston, Texas</td>
        </tr>
        <tr>
            <td style="width:500px; height:20px !important;">Container Weight/Used Weight :</strong></td>
            <td style="width:500px; height:20px !important;">8373.6/21770.00</td>
            <td style="width:500px; height:20px !important;">Container Freight :</strong></td>
            <td style="width:500px; height:20px !important;">1200.0000,USD</td>
        </tr>
    </table>


    <table
        style="width:100% !important; max-width:100%; margin-top: 45px; display: block; overflow-x: auto; white-space: nowrap; color: black; font-family: 'Times New Roman', Times, serif;">
        <thead>
            <tr style="background: #f8f8f8; text-align: right; border-bottom: 1px solid black">
                <th style="padding: 4px; margin-left:4px; background-color: white; vertical-align: middle;">
                    S.No.</th>
                <th style="padding: 4px; margin-left:4px; background-color: white; vertical-align: middle;">
                    Product</th>
                <th style="padding: 4px; margin-left:4px; background-color: white; vertical-align: middle;">
                    Quantity</th>
                <th style="padding: 4px; margin-left:4px; background-color: white; vertical-align: middle;">Pack
                    Qty</th>
                <th style="padding: 4px; margin-left:4px; background-color: white; vertical-align: middle;">TNOC
                </th>
                <th
                    style="padding: 4px; margin-left:4px; text-align: left; background-color: white; vertical-align: middle;">
                    Dimension
                </th>
                <th style="padding: 4px; margin-left:4px; background-color: white; vertical-align: middle;">S.
                    Volume (m³)</th>
                <th style="padding: 4px; margin-left:4px; background-color: white; vertical-align: middle;">T.
                    Volume (m³)</th>
                <th style="padding: 4px; margin-left:4px; background-color: white; vertical-align: middle;">
                    Product Weight</th>
                <th style="padding: 4px; margin-left:4px; background-color: white; vertical-align: middle;">Pack
                    Weight</th>
                <th style="padding: 4px; margin-left:4px; background-color: white; vertical-align: middle;">
                    Carton Weight</th>
                <th style="padding: 4px; margin-left:4px; background-color: white; vertical-align: middle;">
                    Total Weight</th>
                <th style="padding: 4px; margin-left:4px; background-color: white; vertical-align: middle;">
                    Per-unit Freight</th>
                <th style="padding: 4px; background-color: white;">Per-unit Freight By Volume</th>
                <th style="padding: 4px; background-color: white;">Per-unit Freight By Weight</th>
            </tr>
        </thead>
        <tbody style="border-bottom: 1px solid black !important margin-bottom-4px">
            <tr style=" text-align: right; align-text:center;">
                <td style="padding: 4px; text-align: left; vertical-align: middle;">1</td>
                <td style="padding: 4px; text-align: left; vertical-align: middle;">Product 1</td>
                <td style="padding: 4px; vertical-align: middle;">4000</td>
                <td style="padding: 4px; vertical-align: middle;">10</td>
                <td style="padding: 4px; vertical-align: middle;">400</td>
                <td style="padding: 4px; text-align: left; vertical-align: middle;">35.00x25.00x20.00 Cm</td>
                <td style="padding: 4px; vertical-align: middle;">0.0175</td>
                <td style="padding: 4px; vertical-align: middle;">7</td>
                <td style="padding: 4px; vertical-align: middle;">1.00 Kg</td>
                <td style="padding: 4px; vertical-align: middle;">0.20 Kg</td>
                <td style="padding: 4px; vertical-align: middle;">10.2</td>
                <td style="padding: 4px; vertical-align: middle;">4080</td>
                <td style="padding: 4px; vertical-align: middle;">0.1600</td>
                <td style="padding: 4px; vertical-align: middle;">0.2035</td>
                <td style="padding: 4px; vertical-align: middle;">0.1462</td>
            </tr>
            <tr>
                <td></td>
                <td colspan="14" style="padding: 4px; text-align: left;">Product 1 Description</td>
            </tr>
            <tr style=" text-align: right;">
                <td style="padding: 4px; text-align: left; vertical-align: middle;">2</td>
                <td style="padding: 4px; text-align: left; vertical-align: middle;">Product 2</td>
                <td style="padding: 4px; vertical-align: middle;">3500</td>
                <td style="padding: 4px; vertical-align: middle;">15</td>
                <td style="padding: 4px; vertical-align: middle;">234</td>
                <td style="padding: 4px; text-align: left; vertical-align: middle;">45.00x15.00x21.00 Cm</td>
                <td style="padding: 4px; vertical-align: middle;">0.014175</td>
                <td style="padding: 4px; vertical-align: middle;">3.31695</td>
                <td style="padding: 4px; vertical-align: middle;">1.20 Kg</td>
                <td style="padding: 4px; vertical-align: middle;">0.40 Kg</td>
                <td style="padding: 4px; vertical-align: middle;">18.4</td>
                <td style="padding: 4px; vertical-align: middle;">4293.6</td>
                <td style="padding: 4px; vertical-align: middle;">0.1600</td>
                <td style="padding: 4px; vertical-align: middle;">0.1102</td>
                <td style="padding: 4px; vertical-align: middle;">0.1758</td>
            </tr>
            <tr>
                <td></td>
                <td colspan="15" style="padding: 4px; text-align: left;">Product 2 Description
                </td>
            </tr>
            <tr style="text-align: right; border-top: 1px solid black; border-bottom:1px solid black">
                <td colspan="2"></td>
                <td style="padding: 4px;">7500</td>
                <td style="padding: 4px;"></td>
                <td style="padding: 4px;">634</td>
                <td style="padding: 4px;"></td>
                <td style="padding: 4px;"></td>
                <td style="padding: 4px;">10.31695</td>
                <td style="padding: 4px;"></td>
                <td style="padding: 4px;"></td>
                <td style="padding: 4px;"></td>
                <td style="padding: 4px;">8373.6</td>
                <td colspan="3" style="padding: 4px;"></td>
            </tr>
        </tbody>
    </table>
    <p
        style="color:black !important; font-weight:800; font-family: 'Times New Roman', Times, serif; margin-top: 15px !important;">
        Generated By : CBM Calculator https://www.cbmcalculator.com/</p>

</x-app-layout>