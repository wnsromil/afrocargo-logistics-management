<x-app-layout>
    <x-slot name="header">
        {{ __('Custom Invoice Report') }}
    </x-slot>


    <table style="width: 100%; color: black;">
        <thead>
            <tr>
                <th style="width: 60% !important; font-size: 20px; font-weight: 600; padding: 8px; text-align: center;">
                    ITEM REPORT LIST </th>
                <th style="font-size: 17px; font-weight: 600; padding: 8px; text-align: right;">Jun.3.2025 ---
                    10:30:15</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td colspan="2">
                    <table style="width:60% !important; vertical-align: top; color: black;">
                        <tbody>
                            <tr>
                                <td
                                    style="width: 30% !important; height: 3px !important; font-size: 14px; text-align: left; padding: 1px">
                                    366 Concord Ave
                                </td>

                                <td
                                    style="width: 30% !important; height: 3px !important; font-size: 14px; text-align: left; padding: 1px">
                                    DocId:Billaly3Cars
                                </td>
                                <!-- 
                            <td style="width:30% !important; height: 3px !important;"></td> -->
                            </tr>

                            <tr>
                                <td
                                    style="width: 30% !important; height: 3px !important; font-size: 14px; text-align: left; padding: 1px">
                                </td>

                                <td
                                    style="width: 30% !important; height: 3px !important; font-size: 14px; text-align: left; padding: 1px">
                                    Bill Of Lading: SealA091086
                                </td>

                                <!-- <td style="width:30% !important; height: 3px !important;"></td> -->
                            </tr>

                            <tr>
                                <td
                                    style="width: 30% !important; height: 3px !important; font-size: 14px; text-align: left;">
                                    NY, The Bronx 10454
                                </td>

                                <td
                                    style="width: 30% !important; height: 3px !important; font-size: 14px; text-align: left;">
                                    Bill Of Lading: SealA091086
                                </td>

                                <!-- <td style="width:30% !important; height: 3px !important;"></td> -->
                            </tr>
                            <tr>
                                <td
                                    style="width: 30% !important; height: 3px !important; font-size: 14px; text-align: left; padding: 1px">
                                    Tel : 718-954-9093
                                </td>
                                <td
                                    style="width: 30% !important; height: 3px !important; font-size: 14px; text-align: left; padding: 1px">
                                </td>
                                <!-- <td style=" width:30% !important; height: 3px !important;"></td> -->
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 2px; margin-top: 5px;">
                        <thead style="text-align: center !important; border: 2px solid #c13232 !important">
                            <tr>
                                <th
                                    style="width:30% !important; border: 2px solid #c13232; font-size: 16px !important; font-weight:500 !important; border: 2px solid #c13232 !important; padding: 5px;">
                                    Items</th>
                                <th
                                    style="width:30% !important; border: 2px solid #c13232; font-size: 16px !important; font-weight:500 !important; border: 2px solid #c13232 !important; padding: 5px;">
                                    Item
                                    Description</th>
                                <th
                                    style="width:30% !important; border: 2px solid #c13232; font-size: 16px !important; font-weight:500 !important; border: 2px solid #c13232 !important; padding: 5px;">
                                    Qty</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: left; border: 2px solid #c13232 !important">
                            <tr>
                                <td style="border-right:2px solid #c13232;  padding: 5px; ">
                                    TII-002967</td>
                                <td
                                    style="border-right:2px solid #c13232;  padding: 5px; text-align: center !important">
                                    Medium Vehicle Hyundai Tucson
                                    HYUNKM8J3CAL5LU151379</td>
                                <td style="border-right:2px solid #c13232; padding: 5px; ">1
                                </td>
                            </tr>

                            <tr>
                                <td style="border-right:2px solid #c13232; padding: 5px; ">
                                    TII-002966</td>
                                <td
                                    style="border-right:2px solid #c13232;  padding: 5px; text-align: center !important">
                                    Medium Vehicle Honda H481365 </td>
                                <td style="border-right:2px solid #c13232; padding: 5px; ">1
                                </td>
                            </tr>

                            <tr>
                                <td style="border-right:2px solid #c13232; padding: 5px; ">
                                    TII-002929</td>
                                <td
                                    style="border-right:2px solid #c13232;  padding: 5px; text-align: center !important">
                                    large Vehicle Toyota H Lander </td>
                                <td style="border-right:2px solid #c13232;  padding: 5px; ">1
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>

            </tr>




        </tbody>
    </table>

</x-app-layout>