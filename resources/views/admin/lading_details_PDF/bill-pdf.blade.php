<x-app-layout>

    <x-slot name="header">
        Bill of Lading Detail
    </x-slot>

    <x-slot name="cardTitle">
            <p class="subhead pheads" >PDF Bill of Lading Detail</p>
    
    </x-slot>

    <table style="width: 100%; color: black;">
        <tr>
            <th colspan="2"
                style="font-size: 20px; font-weight: semibold; background-color: #22392c; color: white; padding: 8px; text-align: center;">
                Bill Of Lading</th>
        </tr>
        <tr>
            <td style="width: 50% !important; border: 1px solid #666; vertical-align: top;">
                <table style="width: 100%; border-collapse: separate; border-spacing: 1px">
                    <tr>
                        <th
                            style="font-size: 18px; background-color: #22392c; text-align: center; color: white; padding: 5px;">
                            Shipper/Exporter</th>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; padding: 5px;">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 30%; height: 5px !important">Company:</td>
                                    <td style="height: 5px !important">Ivoirien Cargo</td>
                                </tr>
                                <tr>
                                    <td style="height: 5px !important">FullName:</td>
                                    <td style="height: 5px !important">Sacko</td>
                                </tr>
                                <tr>
                                    <td style="height: 5px !important">Address:</td>
                                    <td style="height: 5px !important">366 Concord Ave</td>
                                </tr>
                                <tr>
                                    <td style="height: 5px !important">City:</td>
                                    <td style="height: 5px !important">The Bronx</td>
                                </tr>
                                <tr>
                                    <td style="height: 5px !important">State:</td>
                                    <td style="height: 5px !important">NY</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th
                            style="font-size: 18px; background-color: #22392c; color: white; padding: 5px; text-align: center;">
                            Consignee
                        </th>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #ccc; padding: 5px;">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 30%; height: 5px !important">Company:</td>
                                    <td style="height: 5px !important">Ivoirien Cargo</td>
                                </tr>
                                <tr>
                                    <td style="height: 5px !important">FullName:</td>
                                    <td style="height: 5px !important">Sacko</td>
                                </tr>
                                <tr>
                                    <td style="height: 5px !important">Address:</td>
                                    <td style="height: 5px !important">366 Concord Ave</td>
                                </tr>
                                <tr>
                                    <td style="height: 5px !important">City:</td>
                                    <td style="height: 5px !important">The Bronx</td>
                                </tr>
                                <tr>
                                    <td style="height: 5px !important">State:</td>
                                    <td style="height: 5px !important">NY</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th
                            style="font-size: 18px; background-color: #22392c; color: white; padding: 5px; text-align: center;">
                            NotifyParty</th>
                    </tr>
                    <tr>
                        <td style="height: 5px !important; border:1px solid black;"></td>
                    </tr>
                    <tr>
                        <th
                            style="font-size: 18px; background-color: #22392c; color: white; padding: 5px; text-align: center;">
                            Paier</th>
                    </tr>
                    <tr>
                        <td style="height: 5px !important; border:1px solid black;"></td>
                    </tr>
                    <tr>
                        <td style="padding: 0;">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 50%; border: 1px solid #666; vertical-align: top;">
                                        <table style="width: 100%;">
                                            <tr>
                                                <th
                                                    style="font-size: 18px; background-color: #22392c; color: white; text-align: center; padding: 5px;">
                                                    Vessel - Voyage NO.</th>
                                            </tr>
                                            <tr>
                                                <td style="height: 5px !important; border:1px solid black;"></td>
                                            </tr>
                                            <tr>
                                                <th
                                                    style="font-size: 18px; background-color: #22392c; color: white; text-align: center; padding: 5px;">
                                                    Port Of Dischard</th>
                                            </tr>
                                            <tr>
                                                <td style="height: 5px !important; border:1px solid black;"></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="width: 50%; border: 1px solid #666; vertical-align: top;">
                                        <table style="width: 100%;">
                                            <tr>
                                                <th
                                                    style="font-size: 18px; background-color: #22392c; color: white; text-align: center; padding: 5px;">
                                                    Port Of Loading</th>
                                            </tr>
                                            <tr>
                                                <td style="height: 5px !important; border:1px solid black;"></td>
                                            </tr>
                                            <tr>
                                                <th
                                                    style="font-size: 18px; background-color: #22392c; color: white; text-align: center; padding: 5px;">
                                                    Place Of Delivery</th>
                                            </tr>
                                            <tr>
                                                <td style="height: 5px !important; border:1px solid black;"></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>

            <td style="width: 50% !important; border: 1px solid #666; vertical-align: top;">
                <table style="width: 100%; border-collapse: separate; border-spacing: 1px">
                    <tr>
                        <th
                            style="font-size: 18px; background-color: #22392c; color: white; padding: 5px; text-align: center;">
                            Document No
                        </th>
                    </tr>
                    <tr>
                        <td style="height:39px !important; border: 1px solid black"></td>
                    </tr>
                    <tr>
                        <th
                            style="font-size: 18px; background-color: #22392c; color: white; padding: 5px; text-align: center;">
                            Expert
                            Referent</th>
                    </tr>
                    <tr>
                        <td style="height:39px !important; border: 1px solid black"></td>
                    </tr>
                    <tr>
                        <th
                            style="font-size: 18px; background-color: #22392c; color: white; padding: 5px; text-align: center;">
                            Forwarding Agent-Reference</th>
                    </tr>
                    <tr>
                        <td style="height:39px !important; border: 1px solid black"></td>
                    </tr>
                    <tr>
                        <th
                            style="font-size: 18px; background-color: #22392c; color: white; padding: 5px; text-align: center;">
                            Point and Country Of origin</th>
                    </tr>
                    <tr>
                        <td style="height:39px !important; border: 1px solid black"></td>
                    </tr>
                    <tr>
                        <th
                            style="font-size: 18px; background-color: #22392c; color: white; padding: 5px; text-align: center;">
                            Domestic
                            Routing/Export Instruction</th>
                    </tr>
                    <td style="height: 5px !important; border:1px solid black;"></td>
                    <tr>
                        <th
                            style="font-size: 18px; background-color: #22392c; color: white; padding: 5px; text-align: center;">
                            Delivery Agent
                        </th>
                    </tr>
                    <tr>
                        <td style="height: 0px !important;"></td>
                    </tr>
                    <tr>
                        <td style="height: 0px !important;"></td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td colspan="2" style="border: 1px solid #000;">
                <table style="width: 100%; border-collapse: collapse; margin-bottom:2px;">
                    <tr>
                        <th colspan="5"
                            style="font-size: 18px; background-color: #22392c; color: white; text-align: center; padding: 5px;">
                            Particulars Furnished by Shipper</th>
                    </tr>
                    <tr>
                        <th style="font-size: 18px; background-color: #22392c; color: white; padding: 5px; border-right: 2px solid white;">Make and
                            Number</th>
                        <th style="font-size: 18px; background-color: #22392c; color: white; padding: 5px;">No of
                            packages</th>
                        <th style="font-size: 18px; background-color: #22392c; color: white; padding: 5px;">Description
                            of Packages And
                            Goods</th>
                        <th style="font-size: 18px; background-color: #22392c; color: white; padding: 5px;">Gross Weight
                        </th>
                        <th style="font-size: 18px; background-color: #22392c; color: white; padding: 5px; border-left: 2px solid white;">Measurement
                        </th>
                    </tr>
                    <tr>
                        <td style="border: 2px solid black; height: 20px;"></td>
                        <td style="border: 2px solid black;"></td>
                        <td style="border: 2px solid black;"></td>
                        <td style="border: 2px solid black;">NA</td>
                        <td style="border: 2px solid black;">NA</td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td colspan="2" style="border-bottom: 3px solid black;">
                <table style="width: 100%; margin: 0px 2px;">
                    <tr style="border-bottom: 10px;">
                        <th colspan="2"
                            style="font-size: 18px; background-color: #22392c; color: white; text-align: center; padding: 5px;">
                            Company</th>
                    </tr>
                    <tr>
                        <td style="width: 50%; vertical-align: top;">
                            <table style="width: 100%; margin-top: 2px;">
                                <tr>
                                    <th
                                        style="font-size: 18px; background-color: #22392c; color: white; text-align: center; padding: 5px;">
                                        Delivery BY</th>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;">ARRIVED DATE:_______ TIME:_______</td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;">UNLOADED DATE:_______ TIME:_______</td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;">CHECKED BY:____________</td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;">CHECKED BY:____________</td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;">PLACE IN SHIP ON DOCK LOCATION:____________</td>
                                </tr>
                            </table>
                        </td>
                        <td style="width: 50%; vertical-align: top;">
                            <table style="width: 100%; margin-top: 2px;">
                                <tr>
                                    <th
                                        style="font-size: 18px; background-color: #22392c; color: white; text-align: center; padding: 5px;">
                                        Comment</th>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;">For Master :</td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;">By : __________</td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;">Receiving clear :</td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;"></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;">Date : __________</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</x-app-layout>