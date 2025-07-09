<x-app-layout>
    <x-slot name="header">
        {{ __('Custom Invoice Report') }}
    </x-slot>


    <table width="100%"
        style="color: black; border-collapse: collapse; display: block; overflow-x: auto; white-space: nowrap;">
        <thead>
            <tr>
                <th style="width: 100% !important; font-size: 20px; font-weight: 600; padding: 8px; text-align: center;">
                    CONTAINER REPORT LIST</th>
                <th style="width: 20% !important; font-size: 17px; font-weight: 600; padding: 8px; text-align: right;">
                    Jun.3.2025--- 12:20:13
                </th>
            </tr>
        </thead>

        <body>
            <tr>
                <td
                    style="width: 40%; vertical-align: top; font-weight: 600; text-align: left; font-size: 16px; padding: 5px;">

                    Afro Cargo NYC USA<br>
                    366 Concord Ave NY The Bronx,<br>
                    10454 Tel: 718-954-9093
                </td>

                <td
                    style="width: 30%; vertical-align: top; font-weight: 600; text-align: right; font-size: 16px; padding: 5px;">
                    Doc Id: Billay3Cars<br>
                    Bill Of Lading Id: SealA091086
                </td>
            </tr>
        </body>

    </table>


    <table width="100%"
        style="color: black; font-size: 13px; border-collapse: collapse; text-align: left !important; display: block; overflow-x: auto; white-space: nowrap;">
        <thead style="font-weight: 600 !important; background-color: #f0f0f0;">
            <tr>
                <td style="border: 2px solid #203a5d; padding: 5px; text-align: center">S.No</td>
                <td style="border: 2px solid #203a5d; padding: 5px; text-align: center">Invoice</td>
                <td style="border: 2px solid #203a5d; padding: 5px; text-align: center">Container</td>
                <td style="border: 2px solid #203a5d; padding: 5px; text-align: center">Item Qty</td>
                <td style="border: 2px solid #203a5d; padding: 5px; text-align: center">Invoice Items</td>
                <td style="border: 2px solid #203a5d; text-align: center; ">Customer Name + Lic +
                    Address + Tel</td>
                <td style="border: 2px solid #203a5d; text-align: center">Ship To Name + Lic + Address + Tel</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border: 2px solid #203a5d; padding: 5px !important;  text-align: center;">1</td>
                <td style="border: 2px solid #203a5d; padding: 5px !important; ">TIV-00136</td>
                <td style="border: 2px solid #203a5d; padding: 5px !important; ">SUDU8880982</td>
                <td style="border: 2px solid #203a5d; padding: 5px !important;">1</td>
                <td style="border: 2px solid #203a5d; padding: 5px !important; ">1 large Vehicle Toyota H Lander</td>
                <td
                    style="border: 2px solid #203a5d; padding: 5px !important;  text-align: center; max-width: 250p5; o ow-wrap: break-word; word-wrap: break-word; white-space:normal">
                    Youssouf Tiaffona
                    Hawks Husband<br>279 W 171st St + 646-244-8096</td>
                <td
                    style="border: 2px solid #203a5d; padding: 5px !important;  text-align: center max-width: 255px; white-space: normal; word-wrap: break-word; white-space:normal">
                    Serine Issoufou +
                    Abidjan + 07 48 26 8928</td>
            </tr>

            <tr>
                <td style="border: 2px solid #203a5d; padding: 5px !important;  text-align: center;">2</td>
                <td style="border: 2px solid #203a5d; padding: 5px !important; ">TIV-00135</td>
                <td style="border: 2px solid #203a5d; padding: 5px !important; ">SUDU8880982</td>
                <td style="border: 2px solid #203a5d; padding: 5px !important;">1</td>
                <td style="border: 2px solid #203a5d; padding: 5px !important; ">1 Medium Vehicle Honda H481365</td>
                <td
                    style="border: 2px solid #203a5d; padding: 5px !important;  text-align: center; max-width: 255px; white-space: normal; word-wrap: break-word; white-space:normal">
                    Moussa Ouattara +
                    1401 Jesup Ave +
                    973-489-2157</td>
                <td
                    style="border: 2px solid #203a5d; text-align: center max-width: 255px; white-space: normal; word-wrap: break-word; white-space:normal">
                    Abou Tuo + + Abidjan + 05 67 64 9494</td>
            </tr>

            <tr style="background-color: #e6f0ff;">
                <td style="border: 2px solid #203a5d; padding: 5px !important;  text-align: center;">3</td>
                <td style="border: 2px solid #203a5d; padding: 5px !important; ">TIV-00134</td>
                <td style="border: 2px solid #203a5d; padding: 5px !important; ">SUDU8880982</td>
                <td style="border: 2px solid #203a5d; padding: 5px !important;">1</td>
                <td style="border: 2px solid #203a5d; padding: 5px !important; ">1 Medium Vehicle Hyundai
                    Tucson<br>HYUNKM8J3CAL5LU513579</td>
                <td
                    style="border: 2px solid #203a5d; padding: 5px !important;  text-align: center; max-width: 250p5;   rd-break: break-all; word-wrap: break-word; white-space:normal">
                    Issaa Doukouree +
                    1425 Eastern Pkwy + 347-881-2191</td>
                <td
                    style="border: 2px solid #203a5d; padding: 5px !important;  text-align: center max-width: 255px; white-space: normal; word-wrap: break-word; white-space:normal">
                    Samba Doukouree +
                    Abidjan + 07 07 16 6576</td>
            </tr>
        </tbody>
    </table>

</x-app-layout>
