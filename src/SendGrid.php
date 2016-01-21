<?php

/*
 * This file is part of the Fcosrno\SendGridReport package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fcosrno\SendGridReport;

/**
 * Formats report results and sends them to Web Api via Unirest.
 *
 * This is an extension of the official SendGrid lib's bootstrapper.
 * You can see that class here: https://github.com/sendgrid/sendgrid-php/blob/master/lib/SendGrid.php
 * 
 * @param  Report $report Instance of Report
 * @return array         Result sent by SendGrid
 */
class SendGrid extends \SendGrid{

  public function report(Report $report)
  {
    $form = $report->toWebFormat();
    $form['api_user'] = $this->api_user; 
    $form['api_key'] = $this->api_key; 

    $response = $this->postRequest($report->getUrl(), $form);

    return $response->body;
  }
}
