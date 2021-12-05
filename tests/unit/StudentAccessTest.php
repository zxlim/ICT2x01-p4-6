<?php declare(strict_types=1);

require_once(__DIR__ . "/../../src/constants.php");
require_once(__FUNCTIONS_DIR__ . "db.php");
require_once(__FUNCTIONS_DIR__ . "security.php");
require_once(__MVC_MODELS_DIR__ . "StudentAccess.php");


class StudentAccessTest extends \Codeception\Test\Unit {
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
    * StudentAccess unit tests. Execution is sequential, ordered from top to bottom.
    */
    public function testStudentCannotLoginWithInvalidOTP() {
        $student = Student::Load();

        StudentManagement::GenerateOTP($student);
        $this->assertFalse(StudentAccess::Login($student, "impossible"));
        $this->assertNotEmpty($student->getOneTimePassword());
    }


    public function testStudentCanLoginWithValidOTP() {
        $student = Student::Load();

        $otp = StudentManagement::GenerateOTP($student);
        $this->assertTrue(StudentAccess::Login($student, $otp));
        $this->assertEmpty($student->getOneTimePassword());
    }
}
