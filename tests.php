<?php

/**
 * ⚠️ TEST CODE ONLY ⚠️
 * DO NOT USE THIS DATA — IT IS COMPLETELY FAKE AND FOR DEMONSTRATION PURPOSES ONLY.
 */

require_once 'vendor/autoload.php';

use Bacarin\Heimdall;

if (count($argv) > 1) {
    foreach ($argv as $arg) {
        function_exists('test_' . $arg) and call_user_func('test_' . $arg);
    }
} else {
    foreach (get_defined_functions()['user'] as $functions) {
        function_exists($functions) and call_user_func($functions);
    }
    echo "Tested  " . count(get_defined_functions()['user']) . " functions" . PHP_EOL;
}

function test_required_success()
{
    $data = ['name' => 'John Doe'];
    $rules = ['name' => 'required'];
    $return = Heimdall::validate($rules, $data);
    if ($return['valid']) {
        echo "Test Required Success ....................... \e[32mPASS\033[0m\033[0m" . PHP_EOL;
    } else {
        echo "Test Required Success ....................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}


function test_required_failed()
{
    $data = ['name' => ''];
    $rules = ['name' => 'required'];
    $return = Heimdall::validate($rules, $data);
    if (!$return['valid']) {
        echo "Test Required Fail ....................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Required Fail ....................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}


function test_email_success()
{
    $data = ['email' => 'johndoe@email.com'];
    $rules = ['email' => 'email'];
    $return = Heimdall::validate($rules, $data);

    if ($return['valid']) {
        echo "Test Email Success ....................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Email Success ....................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}


function test_email_failed()
{
    $data = ['name' => 'johndoe_not_email'];
    $rules = ['name' => 'email'];
    $return = Heimdall::validate($rules, $data);
    if (!$return['valid']) {
        echo "Test Email Fail ....................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Email Fail ....................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}


function test_boolean_success()
{
    $data = ['accept' => true];
    $rules = ['accept' => 'boolean'];
    $return = Heimdall::validate($rules, $data);
    if ($return['valid']) {
        echo "Test Boolean Success ....................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Boolean Success ....................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}


function test_boolean_failed()
{
    $data = ['accept' => 'accepted'];
    $rules = ['accept' => 'boolean'];
    $return = Heimdall::validate($rules, $data);
    if (!$return['valid']) {
        echo "Test Boolean Fail ....................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Boolean Fail ....................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_required_with_success()
{
    $data = [
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ];
    $rules = [
        'email' => 'required_with:name',
    ];
    $return = Heimdall::validate($rules, $data);
    if ($return['valid']) {
        echo "Test RequiredWith Success ....................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test RequiredWith Success ....................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_required_with_failed()
{
    $data = [
        'name' => 'John Doe',
        'email' => '',
    ];
    $rules = [
        'email' => 'required_with:name',
    ];
    $return = Heimdall::validate($rules, $data);
    if (!$return['valid']) {
        echo "Test RequiredWith Fail ....................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test RequiredWith Fail ....................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_required_if_success()
{
    $data = [
        'status' => 'active',
        'email' => 'user@example.com',
    ];
    $rules = [
        'email' => 'required_if:status,active',
    ];
    $return = Heimdall::validate($rules, $data);
    if ($return['valid']) {
        echo "Test RequiredIf Success ....................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test RequiredIf Success ....................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_required_if_failed()
{
    $data = [
        'status' => 'active',
        'email' => '',
    ];
    $rules = [
        'email' => 'required_if:status,active',
    ];
    $return = Heimdall::validate($rules, $data);
    if (!$return['valid']) {
        echo "Test RequiredIf Fail ....................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test RequiredIf Fail ....................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_required_if_in_success()
{
    $data = [
        'status' => 'active',
        'email' => 'user@example.com',
    ];
    $rules = [
        'email' => 'required_if_in:status,active,pending',
    ];
    $return = Heimdall::validate($rules, $data);
    if ($return['valid']) {
        echo "Test RequiredIfIn Success ....................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test RequiredIfIn Success ....................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_required_if_in_failed()
{
    $data = [
        'status' => 'active',
        'email' => '',
    ];
    $rules = [
        'email' => 'required_if_in:status,active,pending',
    ];
    $return = Heimdall::validate($rules, $data);
    if (!$return['valid']) {
        echo "Test RequiredIfIn Fail ....................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test RequiredIfIn Fail ....................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_prohibited_with_success()
{
    $data = [
        'document' => '',
        'type' => 'company',
    ];
    $rules = [
        'document' => 'prohibited_with:type',
    ];
    $return = Heimdall::validate($rules, $data);
    if ($return['valid']) {
        echo "Test ProhibitedWith Success ....................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test ProhibitedWith Success ....................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_prohibited_with_failed()
{
    $data = [
        'document' => '12345678900',
        'type' => 'company',
    ];
    $rules = [
        'document' => 'prohibited_with:type',
    ];
    $return = Heimdall::validate($rules, $data);
    if (!$return['valid']) {
        echo "Test ProhibitedWith Fail ....................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test ProhibitedWith Fail ....................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_in_success()
{
    $data = ['status' => 'active'];
    $rules = ['status' => 'in:active,inactive,pending'];
    $return = Heimdall::validate($rules, $data);
    if ($return['valid']) {
        echo "Test In Success ....................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test In Success ....................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_in_failed()
{
    $data = ['status' => 'deleted'];
    $rules = ['status' => 'in:active,inactive,pending'];
    $return = Heimdall::validate($rules, $data);
    if (!$return['valid']) {
        echo "Test In Fail ....................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test In Fail ....................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_integer_success()
{
    $data = ['age' => 25];
    $rules = ['age' => 'integer'];
    $return = Heimdall::validate($rules, $data);
    if ($return['valid']) {
        echo "Test Integer Success ....................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Integer Success ....................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_integer_failed()
{
    $data = ['age' => 'twenty'];
    $rules = ['age' => 'integer'];
    $return = Heimdall::validate($rules, $data);
    if (!$return['valid']) {
        echo "Test Integer Fail ....................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Integer Fail ....................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_min_success()
{
    $data = ['quantity' => 5];
    $rules = ['quantity' => 'min:3'];
    $return = Heimdall::validate($rules, $data);
    if ($return['valid']) {
        echo "Test Min Success ....................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Min Success ....................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_min_failed()
{
    $data = ['quantity' => 2];
    $rules = ['quantity' => 'min:3'];
    $return = Heimdall::validate($rules, $data);
    if (!$return['valid']) {
        echo "Test Min Fail ....................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Min Fail ....................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_max_success()
{
    $data = ['quantity' => 5];
    $rules = ['quantity' => 'max:10'];
    $return = Heimdall::validate($rules, $data);
    if ($return['valid']) {
        echo "Test Max Success ....................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Max Success ....................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_max_failed()
{
    $data = ['quantity' => 15];
    $rules = ['quantity' => 'max:10'];
    $return = Heimdall::validate($rules, $data);
    if (!$return['valid']) {
        echo "Test Max Fail ....................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Max Fail ....................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_string_success()
{
    $data = ['name' => 'Eduardo'];
    $rules = ['name' => 'string'];
    $return = Heimdall::validate($rules, $data);
    if ($return['valid']) {
        echo "Test String Success ....................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test String Success ....................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_string_failed()
{
    $data = ['name' => 12345];
    $rules = ['name' => 'string'];
    $return = Heimdall::validate($rules, $data);
    if (!$return['valid']) {
        echo "Test String Fail ....................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test String Fail ....................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_array_success()
{
    $data = ['tags' => ['php', 'laravel']];
    $rules = ['tags' => 'array'];
    $return = Heimdall::validate($rules, $data);
    if ($return['valid']) {
        echo "Test Array Success ....................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Array Success ....................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_array_failed()
{
    $data = ['tags' => 'php'];
    $rules = ['tags' => 'array'];
    $return = Heimdall::validate($rules, $data);
    if (!$return['valid']) {
        echo "Test Array Fail ....................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Array Fail ....................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_date_success()
{
    $data = ['birthdate' => '2023-05-20'];
    $rules = ['birthdate' => 'date'];
    $return = Heimdall::validate($rules, $data);
    if ($return['valid']) {
        echo "Test Date Success ....................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Date Success ....................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_date_with_format_success()
{
    $data = ['birthdate' => '20/05/2023'];
    $rules = ['birthdate' => 'date:d/m/Y'];
    $return = Heimdall::validate($rules, $data);
    if ($return['valid']) {
        echo "Test Date With Format Success ........... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Date With Format Success ........... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_date_failed()
{
    $data = ['birthdate' => 'not-a-date'];
    $rules = ['birthdate' => 'date'];
    $return = Heimdall::validate($rules, $data);
    if (!$return['valid']) {
        echo "Test Date Fail ......................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Date Fail ......................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_date_with_format_failed()
{
    $data = ['birthdate' => '2023/05/20'];
    $rules = ['birthdate' => 'date:d/m/Y'];
    $return = Heimdall::validate($rules, $data);
    if (!$return['valid']) {
        echo "Test Date With Format Fail .............. \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Date With Format Fail .............. \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_sometimes_success_not_sent()
{
    $data = [];
    $rules = ['nickname' => 'sometimes|string'];
    $return = Heimdall::validate($rules, $data);
    if ($return['valid']) {
        echo "Test Sometimes Not Sent .................. \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Sometimes Not Sent .................. \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_sometimes_success_sent_and_valid()
{
    $data = ['nickname' => 'Dudu'];
    $rules = ['nickname' => 'sometimes|string'];
    $return = Heimdall::validate($rules, $data);
    if ($return['valid']) {
        echo "Test Sometimes Valid Sent ................ \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Sometimes Valid Sent ................ \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_sometimes_fail_invalid_sent()
{
    $data = ['nickname' => 123];
    $rules = ['nickname' => 'sometimes|string'];
    $return = Heimdall::validate($rules, $data);
    if (!$return['valid']) {
        echo "Test Sometimes Invalid Sent .............. \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Sometimes Invalid Sent .............. \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_missing_field_without_sometimes_or_required()
{
    $data = [];
    $rules = ['nickname' => 'string'];
    $return = Heimdall::validate($rules, $data);
    if (!$return['valid']) {
        echo "Test Missing Field Without Sometimes Or Required ........... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Missing Field Without Sometimes Or Required ........... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_nullable_success_null()
{
    $data = ['middle_name' => null];
    $rules = ['middle_name' => 'nullable|string'];
    $return = Heimdall::validate($rules, $data);
    if ($return['valid']) {
        echo "Test Nullable Success (null) ................ \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Nullable Success (null) ................ \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_nullable_success_empty()
{
    $data = ['middle_name' => ''];
    $rules = ['middle_name' => 'nullable|string'];
    $return = Heimdall::validate($rules, $data);
    if ($return['valid']) {
        echo "Test Nullable Success (empty string) ......... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Nullable Success (empty string) ......... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_nullable_success_value()
{
    $data = ['middle_name' => 'Eduardo'];
    $rules = ['middle_name' => 'nullable|string'];
    $return = Heimdall::validate($rules, $data);
    if ($return['valid']) {
        echo "Test Nullable Success (valid string) ........ \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Nullable Success (valid string) ........ \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_nullable_fail_invalid()
{
    $data = ['middle_name' => ['array']];
    $rules = ['middle_name' => 'nullable|string'];
    $return = Heimdall::validate($rules, $data);
    if (!$return['valid']) {
        echo "Test Nullable Fail (invalid type) ............ \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Nullable Fail (invalid type) ............ \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_datetime_success()
{
    $data = ['created_at' => '2025-08-04 10:30:00'];
    $rules = ['created_at' => 'datetime'];
    $return = Heimdall::validate($rules, $data);
    if ($return['valid']) {
        echo "Test Datetime Success ....................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Datetime Success ....................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_datetime_success_format()
{
    $data = ['created_at' => '04/08/2025 10:30'];
    $rules = ['created_at' => 'datetime:d/m/Y H:i'];
    $return = Heimdall::validate($rules, $data);
    if ($return['valid']) {
        echo "Test Datetime Success with Format ........... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Datetime Success with Format ........... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_datetime_fail_invalid()
{
    $data = ['created_at' => 'not-a-datetime'];
    $rules = ['created_at' => 'datetime'];
    $return = Heimdall::validate($rules, $data);
    if (!$return['valid']) {
        echo "Test Datetime Fail ......................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Datetime Fail ......................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_datetime_fail_null()
{
    $data = ['created_at' => null];
    $rules = ['created_at' => 'datetime'];
    $return = Heimdall::validate($rules, $data);
    if (!$return['valid']) {
        echo "Test Datetime Fail Null ..................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Datetime Fail Null ..................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}
function test_before_success_today()
{
    $data = ['start_date' => date('Y-m-d', strtotime('-1 day'))];
    $rules = ['start_date' => 'before:today'];
    $return = Heimdall::validate($rules, $data);
    if ($return['valid']) {
        echo "Test Before Success Today .................. \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Before Success Today .................. \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_before_fail_today()
{
    $data = ['start_date' => date('Y-m-d', strtotime('+1 day'))];
    $rules = ['start_date' => 'before:today'];
    $return = Heimdall::validate($rules, $data);
    if (!$return['valid']) {
        echo "Test Before Fail Today ..................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Before Fail Today ..................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_before_success_yesterday()
{
    $data = ['start_date' => date('Y-m-d', strtotime('-2 days'))];
    $rules = ['start_date' => 'before:yesterday'];
    $return = Heimdall::validate($rules, $data);
    if ($return['valid']) {
        echo "Test Before Success Yesterday .............. \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Before Success Yesterday .............. \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_before_fail_yesterday()
{
    $data = ['start_date' => date('Y-m-d', strtotime('now'))];
    $rules = ['start_date' => 'before:yesterday'];
    $return = Heimdall::validate($rules, $data);
    if (!$return['valid']) {
        echo "Test Before Fail Yesterday .................. \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Before Fail Yesterday .................. \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_before_success_tomorrow()
{
    $data = ['start_date' => date('Y-m-d', strtotime('now'))];
    $rules = ['start_date' => 'before:tomorrow'];
    $return = Heimdall::validate($rules, $data);
    if ($return['valid']) {
        echo "Test Before Success Tomorrow ............... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Before Success Tomorrow ............... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_before_fail_tomorrow()
{
    $data = ['start_date' => date('Y-m-d', strtotime('+2 days'))];
    $rules = ['start_date' => 'before:tomorrow'];
    $return = Heimdall::validate($rules, $data);
    if (!$return['valid']) {
        echo "Test Before Fail Tomorrow ................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Before Fail Tomorrow ................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_before_success_fixed_date()
{
    $data = ['start_date' => '2025-07-01'];
    $rules = ['start_date' => 'before:2025-07-10'];
    $return = Heimdall::validate($rules, $data);
    if ($return['valid']) {
        echo "Test Before Success Fixed Date .............. \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Before Success Fixed Date .............. \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_before_fail_fixed_date()
{
    $data = ['start_date' => '2025-07-15'];
    $rules = ['start_date' => 'before:2025-07-10'];
    $return = Heimdall::validate($rules, $data);
    if (!$return['valid']) {
        echo "Test Before Fail Fixed Date .................. \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test Before Fail Fixed Date .................. \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_after_success_today()
{
    $data = ['end_date' => date('Y-m-d', strtotime('+1 day'))];
    $rules = ['end_date' => 'after:today'];
    $return = Heimdall::validate($rules, $data);
    if ($return['valid']) {
        echo "Test After Success Today ................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test After Success Today ................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_after_fail_today()
{
    $data = ['end_date' => date('Y-m-d', strtotime('-1 day'))];
    $rules = ['end_date' => 'after:today'];
    $return = Heimdall::validate($rules, $data);
    if (!$return['valid']) {
        echo "Test After Fail Today ...................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test After Fail Today ...................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_after_success_yesterday()
{
    $data = ['end_date' => date('Y-m-d', strtotime('now'))];
    $rules = ['end_date' => 'after:yesterday'];
    $return = Heimdall::validate($rules, $data);
    if ($return['valid']) {
        echo "Test After Success Yesterday ............... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test After Success Yesterday ............... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_after_fail_yesterday()
{
    $data = ['end_date' => date('Y-m-d', strtotime('-2 days'))];
    $rules = ['end_date' => 'after:yesterday'];
    $return = Heimdall::validate($rules, $data);
    if (!$return['valid']) {
        echo "Test After Fail Yesterday ................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test After Fail Yesterday ................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_after_success_tomorrow()
{
    $data = ['end_date' => date('Y-m-d', strtotime('+2 days'))];
    $rules = ['end_date' => 'after:tomorrow'];
    $return = Heimdall::validate($rules, $data);
    if ($return['valid']) {
        echo "Test After Success Tomorrow ................ \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test After Success Tomorrow ................ \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_after_fail_tomorrow()
{
    $data = ['end_date' => date('Y-m-d', strtotime('now'))];
    $rules = ['end_date' => 'after:tomorrow'];
    $return = Heimdall::validate($rules, $data);
    if (!$return['valid']) {
        echo "Test After Fail Tomorrow ................... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test After Fail Tomorrow ................... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_after_success_fixed_date()
{
    $data = ['end_date' => '2025-07-15'];
    $rules = ['end_date' => 'after:2025-07-10'];
    $return = Heimdall::validate($rules, $data);
    if ($return['valid']) {
        echo "Test After Success Fixed Date ............... \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test After Success Fixed Date ............... \e[31mFAIL\033[0m" . PHP_EOL;
    }
}

function test_after_fail_fixed_date()
{
    $data = ['end_date' => '2025-07-01'];
    $rules = ['end_date' => 'after:2025-07-10'];
    $return = Heimdall::validate($rules, $data);
    if (!$return['valid']) {
        echo "Test After Fail Fixed Date .................. \e[32mPASS\033[0m" . PHP_EOL;
    } else {
        echo "Test After Fail Fixed Date .................. \e[31mFAIL\033[0m" . PHP_EOL;
    }
}
