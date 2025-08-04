<?php
include('timeSlot.php');
include('BarcodeHelper.php');

use App\Helpers\SettingsHelper;
use App\Models\Country;
use App\Models\NotificationParcel;
use App\Models\NotificationParcelMessage;
use App\Models\User;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Illuminate\Support\Facades\Log;
use App\Models\DriverLog;
use Illuminate\Support\Facades\Http;

function isActive($urls, $class = 'active', $default = '')
{

    if (!is_array($urls)) {
        $urls = explode(',', $urls);
        if (count($urls) > 1) {
            foreach ((array) $urls as $url) {
                if (request()->is($url)) {
                    return $class;
                }
            }
        }
        if (request()->is($urls[0])) {
            return $class;
        }
    }
    foreach ((array) $urls as $url) {
        if (request()->is($url)) {
            return $class;
        }
    }
    return $default;
}

function activeStatusKey($statusName = 'Pending')
{

    $newStatusClass = [
        'pending'                => 'labelstatus',
        'pickup_assign'          => 'pickup_assign', //admin
        'pickup_reschedule'      => 'pickup_reschedule',
        'received_by_pickup_man' => 'received_by_pickup_man',
        'received_warehouse'     => 'received_warehouse',
        'received_by_warehouse'  => 'bg-set',
        'transfer_to_hub'        => 'transfer_to_hub',
        'received_by_hub'        => 'received_by_hub',
        'delivery_man_assign'    => 'delivery_man_assign',
        'assign_delivery_boy'    => 'labelstatuspi',
        'return_to_courier'      => 'return_to_courier',
        'delivered'              => 'delivered',
        'cancelled'              => 'cancelled',
        'created'                => 'created',
        'updated'                => 'updated',
        'deleted'                => 'Deleted',
        'archived'               => 'deleted',
        'rejected'               => 'rejected',
        'completed'              => 'completed',
        'on_hold'                => 'on_hold',
        'partial'                => 'partial',
        'unpaid'                 => 'labelstatus',
        'partialy_paid'          => 'labelstatusy',
        'paid'                   => 'labelstatusw',
    ];

    return $newStatusClass[strtolower($statusName)] ?? '';
    // Return the key if found, or 'pending' if not.
    return str_replace(' ', '_', strtolower($statusName));
}


function calculatePrice($value = 0, $Unit = 0, $Rate = 0)
{
    // value-based calculation
    return ceil($value / $Unit) * $Rate;
}

function setting()
{
    return new SettingsHelper();
}

function carbon()
{
    return new \Carbon\Carbon();
}

function sum(...$numbers)
{
    return array_sum($numbers);
}

function removePart(
    string $subject,
    string $needle,
    bool   $caseInsensitive = false,
    bool   $firstOnly       = false
): string {
    if ($needle === '') {
        // Nothing to remove; avoid an infinite loop.
        return $subject;
    }

    if ($firstOnly) {
        // Build a regex that escapes special chars in $needle.
        $pattern = '/' . preg_quote($needle, '/') . '/' . ($caseInsensitive ? 'i' : '');
        // Replace only the first hit.
        return preg_replace($pattern, '', $subject, 1);
    }

    // Remove ALL occurrences with the appropriate replace.
    return $caseInsensitive
        ? str_ireplace($needle, '', $subject)
        : str_replace($needle, '', $subject);
}

function getStepArray($input, $steps = [10, 20, 50, 100, 200, 500, 1000, 2000, 5000, 10000])
{
    $result = [];

    for ($i = 0; $i < count($steps); $i++) {
        array_push($result, $steps[$i]);
        if ($steps[$i] >= $input) break;
    }

    return $result;
}

function getPhoneLengthById($id)
{
    if (!$id) {
        return 10;
    }

    $country = Country::find($id);
    return $country ? $country->phone_length : 10;
}

