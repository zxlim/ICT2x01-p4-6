<?php declare(strict_types=1);

require_once(__DIR__ . "/../../src/constants.php");
require_once(__FUNCTIONS_DIR__ . "db.php");
require_once(__FUNCTIONS_DIR__ . "security.php");
require_once(__MVC_MODELS_DIR__ . "StudentManagement.php");


class StudentManagementTest extends \Codeception\Test\Unit {
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
    * StudentManagement unit tests. Execution is sequential, ordered from top to bottom.
    */
    public function testStudentOTPGeneration() {
        $student = Student::Load();

        $otp = StudentManagement::GenerateOTP($student);

        // OTP should be hashed in the entity.
        $this->assertNotEquals($student->getOneTimePassword(), $otp);
        $this->assertTrue(pw_verify($otp, $student->getOneTimePassword()));
    }


    public function testToggleIssueCommandStatus() {
        $student = Student::Load();
        $this->assertTrue($student->getIssueCommandStatus());

        $status = StudentManagement::ToggleIssueCommandStatus($student);
        $this->assertFalse($status);
        $this->assertEquals($student->getIssueCommandStatus(), $status);

        $status = StudentManagement::ToggleIssueCommandStatus($student);
        $this->assertTrue($status);
        $this->assertEquals($student->getIssueCommandStatus(), $status);
    }


    public function testToggleTutorialStatus() {
        $student = Student::Load();

        $status = StudentManagement::ToggleTutorialStatus($student);
        $this->assertEquals($student->getTutorialStatus(), $status);

        $status = StudentManagement::ToggleTutorialStatus($student);
        $this->assertEquals($student->getTutorialStatus(), $status);
    }
}
