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
    foreach (get_defined_functions()['user'] as $function) {
        if (strpos($function, 'test') === 0) {
            function_exists($function) and call_user_func($function);
        }
    }
    echo "Tested  " . count(get_defined_functions()['user']) . " functions" . PHP_EOL;
}

function printTestResult(string $name, bool $pass): void {
    $color = $pass ? "\e[32m" : "\e[31m";
    $label = $pass ? 'PASS' : 'FAIL';
    $reset = "\033[0m";

    $dot_count = 80 - strlen($name) - strlen($label);
    if ($dot_count < 0) $dot_count = 0;
    $dots = str_repeat('.', $dot_count);
    printf("%s %s %s%s%s\n", $name, $dots, $color, $label, $reset);
}

function test_required_success()
{
    $data = ['name' => 'John Doe'];
    $rules = ['name' => 'required'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Required Success', $return['valid']);
}

function test_required_failed()
{
    $data = ['name' => ''];
    $rules = ['name' => 'required'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Required Fail', !$return['valid']);
}

function test_email_success()
{
    $data = ['email' => 'johndoe@email.com'];
    $rules = ['email' => 'email'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Email Success', $return['valid']);
}

function test_email_failed()
{
    $data = ['name' => 'johndoe_not_email'];
    $rules = ['name' => 'email'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Email Fail', !$return['valid']);
}

function test_boolean_success()
{
    $data = ['accept' => true];
    $rules = ['accept' => 'boolean'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Boolean Success', $return['valid']);
}
function test_boolean_failed()
{
    $data = ['accept' => 'accepted'];
    $rules = ['accept' => 'boolean'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Boolean Fail', !$return['valid']);
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
    printTestResult('Test RequiredWith Success', $return['valid']);
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
    printTestResult('Test RequiredWith Fail', !$return['valid']);
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
    printTestResult('Test RequiredIf Success', $return['valid']);
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
    printTestResult('Test RequiredIf Fail', !$return['valid']);
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
    printTestResult('Test RequiredIfIn Success', $return['valid']);
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
    printTestResult('Test RequiredIfIn Fail', !$return['valid']);
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
    printTestResult('Test ProhibitedWith Success', $return['valid']);
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
    printTestResult('Test ProhibitedWith Fail', !$return['valid']);
}

function test_in_success()
{
    $data = ['status' => 'active'];
    $rules = ['status' => 'in:active,inactive,pending'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test In Success', $return['valid']);
}

function test_in_failed()
{
    $data = ['status' => 'deleted'];
    $rules = ['status' => 'in:active,inactive,pending'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test In Fail', !$return['valid']);
}

function test_integer_success()
{
    $data = ['age' => 25];
    $rules = ['age' => 'integer'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Integer Success', $return['valid']);
}

function test_integer_failed()
{
    $data = ['age' => 'twenty'];
    $rules = ['age' => 'integer'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Integer Fail', !$return['valid']);
}

function test_min_success()
{
    $data = ['quantity' => 5];
    $rules = ['quantity' => 'min:3'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Min Success', $return['valid']);
}

function test_min_failed()
{
    $data = ['quantity' => 2];
    $rules = ['quantity' => 'min:3'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Min Fail', !$return['valid']);
}

function test_max_success()
{
    $data = ['quantity' => 5];
    $rules = ['quantity' => 'max:10'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Max Success', $return['valid']);
}

function test_max_failed()
{
    $data = ['quantity' => 15];
    $rules = ['quantity' => 'max:10'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Max Fail', !$return['valid']);
}
function test_string_success()
{
    $data = ['name' => 'Eduardo'];
    $rules = ['name' => 'string'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test String Success', $return['valid']);
}

function test_string_failed()
{
    $data = ['name' => 12345];
    $rules = ['name' => 'string'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test String Fail', !$return['valid']);
}

function test_array_success()
{
    $data = ['tags' => ['php', 'laravel']];
    $rules = ['tags' => 'array'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Array Success', $return['valid']);
}

function test_array_failed()
{
    $data = ['tags' => 'php'];
    $rules = ['tags' => 'array'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Array Fail', !$return['valid']);
}

function test_date_success()
{
    $data = ['birthdate' => '2023-05-20'];
    $rules = ['birthdate' => 'date'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Date Success', $return['valid']);
}

function test_date_with_format_success()
{
    $data = ['birthdate' => '20/05/2023'];
    $rules = ['birthdate' => 'date:d/m/Y'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Date With Format Success', $return['valid']);
}

function test_date_failed()
{
    $data = ['birthdate' => 'not-a-date'];
    $rules = ['birthdate' => 'date'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Date Fail', !$return['valid']);
}

function test_date_with_format_failed()
{
    $data = ['birthdate' => '2023/05/20'];
    $rules = ['birthdate' => 'date:d/m/Y'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Date With Format Fail', !$return['valid']);
}

function test_sometimes_success_not_sent()
{
    $data = [];
    $rules = ['nickname' => 'sometimes|string'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Sometimes Not Sent', $return['valid']);
}

function test_sometimes_success_sent_and_valid()
{
    $data = ['nickname' => 'Dudu'];
    $rules = ['nickname' => 'sometimes|string'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Sometimes Valid Sent', $return['valid']);
}
function test_sometimes_fail_invalid_sent()
{
    $data = ['nickname' => 123];
    $rules = ['nickname' => 'sometimes|string'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Sometimes Invalid Sent', !$return['valid']);
}

function test_missing_field_without_sometimes_or_required()
{
    $data = [];
    $rules = ['nickname' => 'string'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Missing Field Without Sometimes Or Required', !$return['valid']);
}

function test_nullable_success_null()
{
    $data = ['middle_name' => null];
    $rules = ['middle_name' => 'nullable|string'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Nullable Success (null)', $return['valid']);
}

function test_nullable_success_empty()
{
    $data = ['middle_name' => ''];
    $rules = ['middle_name' => 'nullable|string'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Nullable Success (empty string)', $return['valid']);
}

function test_nullable_success_value()
{
    $data = ['middle_name' => 'Eduardo'];
    $rules = ['middle_name' => 'nullable|string'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Nullable Success (valid string)', $return['valid']);
}

function test_nullable_fail_invalid()
{
    $data = ['middle_name' => ['array']];
    $rules = ['middle_name' => 'nullable|string'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Nullable Fail (invalid type)', !$return['valid']);
}

function test_datetime_success()
{
    $data = ['created_at' => '2025-08-04 10:30:00'];
    $rules = ['created_at' => 'datetime'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Datetime Success', $return['valid']);
}

function test_datetime_success_format()
{
    $data = ['created_at' => '04/08/2025 10:30'];
    $rules = ['created_at' => 'datetime:d/m/Y H:i'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Datetime Success with Format', $return['valid']);
}

function test_datetime_fail_invalid()
{
    $data = ['created_at' => 'not-a-datetime'];
    $rules = ['created_at' => 'datetime'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Datetime Fail', !$return['valid']);
}

function test_datetime_fail_null()
{
    $data = ['created_at' => null];
    $rules = ['created_at' => 'datetime'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Datetime Fail Null', !$return['valid']);
}

function test_before_success_today()
{
    $data = ['start_date' => date('Y-m-d', strtotime('-1 day'))];
    $rules = ['start_date' => 'before:today'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Before Success Today', $return['valid']);
}

function test_before_fail_today()
{
    $data = ['start_date' => date('Y-m-d', strtotime('+1 day'))];
    $rules = ['start_date' => 'before:today'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Before Fail Today', !$return['valid']);
}

function test_before_success_yesterday()
{
    $data = ['start_date' => date('Y-m-d', strtotime('-2 days'))];
    $rules = ['start_date' => 'before:yesterday'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Before Success Yesterday', $return['valid']);
}

function test_before_fail_yesterday()
{
    $data = ['start_date' => date('Y-m-d', strtotime('now'))];
    $rules = ['start_date' => 'before:yesterday'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Before Fail Yesterday', !$return['valid']);
}

function test_before_success_tomorrow()
{
    $data = ['start_date' => date('Y-m-d', strtotime('now'))];
    $rules = ['start_date' => 'before:tomorrow'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Before Success Tomorrow', $return['valid']);
}

function test_before_fail_tomorrow()
{
    $data = ['start_date' => date('Y-m-d', strtotime('+2 days'))];
    $rules = ['start_date' => 'before:tomorrow'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Before Fail Tomorrow', !$return['valid']);
}

function test_before_success_fixed_date()
{
    $data = ['start_date' => '2025-07-01'];
    $rules = ['start_date' => 'before:2025-07-10'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Before Success Fixed Date', $return['valid']);
}

function test_before_fail_fixed_date()
{
    $data = ['start_date' => '2025-07-15'];
    $rules = ['start_date' => 'before:2025-07-10'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Before Fail Fixed Date', !$return['valid']);
}
function test_after_success_today()
{
    $data = ['end_date' => date('Y-m-d', strtotime('+1 day'))];
    $rules = ['end_date' => 'after:today'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test After Success Today', $return['valid']);
}

function test_after_fail_today()
{
    $data = ['end_date' => date('Y-m-d', strtotime('-1 day'))];
    $rules = ['end_date' => 'after:today'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test After Fail Today', !$return['valid']);
}

function test_after_success_yesterday()
{
    $data = ['end_date' => date('Y-m-d', strtotime('now'))];
    $rules = ['end_date' => 'after:yesterday'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test After Success Yesterday', $return['valid']);
}

function test_after_fail_yesterday()
{
    $data = ['end_date' => date('Y-m-d', strtotime('-2 days'))];
    $rules = ['end_date' => 'after:yesterday'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test After Fail Yesterday', !$return['valid']);
}

function test_after_success_tomorrow()
{
    $data = ['end_date' => date('Y-m-d', strtotime('+2 days'))];
    $rules = ['end_date' => 'after:tomorrow'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test After Success Tomorrow', $return['valid']);
}

function test_after_fail_tomorrow()
{
    $data = ['end_date' => date('Y-m-d', strtotime('now'))];
    $rules = ['end_date' => 'after:tomorrow'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test After Fail Tomorrow', !$return['valid']);
}

function test_after_success_fixed_date()
{
    $data = ['end_date' => '2025-07-15'];
    $rules = ['end_date' => 'after:2025-07-10'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test After Success Fixed Date', $return['valid']);
}

function test_after_fail_fixed_date()
{
    $data = ['end_date' => '2025-07-01'];
    $rules = ['end_date' => 'after:2025-07-10'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test After Fail Fixed Date', !$return['valid']);
}

function test_lte_success_fixed_value() {
    $data = ['amount' => 8];
    $rules = ['amount' => 'lte:10'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test LTE Success Fixed', $return['valid']);
}

function test_lte_fail_fixed_value() {
    $data = ['amount' => 12];
    $rules = ['amount' => 'lte:10'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test LTE Fail Fixed', !$return['valid']);
}

function test_lte_success_field() {
    $data = ['amount' => 8, 'max' => 10];
    $rules = ['amount' => 'lte:max'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test LTE Success Field', $return['valid']);
}

function test_lte_fail_field() {
    $data = ['amount' => 12, 'max' => 10];
    $rules = ['amount' => 'lte:max'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test LTE Fail Field', !$return['valid']);
}

function test_lt_success_field() {
    $data = ['value' => 5, 'max' => 10];
    $rules = ['value' => 'lt:max'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test LT Success Field', $return['valid']);
}

function test_lt_fail_field() {
    $data = ['value' => 15, 'max' => 10];
    $rules = ['value' => 'lt:max'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test LT Fail Field', !$return['valid']);
}

function test_lt_success_value() {
    $data = ['value' => 5];
    $rules = ['value' => 'lt:10'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test LT Success Value', $return['valid']);
}

function test_lt_fail_value() {
    $data = ['value' => 15];
    $rules = ['value' => 'lt:10'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test LT Fail Value', !$return['valid']);
}

function test_gte_success_field() {
    $data = ['value' => 10, 'min' => 10];
    $rules = ['value' => 'gte:min'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test GTE Success Field', $return['valid']);
}

function test_gte_fail_field() {
    $data = ['value' => 8, 'min' => 10];
    $rules = ['value' => 'gte:min'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test GTE Fail Field', !$return['valid']);
}

function test_gte_success_value() {
    $data = ['value' => 10];
    $rules = ['value' => 'gte:10'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test GTE Success Value', $return['valid']);
}

function test_gte_fail_value() {
    $data = ['value' => 5];
    $rules = ['value' => 'gte:10'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test GTE Fail Value', !$return['valid']);
}

function test_gt_success_field() {
    $data = ['value' => 11, 'min' => 10];
    $rules = ['value' => 'gt:min'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test GT Success Field', $return['valid']);
}

function test_gt_fail_field() {
    $data = ['value' => 10, 'min' => 10];
    $rules = ['value' => 'gt:min'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test GT Fail Field', !$return['valid']);
}

function test_gt_success_value() {
    $data = ['value' => 11];
    $rules = ['value' => 'gt:10'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test GT Success Value', $return['valid']);
}

function test_gt_fail_value() {
    $data = ['value' => 9];
    $rules = ['value' => 'gt:10'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test GT Fail Value', !$return['valid']);
}

function test_accepted_success()
{
    $values = ['yes', 'on', '1', 1, true, 'true'];
    foreach ($values as $val) {
        $data = ['field' => $val];
        $rules = ['field' => 'accepted'];
        $return = Heimdall::validate($rules, $data);
        printTestResult("Test Accepted Success with value '{$val}'", $return['valid']);
    }
}

function test_accepted_fail()
{
    $data = ['field' => 'no'];
    $rules = ['field' => 'accepted'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Accepted Fail with value \'no\'', !$return['valid']);
}

function test_accepted_if_success()
{
    $data = [
        'status' => 'active',
        'agreement' => 'yes',
    ];
    $rules = [
        'agreement' => 'accepted_if:status,active',
    ];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test AcceptedIf Success when status is active', $return['valid']);
}

function test_accepted_if_skip()
{
    $data = [
        'status' => 'inactive',
        'agreement' => 'no',
    ];
    $rules = [
        'agreement' => 'accepted_if:status,active',
    ];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test AcceptedIf Skip when status is inactive', $return['valid']);
}

function test_accepted_if_fail()
{
    $data = [
        'status' => 'active',
        'agreement' => 'no',
    ];
    $rules = [
        'agreement' => 'accepted_if:status,active',
    ];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test AcceptedIf Fail when status is active', !$return['valid']);
}


function test_declined_success()
{
    $values = ['no', 'off', 0, '0', false, 'false'];
    foreach ($values as $val) {
        $data = ['field' => $val];
        $rules = ['field' => 'declined'];
        $return = Heimdall::validate($rules, $data);
        printTestResult("Test Declined Success with value '{$val}'", $return['valid']);
    }
}

function test_declined_fail()
{
    $data = ['field' => 'yes'];
    $rules = ['field' => 'declined'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Declined Fail with value \'yes\'', !$return['valid']);
}

function test_declined_if_success()
{
    $data = [
        'status' => 'inactive',
        'agreement' => 'no',
    ];
    $rules = [
        'agreement' => 'declined_if:status,active',
    ];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test DeclinedIf Skip when status is inactive', $return['valid']);
}

function test_declined_if_fail()
{
    $data = [
        'status' => 'active',
        'agreement' => 'yes',
    ];
    $rules = [
        'agreement' => 'declined_if:status,active',
    ];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test DeclinedIf Fail when status is active', !$return['valid']);
}

function test_declined_if_success_when_declined()
{
    $data = [
        'status' => 'active',
        'agreement' => 'no',
    ];
    $rules = [
        'agreement' => 'declined_if:status,active',
    ];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test DeclinedIf Success when status is active and agreement declined', $return['valid']);
}


function test_regex_success()
{
    $data = ['username' => 'user123'];
    $rules = ['username' => 'regex:^[a-z0-9]+$'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Regex Success with valid username', $return['valid']);
}

function test_regex_fail()
{
    $data = ['username' => 'User_123'];
    $rules = ['username' => 'regex:^[a-z0-9]+$'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Regex Fail with invalid username', !$return['valid']);
}

function test_regex_with_delimiters_success()
{
    $data = ['username' => 'user123'];
    $rules = ['username' => 'regex:/^[a-z0-9]+$/i'];
    $return = Heimdall::validate($rules, $data);
    printTestResult('Test Regex with delimiters Success', $return['valid']);
}

function test_regex_invalid_pattern()
{
    $data = ['username' => 'user123'];
    $rules = ['username' => 'regex:/[a-z0-9+/'];
    $return = Heimdall::validate($rules, $data);
    $passed = isset($return['valid']) && $return['valid'] === false &&
              isset($return['errors']) && count($return['errors']) > 0;
    printTestResult('Test Regex Invalid Pattern', $passed);
}

function test_uuid_success()
{
    $validUUIDs = [
        'af883b30-77a7-11f0-802d-f5d643144657', // v1
        '6ba7b811-9dad-21d1-80b4-00c04fd430c8', // v2
        '6ba7b812-9dad-31d1-80b4-00c04fd430c8', // v3
        '4964d188-af92-4cd7-976f-ab40fae9feed', // v4
        '6ba7b815-9dad-51d1-80b4-00c04fd430c8', // v5
    ];

    foreach ($validUUIDs as $uuid) {
        $data = ['id' => $uuid];
        $rules = ['id' => 'uuid'];
        $return = Heimdall::validate($rules, $data);
        printTestResult("Test UUID Success with value {$uuid}", $return['valid']);
    }
}

function test_uuid_version4_success()
{
    $uuid = '6ba7b814-9dad-41d1-80b4-00c04fd430c8';
    $data = ['id' => $uuid];
    $rules = ['id' => 'uuid:4'];
    $return = Heimdall::validate($rules, $data);
    printTestResult("Test UUID v4 Success", $return['valid']);
}

function test_uuid_version4_fail()
{
    $uuid = '6ba7b812-9dad-31d1-80b4-00c04fd430c8';
    $data = ['id' => $uuid];
    $rules = ['id' => 'uuid:4'];
    $return = Heimdall::validate($rules, $data);
    printTestResult("Test UUID v4 Fail with v3 UUID", !$return['valid']);
}

function test_uuid_invalid()
{
    $uuid = 'not-a-uuid';
    $data = ['id' => $uuid];
    $rules = ['id' => 'uuid'];
    $return = Heimdall::validate($rules, $data);
    printTestResult("Test UUID Invalid", !$return['valid']);
}
