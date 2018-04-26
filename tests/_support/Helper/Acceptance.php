<?php
namespace Helper;

use Codeception\TestInterface;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Acceptance extends \Codeception\Module
{
    public function _before(TestInterface $test)
    {
        `php vendor/bin/phinx rollback -e testing -t 0`;
        `php vendor/bin/phinx migrate -e testing`;
    }

    public function _afterSuite($settings = array())
    {
        `php vendor/bin/phinx rollback -e testing -t 0`;
        `php vendor/bin/phinx migrate -e testing`;
    }
}
