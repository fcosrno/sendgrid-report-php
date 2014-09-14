<?php
// Autoload
require './../vendor/autoload.php';

// Define credentials file
$params_file = 'example_params.json';

// Validate credentials exist;
if (!file_exists($params_file)) {
    echo "Oops! The file $params_file does not exist. This script requires a `example_params.json` file that contains your SendGrid credentials. The json file is in `.gitignore`, so no worries about accidental commits there. For your convenience, an example of this json file is included in `doc/example_params_placeholder.json` so that you can simply copy/paste that file and rename it to `example_params.json`.";
    die();
}

// Fetch vars from example_params.json file (you must create this file as descriped in the README)
$params = json_decode(file_get_contents($params_file),true);

// Initialize the SendGridReport object
$sendgrid = new Fcosrno\SendGridReport\SendGrid($params['api_user'],$params['api_key']);

// Initialize the Report object
$report = new Fcosrno\SendGridReport\Report();

// Spam Reports
$report->spamreports();
$result = $sendgrid->report($report);
echo "<pre>";
echo print_r($result);
echo "</pre>";

// Blocks
$report->blocks();
$result = $sendgrid->report($report);
echo "<pre>";
echo print_r($result);
echo "</pre>";

// Bounces
$report->bounces();
$result = $sendgrid->report($report);
echo "<pre>";
echo print_r($result);
echo "</pre>";

// Bounces
$report->invalidemails();
$result = $sendgrid->report($report);
echo "<pre>";
echo print_r($result);
echo "</pre>";

// Unsubscribes
$report->unsubscribes();
$result = $sendgrid->report($report);
echo "<pre>";
echo print_r($result);
echo "</pre>";

?>