CREATE OR REPLACE VIEW advanced_order_reports AS
SELECT
    order_with_invoices.*,
    users.name AS user_main_id,
    users.username,
    users.name,
    users.last_name,
    users.email,
    users.role_id,
    users.role,
    addresses.address,
    addresses.mobile_number,
    addresses.alternative_mobile_number,
    addresses.address_type,
    addresses.full_name,
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


    -- 30/04/25 => done
    ALTER TABLE `invoices` CHANGE `parcel_id` `parcel_id` BIGINT(20) UNSIGNED NULL, CHANGE `user_id` `user_id` BIGINT(20) UNSIGNED NULL;

    ALTER TABLE `invoices` CHANGE `currentTime` `currentTime` VARCHAR(255) NULL DEFAULT NULL;

    ALTER TABLE `addresses` ADD `address_2` VARCHAR(255) NULL AFTER `address`;

    ALTER TABLE `addresses` CHANGE `address_2` `address_2` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;

    ALTER TABLE `invoices` ADD `invoce_type` VARCHAR(255) NULL DEFAULT 'supplies' AFTER `is_paid`;

    ALTER TABLE `invoices` ADD `status` VARCHAR(255) NULL AFTER `is_paid`;

    -- 12/05/25
    ALTER TABLE `addresses` CHANGE `country_id` `country_id` VARCHAR(200) NULL, 
    CHANGE `state_id` `state_id` VARCHAR(200) NULL, CHANGE `city_id` `city_id` VARCHAR(200) NULL;

    -- 23/05/25
    ALTER TABLE `individual_payments` CHANGE `payment_type` `payment_type` 
    VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT 'COD';

    -- 28/05/25
    ALTER TABLE `parcels` CHANGE `transport_type` `transport_type` ENUM('Ocean Cargo','Air Cargo','null') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'null';

    ALTER TABLE `invoices` ADD `service_fee` DECIMAL(10,2) NULL AFTER `total_amount`;

    ALTER TABLE `parcel_inventories` CHANGE `label_qty` `label_qty` TEXT NULL DEFAULT NULL;

    -- 07/05/25
    ALTER TABLE `parcel_inventories` ADD `volume` DECIMAL(10,2) NULL AFTER `inventorie_item_quantity`;
    -- 10/0725

    ALTER TABLE `addresses` ADD `name` VARCHAR(255) NULL AFTER `default_address`, ADD `last_name` VARCHAR(255) NULL AFTER `name`;

    ALTER TABLE `invoices` ADD `payment_type` VARCHAR(255) NULL DEFAULT 'Cash' AFTER `invoce_type`;

    -- 14 july 2025
    ALTER TABLE `addresses` CHANGE `pincode` `pincode` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
    ALTER TABLE `addresses` CHANGE `city_id` `city_id` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
    -- 11/07/25
    ALTER TABLE `addresses` CHANGE `pincode` `pincode` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;

ALTER TABLE `invoices` ADD `customer_id` INT NULL AFTER `deleted_at`, ADD `ship_customer_id` INT NULL AFTER `customer_id`;
 
 ALTER TABLE `individual_payments` ADD `warehouse_id` INT NULL AFTER `updated_at`, ADD `unique_id` VARCHAR(200) NULL AFTER `warehouse_id`;