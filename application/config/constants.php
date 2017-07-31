<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

// Database structure
define("__DB_NAME__", "Invoice Manager");
    define("__DB_CUSTOMERS__", "Customers");
        define("__DB_CUSTOMERS_CUSTOMERID__", "CustomerID");
        define("__DB_CUSTOMERS_NAME__", "Name");
        define("__DB_CUSTOMERS_COUNTRY__", "Country");
        define("__DB_CUSTOMERS_CITY__", "City");
        define("__DB_CUSTOMERS_POSTALCODE__", "PostalCode");
        define("__DB_CUSTOMERS_STREET__", "Street");
        define("__DB_CUSTOMERS_HOUSENUMBER__", "HouseNo");
        define("__DB_CUSTOMERS_APARTMENTNUMBER__", "ApartmentNo");
        define("__DB_CUSTOMERS_NIP__", "NIP");
        define("__DB_CUSTOMERS_OTHERS__", "CustomerOthers");
    
    define("__DB_INVOICES__", "Invoices");
        define("__DB_INVOICES_INVOICEID__", "InvoiceID");
        define("__DB_INVOICES_CUSTOMER__", "CustomerID");
        define("__DB_INVOICES_INVOICENUMBER__", "InvoiceNumber");
        define("__DB_INVOICES_DATE__", "Date");
        define("__DB_INVOICES_PAYMENTDEADLINE__", "PaymentDeadline");
        define("__DB_INVOICES_PAYMENTMETHOD__", "PaymentMethod");
        define("__DB_INVOICES_OTHERS__", "InvoiceOthers");
        define("__DB_INVOICES_NETVALUE__", "FullNetValue");
        define("__DB_INVOICES_VATVALUE__", "FullVatValue");
        define("__DB_INVOICES_GROSSVALUE__", "FullGrossValue");
        define("__DB_INVOICES_CURRENCY__", "InvoiceCurrency");
        define("__DB_INVOICES_LANGUAGE__", "InvoiceLanguage");
        
    define("__DB_TRANSACTIONS__", "Transactions");
        define("__DB_TRANSACTIONS_TRANSACTIONID__", "TransactionID");
        define("__DB_TRANSACTIONS_INVOICE__", "InvoiceID");
        define("__DB_TRANSACTIONS_NAME__", "Name");
        define("__DB_TRANSACTIONS_MEASUREUNIT__", "MeasureUnit");
        define("__DB_TRANSACTIONS_COUNT__", "Count");
        define("__DB_TRANSACTIONS_NETUNITPRICE__", "NetUnitPrice");
        define("__DB_TRANSACTIONS_NETVALUE__", "NetValue");
        define("__DB_TRANSACTIONS_VATVALUE__", "VatValue");
        define("__DB_TRANSACTIONS_GROSSVALUE__", "GrossValue");

    define("__DB_CONFIG__", "Configurations");
        define("__DB_CONFIG_KEY__", "ConfigKey");
        define("__DB_CONFIG_USER__", "UserID");
        define("__DB_CONFIG_VALUE__", "Value");
        
        
        