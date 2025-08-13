# HEIMDALL VALIDATOR #

Prevent unwanted data in your project with Heimdall Validator.

Heimdall Validator was inspired by Laravel and Symfony validators. It receives an associative array with data and another associative array with the desired validation rules.

This package does not throw exceptions or block any request. Instead, it returns a **Heimdall object** that lets you check validation results using `$validate->passes()` or `$validate->fails()`, and access detailed error messages with `$validate->errors()`. Examples are provided below.

## Index

- [Requirements](#requirements)
- [Installation](#installation)
- [How to Use](#how-to-use)
- [Available Methods](#available-methods)
- [Available Rules](#available-rules)

## Requirements

+ PHP 7.0+ (not tested on older versions)
+ No external dependencies. Built with pure PHP to avoid dependency issues and to be compatible with older PHP versions.

## Installation

You can install using Composer by running the command below:

**NOT AVAILABLE YET**
```shell
composer install bacarin/heimdall-validator
```

## How to Use

After installation, import the Bacarin\Heimdall class and call the static validate method, passing the validation rules and the data to validate, like this:

```php
use Bacarin\Heimdall;

function yourFunc(){
    $data = [
		'name' => 'John Doe',
		'age' => 18
	];
    $rules = [
		'name' => 'required|string|min:3',
		'age' => 'required|integer|max:80'
	];
    $validation = Heimdall::validate($rules, $data);
	if ($validation->passes()){
		... your code here
	}
}
```

## Available Methods

### **`$validate->passes()`**

Returns a boolean indicating whether the payload is valid. Returns true if valid, false otherwise.


### **`$validate->fails()`**

Returns a boolean indicating whether the payload is invalid. Returns true if invalid, false otherwi


### **`$validate->errors()`**

Returns an associative array containing validation error messages. If empty, the payload is valid.
Exampĺe:

```php
[
	"access_level" => [
		"The field access_level is prohibited when role is in [admin, manager]."
	]
]
```

## Available Rules

More rules will be added in future releases or upon request.

| Rule               | Description                                                                                  | Parameters           | Example                                               |
|--------------------|----------------------------------------------------------------------------------------------|----------------------|-------------------------------------------------------|
| `accepted_if`      | Must be 'yes', 'on', '1', 1, true, or 'true' if another field has a specific value           | field,value          | `accepted_if:status,active`                           |
| `accepted`         | Must be 'yes', 'on', '1', 1, true, or 'true'                                                 |                      | `accepted`                                            |
| `after_or_equal`   | Must be a date/datetime after or equal to a given date, or 'today', 'tomorrow', 'yesterday'  | date                 | `after_or_equal:today`, `after_or_equal:2025-10-10`   |
| `after`            | Must be a date/datetime after a given date, or 'today', 'tomorrow', 'yesterday'              | date                 | `after:yesterday`, `after:2025-09-09`                 |
| `array`            | Must be an array                                                                             |                      | `array`                                               |
| `before_or_equal`  | Must be a date/datetime before or equal to a given date, or 'today', 'tomorrow', 'yesterday' | date                 | `before_or_equal:today`, `before_or_equal:2025-10-10` |
| `before`           | Must be a date/datetime before a given date, or 'today', 'tomorrow', 'yesterday'             | date                 | `before:today`, `before:2025-10-10`                   |
| `boolean`          | Must be a boolean: true, false, 1, 0, 'true', or 'false'                                     |                      | `boolean`                                             |
| `date`             | Must be a valid date. Can also validate a specific format                                    | ?format              | `date`, `date:Y-m-d`                                  |
| `datetime`         | Must be a valid datetime. Can also validate a specific format                                | ?format              | `datetime`, `datetime:d/m/Y H:i`                      |
| `declined_if`      | Must be 'no', 'off', '0', 0, false, or 'false' if another field has a specific value         | field,value          | `declined_if:status,inactive`                         |
| `declined`         | Must be 'no', 'off', '0', 0, false, or 'false'                                               |                      | `declined`                                            |
| `email`            | Must be a valid email address                                                                |                      | `email`                                               |
| `gte`              | Must be a number greater than or equal to a given value                                      | value                | `gte:18`                                              |
| `gt`               | Must be a number greater than a given value                                                  | value                | `gt:17`                                               |
| `in`               | Must be one of the specified values                                                          | value                | `in:paid,nonpaid,overdue,canceled`                    |
| `integer`          | Must be an integer                                                                           |                      | `integer`                                             |
| `lte`              | Must be a number less than or equal to a given value                                         | value                | `lte:80`                                              |
| `lt`               | Must be a number less than a given value                                                     | value                | `lt:81`                                               |
| `max`              | Maximum value for numbers or maximum length for strings                                      | value                | `max:100`                                             |
| `min`              | Minimum value for numbers or minimum length for strings                                      | value                | `min:3`                                               |
| `nullable`         | Field can be null                                                                            |                      | `nullable`                                            |
| `prohibited_with`  | Field is prohibited if another field is present                                              | field                | `prohibited_with:company_name`                        |
| `prohibited_if`    | Field is prohibited if another field has a specific value                                    | field,value          | `prohibited_if:role,user`                             |
| `prohibited_if_in` | Field is prohibited if another field has one of the specified values                         | field,value,value... | `prohibited_if_in:role,admin,manager`                 |
| `regex`            | Must match the given regular expression                                                      | value                | `regex:^[a-z0-9]+$`                                   |
| `required_if_in`   | Required if another field has one of the specified values                                    | field,value,value... | `required_if_in:status,active,pending`                |
| `required_if`      | Required if another field has a specific value                                               | field,value          | `required_if:status,active`                           |
| `required_with`    | Required if another field is present                                                         | field                | `required_with:name`                                  |
| `required`         | Field is required                                                                            |                      | `required`                                            |
| `sometimes`        | Field is validated only if it is present                                                     |                      | `sometimes`                                           |
| `string`           | Must be a string                                                                             |                      | `string`                                              |
| `uuid`             | Must be a valid UUID. Can specify the UUID version                                           | ?value               | `uuid`, `uuid:4`                                      |
|--------------------|----------------------------------------------------------------------------------------------|----------------------|-------------------------------------------------------|
