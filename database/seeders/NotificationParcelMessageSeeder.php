<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationParcelMessageSeeder extends Seeder
{
    public function run(): void
    {
        // Truncate table before seeding
        DB::table('notification_parcel_message')->truncate();

        $messages = [
            ['title' => 'Order Placed', 'message' => 'Order placed! Track your order now. Order ID: {order_id}.', 'type' => 'Common'],
            ['title' => 'Pending', 'message' => 'Your order is currently pending.', 'type' => 'Common'],
            ['title' => 'Driver Assigned', 'message' => 'Your order has been assigned to driver {driver_name}.', 'type' => 'Service'],
            ['title' => 'Order Assigned', 'message' => 'Assigned Order {order_id} — Pickup on {pickup_date} at {pickup_time}.', 'type' => 'Driver'],
            ['title' => 'Picked up', 'message' => 'Driver {driver_name} has picked up your order.', 'type' => 'Service'],
            ['title' => 'Arrived at warehouse', 'message' => 'Your order has arrived at warehouse {warehouse_name}.', 'type' => 'Service'],
            ['title' => 'In transit', 'message' => 'Your order is in transit.', 'type' => 'Common'],
            ['title' => 'Container Full load at warehouse', 'message' => 'Container {container_number} is fully loaded at warehouse.', 'type' => 'Service'],
            ['title' => 'Full discharge', 'message' => 'Container {container_number} has been fully discharged.', 'type' => 'Service'],
            ['title' => 'Arrived at final destination warehouse', 'message' => 'Container {container_number} has arrived at final destination warehouse.', 'type' => 'Service'],
            ['title' => 'Final destination pick up', 'message' => 'Ready for final destination pick up', 'type' => 'Order'],
            ['title' => 'Out for delivery', 'message' => 'Your order is out for delivery with driver {driver_name}.', 'type' => 'Order'],
            ['title' => 'Delivered', 'message' => 'Your order has been delivered by {driver_name}.', 'type' => 'Order'],
            ['title' => 'Re-delivery', 'message' => 'Your order is scheduled for re-delivery.', 'type' => 'Common'],
            ['title' => 'Order Cancelled', 'message' => 'Your order has been cancelled.', 'type' => 'Common'],
            ['title' => 'Ready to transfer', 'message' => 'Order is ready to be transferred.', 'type' => 'Common'],
            ['title' => 'Transfer to Hub', 'message' => 'Your order has been transferred to Hub.', 'type' => 'Common'],
            ['title' => 'Ready at warehouse', 'message' => 'Order is ready at warehouse {warehouse_name}.', 'type' => 'Service'],
            ['title' => 'Container Arrived at Hub', 'message' => 'Container {container_number} has arrived at the Hub.', 'type' => 'Service'],
            ['title' => 'Final destination Assigned', 'message' => 'Your order is assigned to final destination driver {driver_name}.', 'type' => 'Common'],
            ['title' => 'Ready for self pick up', 'message' => 'Your order is ready for self pick-up.', 'type' => 'Service'],
            ['title' => 'Re-assigned', 'message' => 'Your order has been reassigned to another driver.', 'type' => 'Common'],
            ['title' => 'Custom hold', 'message' => 'Your order is on hold by customs.', 'type' => 'Common'],
            ['title' => 'Container Gate in', 'message' => 'Container {container_number} has been gated in.', 'type' => 'Service'],
            ['title' => 'Load in Vessel', 'message' => 'Container {container_number} loaded into vessel.', 'type' => 'Service'],
            ['title' => 'Vessel Departure', 'message' => 'Vessel carrying container {container_number} has departed.', 'type' => 'Service'],
            ['title' => 'Vessel Arrived', 'message' => 'Vessel carrying container {container_number} has arrived.', 'type' => 'Service'],
            ['title' => 'Discharge from Vessel', 'message' => 'Container {container_number} discharged from vessel.', 'type' => 'Service'],
            ['title' => 'Container New', 'message' => 'New container {container_number} has been added.', 'type' => 'Service'],
            ['title' => 'Custom cleared', 'message' => 'Your order has been cleared by customs.', 'type' => 'Common'],
            ['title' => 'Order Assigned for Delivery', 'message' => 'Order {order_id} has been assigned for delivery.', 'type' => 'Driver'],
            ['title' => 'Container {container_id} is In Transit', 'message' => 'Container {container_id} has been marked as In Transit. Please track its movement and prepare for arrival.', 'type' => 'Warehouse Manager'],
            ['title' => 'Container {container_id} is on Customs Hold', 'message' => 'Container {container_id} has been held at customs. Further updates will be shared once clearance is processed.', 'type' => 'Warehouse Manager'],
            ['title' => 'Container {container_id} Released from Customs', 'message' => 'Container {container_id} has been successfully released from customs and is now cleared for further handling.', 'type' => 'Warehouse Manager'],
            ['title' => 'Invoice {invoice_id} Deleted by Manager', 'message' => 'In warehouse {warehouse_name}, Manager {manager_name} has deleted invoice {invoice_id}.', 'type' => 'Manager',],
            ['title' => 'Invoice {invoice_id} Restored by Manager', 'message' => 'In warehouse {warehouse_name}, Manager {manager_name} has restored invoice {invoice_id}.', 'type' => 'Manager',],
            ['title' => 'Invoice {invoice_id} Permanently Deleted by Manager', 'message' => 'In warehouse {warehouse_name}, Manager {manager_name} has permanently deleted invoice #{invoice_id}.', 'type' => 'Manager',],
            ['title' => 'Invoice {invoice_id} Deleted by Driver', 'message' => 'In warehouse {warehouse_name}, Driver {driver_name} has deleted invoice {invoice_id}.', 'type' => 'Driver',],
            ['title' => 'Invoice {invoice_id} Restored by Driver', 'message' => 'In warehouse {warehouse_name}, Driver {driver_name} has restored invoice {invoice_id}.', 'type' => 'Driver',],['title' => 'Invoice {invoice_id} Permanently Deleted by Driver','message' => 'In warehouse {warehouse_name}, Driver {driver_name} has permanently deleted invoice #{invoice_id}.','type' => 'Driver',],
            ['title' => 'Invoice {invoice_id} Permanently Deleted by Driver','message' => 'In warehouse {warehouse_name}, Driver {driver_name} has permanently deleted invoice #{invoice_id}.','type' => 'Driver',],

        ];

        foreach ($messages as $msg) {
            DB::table('notification_parcel_message')->insert([
                'title' => $msg['title'],
                'message' => $msg['message'],
                'type' => $msg['type'],
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
