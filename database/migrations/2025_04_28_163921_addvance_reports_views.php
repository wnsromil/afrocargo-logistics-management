<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE VIEW advanced_order_reports AS
SELECT
    order_with_invoices.*,
    users.name AS user_main_id,
    users.name AS user_name,
    users.email,
    users.role_id,
    users.role,
    addresses.address,
    addresses.mobile_number,
    addresses.alternative_mobile_number,
    addresses.address_type,
    addresses.full_name
FROM
    users
    LEFT JOIN addresses ON addresses.user_id = users.id
    LEFT JOIN (
        SELECT
            parcels.*,
            ship_customers.*,
            driver.*,
            parcel_status.status AS order_status,
            invoices.id as invoice_id,
            invoices.generated_by,
            invoices.issue_date,
            invoices.parcel_id,
            invoices.user_id,
            invoices.total_amount as invoice_total_amount,
            invoices.is_paid,
            parcels.customer_id as order_customer_id,
            vehicles.vehicle_number,
            vehicles.vehicle_model,
            vehicles.vehicle_type
        FROM
            parcels
            JOIN parcel_status ON parcel_status.id = parcels.status
            LEFT JOIN invoices ON invoices.parcel_id = parcels.id
            LEFT JOIN vehicles ON parcels.container_id = vehicles.id
            LEFT JOIN (
                SELECT
                    users.id as driverId,
                    users.name AS driver_name,
                    users.email as driver_email,
                    users.role_id as driver_role_id,
                    users.role as driver_role,
                    addresses.address as driver_address,
                    addresses.mobile_number as driver_mobile_number,
                    addresses.alternative_mobile_number as driver_alternative_mobile_number,
                    addresses.address_type as driver_address_type,
                    addresses.full_name as driver_full_name
                FROM
                    users
                    LEFT JOIN addresses ON addresses.user_id = users.id
            ) AS driver ON parcels.driver_id = driver.driverId
            LEFT JOIN (
                SELECT
                    users.id as ship_customerid,
                    users.name AS ship_user_name,
                    users.email as ship_email,
                    users.role_id as ship_role_id,
                    users.role as ship_role,
                    addresses.address as ship_address,
                    addresses.mobile_number as ship_mobile_number,
                    addresses.alternative_mobile_number as ship_alternative_mobile_number,
                    addresses.address_type as ship_address_type,
                    addresses.full_name as ship_full_name
                FROM
                    users
                    LEFT JOIN addresses ON addresses.user_id = users.id
            ) AS ship_customers ON parcels.ship_customer_id = ship_customers.ship_customerid
    ) AS order_with_invoices ON order_with_invoices.order_customer_id = users.id;
        ");
    }

    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS advanced_order_reports');
    }
};