if (!function_exists('sendFirebaseNotification')) {
    function sendFirebaseNotification($deviceToken, $title, $body, $user_id = null, $parcel_id = null, $type = null)
    {
        try {
            if (empty($deviceToken)) {
                return false; // Token nahi hai to kuch bhi na karo
            }

            $firebaseFileName = env('FIREBASE_CREDENTIALS_PATH');
            $firebasePath = base_path($firebaseFileName);
            $image = "https://afrocargo.senomicsecurity.in/public/assets/images/AfroCargoLogo.svg";

            if (!$firebasePath || !file_exists($firebasePath)) {
                throw new Exception('Firebase credentials file not found or FIREBASE_CREDENTIALS_PATH not set properly.');
            }

            $factory = (new Factory)->withServiceAccount($firebasePath);
            $messaging = $factory->createMessaging();

            $notification = Notification::create($title, $body, $image);

            $message = CloudMessage::new()
                ->withNotification($notification)
                ->withChangedTarget('token', $deviceToken);

            // Save notification in database
            $notificationParcel = new NotificationParcel();
            $notificationParcel->title = $title;
            $notificationParcel->message = $body;
            $notificationParcel->user_id = $user_id;
            $notificationParcel->parcel_id = $parcel_id;
            $notificationParcel->type = $type ?? 'Order';
            $notificationParcel->save();

            $user = User::find($user_id);
            if ($user) {
                $user->notification_read += 1;
                $user->save();
            }

            return $messaging->send($message);
        } catch (\Kreait\Firebase\Exception\Messaging\NotFound $e) {
            // Specific error jab token valid nahi hota
            \Log::warning('FCM Token Not Found: ' . $e->getMessage());
            return false;
        } catch (\Throwable $e) {
            // Baaki sab error yahan handle ho jaye
            \Log::error('Firebase Notification Error: ' . $e->getMessage());
            return false;
        }
    }
}


if (!function_exists('sendFirebaseNotificationSystem')) {
    function sendFirebaseNotificationSystem($deviceToken, $title, $body)
    {
        try {
            if (empty($deviceToken)) {
                return false; // Token nahi hai to kuch bhi mat karo
            }

            $firebaseFileName = env('FIREBASE_CREDENTIALS_PATH');
            $firebasePath = base_path($firebaseFileName);
            $image = "https://afrocargo.senomicsecurity.in/public/assets/images/AfroCargoLogo.svg";

            if (!$firebasePath || !file_exists($firebasePath)) {
                throw new Exception('Firebase credentials file not found or FIREBASE_CREDENTIALS_PATH not set properly.');
            }

            $factory = (new Factory)->withServiceAccount($firebasePath);
            $messaging = $factory->createMessaging();

            $notification = Notification::create($title, $body, $image);

            $message = CloudMessage::new()
                ->withNotification($notification)
                ->withChangedTarget('token', $deviceToken);

            return $messaging->send($message);
        } catch (\Kreait\Firebase\Exception\Messaging\NotFound $e) {
            \Log::warning('System FCM Token Not Found: ' . $e->getMessage());
            return false;
        } catch (\Throwable $e) {
            \Log::error('System Firebase Notification Error: ' . $e->getMessage());
            return false;
        }
    }
}

function numberFormat($value, $decimals = 2)
{
    // If not numeric, return "0.00" or equivalent based on decimal places
    if (!is_numeric($value)) {
        return number_format(0, $decimals > 0 ? $decimals : 2, '.', '');
    }

    // If 0 or float-like 0.0, return formatted 0.00
    if (floatval($value) == 0) {
        return number_format(0, $decimals > 0 ? $decimals : 2, '.', '');
    }

    // If decimals specified, format using number_format
    if ($decimals > 0) {
        return number_format((float)$value, $decimals, '.', '');
    }

    // Otherwise, return the number as-is
    return (string)(floatval($value) + 0);
}

if (! function_exists('storeDriverLog')) {
    /**
     * Store driver log with given HTML, user ID and type
     *
     * @param string $html
     * @param int $userId
     * @param string $type
     * @return DriverLog
     */
    function storeDriverLog(string $html, int $userId, string $type): DriverLog
    {

        $log = new DriverLog();
        $log->user_id = $userId;
        $log->type = $type;
        $log->metadata = json_encode(['html' => $html]);
        $log->save();

        return $log;
    }
}

if (!function_exists('sendWhataAppTemplate')) {
    function sendWhataAppTemplate($toPhone)
    {
        $response = Http::withToken(env('WHATSAPP_TOKEN'))
            ->post("https://graph.facebook.com/" . env('WHATSAPP_API_VERSION') . "/" . env('WHATSAPP_PHONE_ID') . "/messages", [
                "messaging_product" => "whatsapp",
                "to" => $toPhone,
                "type" => "template",
                "template" => [
                    "name" => "hello_world",
                    "language" => [
                        "code" => "en_US"
                    ]
                ]
            ]);

        return $response->json();
    }
}
