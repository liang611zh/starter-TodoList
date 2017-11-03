<?php


 class TaskListTest extends PHPUnit_Framework_TestCase
  {
    private $CI;
    public function setUp()
    {
      // Load CI instance normally
      $this->CI = &get_instance();
    }

    public function testMoreUncompletedTasks()
    {
      $undone = 0;
      $done = 0;
      foreach ($this->CI->tasks as $task)
      {
        if ($task->status != 2)
          $undone++;
        else 
          $done++;
      }
      
      $this->assertTrue($done < $undone);
    }
  }