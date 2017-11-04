<?php

require '../application/models/Task.php';

if(!class_exists('PHPUnit_Framework_TestCase')) {
  class_alias('PHPUnit\Framework\TestCase','PHPUnit_Framework_TestCase');
}

class TaskTest extends PHPUnit_Framework_TestCase
{
  private $testTask;

  public function setUp()
  {
    $this->testTask = new Task();
  }
  //task test
  public function testTaskSuccess()
  {
    $taskSet = $this->testTask->setTask('abc 123');
    $this->assertTrue($taskSet);
  }

  public function testTaskFailure()
  {
    $taskSet = $this->testTask->setTask('^*^*%');

    $this->assertFalse($taskSet);
  }

  //size test
  public function testSizeSuccess(){
    $sizeSet = $this->testTask->setSize(3);
    $this->assertTrue($sizeSet);

  }

  public function testSizeFailure(){
    $sizeSet = $this->testTask->setSize(5);
    $this->assertFalse($sizeSet);
  }

  //group test
  public function testGroupSuccess(){
    $groupSet = $this->testTask->setGroup(3);
    $this->assertTrue($groupSet);

  }

  public function testGroupFailure(){
    $groupSet = $this->testTask->setGroup(6);
    $this->assertFalse($groupSet);
  }

  //priority test
  public function testPrioritySuccess(){
    $prioritySet = $this->testTask->setPriority(3);
    $this->assertTrue($prioritySet);
  }

  public function testPriorityFailure(){
    $prioritySet = $this->testTask->setPriority(5);
    $this->assertFalse($prioritySet);
  }
}