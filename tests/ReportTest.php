<?php 
use Fcosrno\SendGridReport\Report;
class ReportTest extends PHPUnit_Framework_TestCase {

  public function testConstructionReport() {
    $report = new Report();
    $this->assertEquals(get_class($report), "Fcosrno\SendGridReport\Report");
  }
  public function testBounces() {
    $report = new Report();
    $report->bounces();
    $this->assertEquals("https://api.sendgrid.com/api/bounces.get.json",$report->getUrl());
  }
  public function testBlocks() {
    $report = new Report();
    $report->blocks();
    $this->assertEquals("https://api.sendgrid.com/api/blocks.get.json",$report->getUrl());
  }
  public function testInvalidEmails() {
    $report = new Report();
    $report->invalidemails();
    $this->assertEquals("https://api.sendgrid.com/api/invalidemails.get.json",$report->getUrl());
  }
  public function testSpamReports() {
    $report = new Report();
    $report->spamreports();
    $this->assertEquals("https://api.sendgrid.com/api/spamreports.get.json",$report->getUrl());
  }
  public function testUnsubscribes() {
    $report = new Report();
    $report->unsubscribes();
    $this->assertEquals("https://api.sendgrid.com/api/unsubscribes.get.json",$report->getUrl());
  }
  public function testParameterDate()
  {
    $report = new Report();
    $report->bounces()->date();
    $this->assertEquals(array('date'=>1),$report->toWebFormat());
  }
  public function testParameterDays()
  {
    $report = new Report();
    $report->bounces()->days(5);
    $this->assertEquals(array('days'=>5),$report->toWebFormat());
  }
  public function testParameterStartDate()
  {
    $report = new Report();
    $report->bounces()->startDate('2014-01-01');
    $this->assertEquals(array('start_date'=>'2014-01-01'),$report->toWebFormat());
  }
  public function testParameterEndDate()
  {
    $report = new Report();
    $report->bounces()->endDate('2014-12-31');
    $this->assertEquals(array('end_date'=>'2014-12-31'),$report->toWebFormat());
  }
  public function testParameterLimit()
  {
    $report = new Report();
    $report->bounces()->limit('11');
    $this->assertEquals(array('limit'=>'11'),$report->toWebFormat());
  }
  public function testParameterOffset()
  {
    $report = new Report();
    $report->bounces()->offset('500');
    $this->assertEquals(array('offset'=>'500'),$report->toWebFormat());
  }
  public function testParameterType()
  {
    $report = new Report();
    $report->bounces()->type('hard');
    $this->assertEquals(array('type'=>'hard'),$report->toWebFormat());
  }
  public function testParameterEmail()
  {
    $report = new Report();
    $report->bounces()->email('foo@bar.com');
    $this->assertEquals(array('email'=>'foo@bar.com'),$report->toWebFormat());
  }
  public function testParametersCombined() {
    $report = new Report();
    $report->bounces()->startDate('2014-01-01')->endDate('2014-12-31')->email('foo@bar.com')->limit();
    $this->assertEquals(array('email'=>'foo@bar.com','start_date' => '2014-01-01','end_date' => '2014-12-31','limit'=>1),$report->toWebFormat());
  }
  public function testDeleteAction()
  {
    $report = new Report();
    $report->blocks()->delete()->email('foo@bar.com');
    $this->assertEquals("https://api.sendgrid.com/api/blocks.delete.json",$report->getUrl());
  }
  public function testAddAction()
  {
    $report = new Report();
    $report->blocks()->add()->email('foo@bar.com');
    $this->assertEquals("https://api.sendgrid.com/api/blocks.add.json",$report->getUrl());
  }
  public function testCountAction()
  {
    $report = new Report();
    $report->blocks()->count()->email('foo@bar.com');
    $this->assertEquals("https://api.sendgrid.com/api/blocks.count.json",$report->getUrl());
  }
}
