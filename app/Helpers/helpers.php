<?php
use App\Models\UserRole;
/**
 * @param string $type
 * @param string $message
 * @return array
 */
function prepare_notification_array($type = 'warning', $message = 'no message found')
{
    return [
        'type'    => $type,
        'message' => $message
    ];
}

if (!function_exists('format_date')) {
    /**
     * @param        $date
     * @param string $format
     * @return string
     */
    function format_date($date, $format = 'Y-m-d')
    {
        if ($date != null) {
            $time = \Carbon\Carbon::parse($date)->format('H:i:s');
            if ($time == '00:00:00' && $format == 'M d, Y h:i A') {
                return \Carbon\Carbon::parse($date)->format('M d, Y');
            }
            return \Carbon\Carbon::parse($date)->format($format);
        }
    }
}


/**
 * @return array
 */
function expYears()
{
    $expYearArray = array(0 => 0);
    for ($i = 1; $i <= 50; $i++) {
        array_push($expYearArray, $i);
    }

    return $expYearArray;
}

/**
 * @return array
 */
function expMonths()
{
    $expMonthArray = array(0 => 0);
    for ($i = 1; $i <= 11; $i++) {
        array_push($expMonthArray, $i);
    }

    return $expMonthArray;
}

/**
 * @return array
 */
function title()
{
    return array(
        'Mr.'   => 'Mr.',
        'Mrs.'  => 'Mrs.',
        'Ms.'   => 'Ms.',
        'Prof.' => 'Prof.',
        'Dr.'   => 'Dr.',
    );
}

/**
 * @return array
 */
function gender()
{
    return array(
        '1' => 'Male',
        '2' => 'Female'
    );
}


/**
 * @param $permissions
 * @return bool
 */
function checkPermission($permissions)
{
    $userAccess = getMyPermission(Auth::user()->role_id);
    foreach ($permissions as $key => $value) {
        if ($value == $userAccess) {
            return true;
        }
    }
    return false;
}


/**
 * @param $id
 * @return bool
 */
function getMyPermission($id)
{
    $userRole = UserRole::select('role_name')->where('id', $id)->first();
    if ($userRole) {
        return $userRole['role_name'];
    }
    return false;
}