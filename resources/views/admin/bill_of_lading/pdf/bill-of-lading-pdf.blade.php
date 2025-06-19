<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table style="width: 100%; max-width: 800px; margin: auto; color: black; border: 1px solid #000;">
        <tr>
            <th colspan="2"
                style="font-size: 20px; font-weight: semibold; background-color: #203a5f; color: white; padding: 8px; text-align: center;">
                Bill Of Lading</th>
        </tr>
        <tr>
            <td style="width: 50% !important; border: 1px solid #666; vertical-align: top;">
                <table style="width: 100%; border-collapse: separate; border-spacing: 1px">
                    <tr>
                        <th
                            style="font-size: 14px; font-weight: 500; background-color: #203a5f; text-align: center; color: white; padding: 5px;">
                            Shipper/Exporter</th>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; padding: 5px;">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 30%; height: 5px !important">Company:</td>
                                    <td style="height: 5px !important">{{$billOfLading->shipperDetails->company ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td style="height: 5px !important">FullName:</td>
                                    <td style="height: 5px !important">{{$billOfLading->shipperDetails->name ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td style="height: 5px !important">Address:</td>
                                    <td style="height: 5px !important">{{$billOfLading->shipperDetails->address ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td style="height: 5px !important">City:</td>
                                    <td style="height: 5px !important">{{$billOfLading->shipperDetails->city ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td style="height: 5px !important">State:</td>
                                    <td style="height: 5px !important">{{$billOfLading->shipperDetails->state ?? ''}}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th
                            style="font-size: 14px; font-weight: 500; background-color: #203a5f; color: white; padding: 5px; text-align: center;">
                            Consignee
                        </th>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #ccc; padding: 5px;">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 30%; height: 5px !important">Company:</td>
                                    <td style="height: 5px !important">{{$billOfLading->consigneeDetails->company ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td style="height: 5px !important">FullName:</td>
                                    <td style="height: 5px !important">{{$billOfLading->consigneeDetails->name ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td style="height: 5px !important">Address:</td>
                                    <td style="height: 5px !important">{{$billOfLading->consigneeDetails->address ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td style="height: 5px !important">City:</td>
                                    <td style="height: 5px !important">{{$billOfLading->consigneeDetails->city ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td style="height: 5px !important">State:</td>
                                    <td style="height: 5px !important">{{$billOfLading->consigneeDetails->state ?? ''}}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th
                            style="font-size: 14px; font-weight: 500; background-color: #203a5f; color: white; padding: 5px; text-align: center;">
                            NotifyParty</th>
                    </tr>
                    <tr>
                        <td style="height: 5px !important; border:1px solid black;">
                            {{$billOfLading->notify_party ?? ''}}
                        </td>
                    </tr>
                    <tr>
                        <th
                            style="font-size: 14px; font-weight: 500; background-color: #203a5f; color: white; padding: 5px; text-align: center;">
                            Paier</th>
                    </tr>
                    <tr>
                        <td style="height: 5px !important; border:1px solid black;">
                            {{$billOfLading->paier ?? ''}}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0;">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 50%; border: 1px solid #666; vertical-align: top;">
                                        <table style="width: 100%;">
                                            <tr>
                                                <th
                                                    style="font-size: 14px; font-weight: 500; background-color: #203a5f; color: white; text-align: center; padding: 5px;">
                                                    Vessel - Voyage NO.</th>
                                            </tr>
                                            <tr>
                                                <td style="height: 5px !important; border:1px solid black;">
                                                    {{$billOfLading->notify_party ?? ''}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th
                                                    style="font-size: 14px; font-weight: 500; background-color: #203a5f; color: white; text-align: center; padding: 5px;">
                                                    Port Of Dischard</th>
                                            </tr>
                                            <tr>
                                                <td style="height: 5px !important; border:1px solid black;">
                                                    {{$billOfLading->notify_party ?? ''}}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="width: 50%; border: 1px solid #666; vertical-align: top;">
                                        <table style="width: 100%;">
                                            <tr>
                                                <th
                                                    style="font-size: 14px; font-weight: 500; background-color: #203a5f; color: white; text-align: center; padding: 5px;">
                                                    Port Of Loading</th>
                                            </tr>
                                            <tr>
                                                <td style="height: 5px !important; border:1px solid black;">
                                                    {{$billOfLading->notify_party ?? ''}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th
                                                    style="font-size: 14px; font-weight: 500; background-color: #203a5f; color: white; text-align: center; padding: 5px;">
                                                    Place Of Delivery</th>
                                            </tr>
                                            <tr>
                                                <td style="height: 5px !important; border:1px solid black;">
                                                    {{$billOfLading->notify_party ?? ''}}
                                                </td>
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
                            style="font-size: 14px; font-weight: 500; background-color: #203a5f; color: white; padding: 5px; text-align: center;">
                            Document No
                        </th>
                    </tr>
                    <tr>
                        <td style="height:39px !important; border: 1px solid black">
                            {{$billOfLading->document_no ?? ''}}
                        </td>
                    </tr>
                    <tr>
                        <th
                            style="font-size: 14px; font-weight: 500; background-color: #203a5f; color: white; padding: 5px; text-align: center;">
                            Expert
                            Referent</th>
                    </tr>
                    <tr>
                        <td style="height:39px !important; border: 1px solid black">
                            {{$billOfLading->expert_referent ?? ''}}
                        </td>
                    </tr>
                    <tr>
                        <th
                            style="font-size: 14px; font-weight: 500; background-color: #203a5f; color: white; padding: 5px; text-align: center;">
                            Forwarding Agent-Reference</th>
                    </tr>
                    <tr>
                        <td style="height:39px !important; border: 1px solid black">
                            {{$billOfLading->forwarding_agent_reference ?? ''}}
                        </td>
                    </tr>
                    <tr>
                        <th
                            style="font-size: 14px; font-weight: 500; background-color: #203a5f; color: white; padding: 5px; text-align: center;">
                            Point and Country Of origin</th>
                    </tr>
                    <tr>
                        <td style="height:39px !important; border: 1px solid black">
                            {{$billOfLading->point_and_country_of_origin ?? ''}}
                        </td>
                    </tr>
                    <tr>
                        <th
                            style="font-size: 14px; font-weight: 500; background-color: #203a5f; color: white; padding: 5px; text-align: center;">
                            Domestic
                            Routing/Export Instruction</th>
                    </tr>
                    <td style="height: 5px !important; border:1px solid black;">
                        {{$billOfLading->domestic_routing_export_instruction ?? ''}}
                    </td>
                    <tr>
                        <th
                            style="font-size: 14px; font-weight: 500; background-color: #203a5f; color: white; padding: 5px; text-align: center;">
                            Delivery Agent
                        </th>
                    </tr>
                    <tr>
                        <td style="height: 0px !important;">{{$billOfLading->delivery_agent ?? ''}}</td>
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
                            style="font-size: 14px; font-weight: 500; background-color: #203a5f; color: white; text-align: center; border-bottom: 2px solid white; padding: 5px;">
                            Particulars Furnished by Shipper</th>
                    </tr>
                    <tr>
                        <th
                            style="font-size: 14px; font-weight: 500; background-color: #203a5f; color: white; padding: 5px; border-right: 2px solid white;">
                            Make and
                            Number</th>
                        <th
                            style="font-size: 14px; font-weight: 500; background-color: #203a5f; color: white; padding: 5px;">
                            No of
                            packages</th>
                        <th
                            style="font-size: 14px; font-weight: 500; background-color: #203a5f; color: white; padding: 5px; border-right: 2px solid white; border-left: 2px solid white;">
                            Description
                            of Packages And
                            Goods</th>
                        <th
                            style="font-size: 14px; font-weight: 500; background-color: #203a5f; color: white; padding: 5px;">
                            Gross Weight
                        </th>
                        <th
                            style="font-size: 14px; font-weight: 500; background-color: #203a5f; color: white; padding: 5px; border-left: 2px solid white;">
                            Measurement
                        </th>
                    </tr>
                    <tr>
                        <td style="border: 2px solid black; padding-left: 5px; height: 20px;">
                            {{$billOfLading->mark_and_no ?? 'NA'}}
                        </td>
                        <td style="border: 2px solid black; padding-left: 5px;">
                            {{$billOfLading->no_of_packages ?? 'NA'}}
                        </td>
                        <td style="border: 2px solid black; padding-left: 5px;">
                            {{$billOfLading->desc_of_packages ?? 'NA'}}
                        </td>
                        <td style="border: 2px solid black; padding-left: 5px;">
                            {{$billOfLading->gross_weight ?? 'NA'}}
                        </td>
                        <td style="border: 2px solid black; padding-left: 5px;">
                            {{$billOfLading->measurement ?? 'NA'}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td colspan="2" style="border-bottom: 3px solid black;">
                <table style="width: 100%;">
                    <tr style="border-bottom: 10px;">
                        <th colspan="2"
                            style="font-size: 14px; font-weight: 500; background-color: #203a5f; color: white; text-align: center; padding: 5px;">
                            Company</th>
                    </tr>
                    <tr>
                        <td style="width: 50%; vertical-align: top;">
                            <table style="width: 100%; margin-top: 2px;">
                                <tr>
                                    <th
                                        style="font-size: 14px; font-weight: 500; background-color: #203a5f; color: white; text-align: center; padding: 5px;">
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
                                        style="font-size: 14px; font-weight: 500; background-color: #203a5f; color: white; text-align: center; padding: 5px; border-left: 1px solid white;">
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
</body>

</html>