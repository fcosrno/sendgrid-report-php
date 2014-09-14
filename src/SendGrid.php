<?php
namespace Fcosrno\SendGridReport;
/**
 * Extends the official SendGrid lib's bootstrapper.
 * 
 * https://github.com/sendgrid/sendgrid-php/blob/master/lib/SendGrid.php
 */
class SendGrid extends \SendGrid{

  /**
   * Formats report results and sends them to Web Api via Unirest
   * @param  Report $report Instance of Report
   * @return array         Result sent by SendGrid
   */
  public function report(Report $report)
  {
    $form = $report->toWebFormat();
    $form['api_user'] = $this->api_user; 
    $form['api_key'] = $this->api_key; 

    $response = \Unirest::post($report->getUrl(), array(), $form );

    return $response->body;
  }
}
