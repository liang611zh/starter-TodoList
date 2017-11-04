<?php

require '../application/models/Task.php';

class TaskTest extends PHPUnit_Framework_TestCase
{
  private $testTask;

  public function setUp()
  {
    $this->testTask = new Task();
  }

  public function testTaskSuccess()
  {
    $taskSet = $this->testTask->setTask('abc 123');
    $sizeSet = $this->testTask->setSize(3);
    $prioritySet = $this->testTask->setPriority(3);
    $groupSet = $this->testTask->setGroup(3);

    $this->assertTrue($taskSet);
    $this->assertTrue($sizeSet);
    $this->assertTrue($groupSet);
    $this->assertTrue($prioritySet);
  }

  public function testTaskFailure()
  {
    $taskSet = $this->testTask->setTask('^*^*%');
    $sizeSet = $this->testTask->setSize(5);
    $prioritySet = $this->testTask->setPriority(5);
    $groupSet = $this->testTask->setGroup(6);

    $this->assertFalse($taskSet);
    $this->assertFalse($sizeSet);
    $this->assertFalse($groupSet);
    $this->assertFalse($prioritySet);
  }
}