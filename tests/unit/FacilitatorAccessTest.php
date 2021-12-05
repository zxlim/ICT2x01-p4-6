<?php declare(strict_types=1);

require_once(__DIR__ . "/../../src/constants.php");
require_once(__FUNCTIONS_DIR__ . "db.php");
require_once(__FUNCTIONS_DIR__ . "security.php");
require_once(__MVC_MODELS_DIR__ . "FacilitatorAccess.php");


class FacilitatorAccessTest extends \Codeception\Test\Unit {
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before() {
        // Pass!
    }

    protected function _after() {
        // Pass!
    }

    /**
    * FacilitatorAccess unit tests. Execution is sequential, ordered from top to bottom.
    */
    public function testFacilitatorCanLoginWithValidPassword() {
        $facilitator = Facilitator::Load();
        $this->assertTrue(FacilitatorAccess::Login($facilitator, "P@ssw0rd"));
    }


    public function testFacilitatorCannotLoginWithInvalidPassword() {
        $facilitator = Facilitator::Load();
        $this->assertFalse(FacilitatorAccess::Login($facilitator, "impossible"));
    }
}
