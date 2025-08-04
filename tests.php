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
