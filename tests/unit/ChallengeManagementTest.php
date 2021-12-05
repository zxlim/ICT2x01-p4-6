<?php declare(strict_types=1);

require_once(__DIR__ . "/../../src/constants.php");
require_once(__FUNCTIONS_DIR__ . "db.php");
require_once(__FUNCTIONS_DIR__ . "validation.php");
require_once(__MVC_MODELS_DIR__ . "ChallengeManagement.php");


class ChallengeManagementTest extends \Codeception\Test\Unit {
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $resourceDir = __DIR__ . "/../resources/";
    private $testChallenges = array(
        array("id" => 1, "name" => "Test #1", "mapFilePath" => UPLOAD_DIR . "1.png", "maxCommandBlocks" => 6, "prettyMax" => 6),
        array("id" => 2, "name" => "Test #2", "mapFilePath" => UPLOAD_DIR . "2.png", "maxCommandBlocks" => 0, "prettyMax" => "Unlimited"),
    );
    

    protected function _before() {
        // Pass!
    }

    protected function _after() {
        // Pass!
    }


    /**
    * ChallengeManagement unit tests. Execution is sequential, ordered from top to bottom.
    */
    public function testThereAreNoChallengesYet() {
        $res = ChallengeManagement::GetAllChallenges();
        $this->assertTrue(count($res) === 0);
    }


    public function testValidChallengeMaxCommandBlockValues() {
        $testValues = array(
            "0", 0, 6, "16", (string)(CHALLENGE_COMMANDBLOCK_MAX - 1)
        );

        foreach ($testValues as $t) {
            $this->assertTrue(ChallengeManagement::ValidateMaxCommandBlocks($t));
        }
    }


    public function testMaxCommandBlockMustBeAnInteger() {
        $testValues = array(
            "Nope", "two", "", "3.141", 12.34, NULL
        );

        foreach ($testValues as $t) {
            $this->assertFalse(ChallengeManagement::ValidateMaxCommandBlocks($t));
        }
    }


    public function testMaxCommandBlockCannotBeLessThanZero() {
        $testValues = array(
            "-1", -10, "-32768"
        );

        foreach ($testValues as $t) {
            $this->assertFalse(ChallengeManagement::ValidateMaxCommandBlocks($t));
        }
    }


    public function testMaxCommandBlockLimitConstantCheck() {
        // Value not less than CHALLENGE_COMMANDBLOCK_MAX constant.
        $testValues = array(
            (string)(CHALLENGE_COMMANDBLOCK_MAX), (string)(CHALLENGE_COMMANDBLOCK_MAX + 1)
        );

        foreach ($testValues as $t) {
            $this->assertFalse(ChallengeManagement::ValidateMaxCommandBlocks($t));
        }
    }


    public function testValidMapFile() {
        $testValues = array(
            array("name" => "valid.png", "path" => sprintf("%s%s", $this->resourceDir, "valid.png")),
            array("name" => "valid.jpg", "path" => sprintf("%s%s", $this->resourceDir, "valid.jpg")),
            array("name" => "valid.jpeg", "path" => sprintf("%s%s", $this->resourceDir, "valid.jpeg"))
        );

        foreach ($testValues as $t) {
            $this->assertTrue(ChallengeManagement::ValidateMap($t["name"], $t["path"]));
        }
    }


    public function testSpecifiedFileIsNotAnImageFileThusNotAValidMapFile() {
        $testValues = array(
            array("name" => "invalid.txt", "path" => sprintf("%s%s", $this->resourceDir, "invalid.txt")),
            array("name" => "txtWithPngExtension.png", "path" => sprintf("%s%s", $this->resourceDir, "txtWithPngExtension.png")),
            array("name" => "txtWithJpgExtension.jpg", "path" => sprintf("%s%s", $this->resourceDir, "txtWithJpgExtension.jpg"))
        );

        foreach ($testValues as $t) {
            $this->assertFalse(ChallengeManagement::ValidateMap($t["name"], $t["path"]));
        }
    }


    public function testSpecifiedFileHasWrongExtensionThusNotAValidMapFile() {
        $testValues = array(
            array("name" => "pngWithTxtExtension.txt", "path" => sprintf("%s%s", $this->resourceDir, "pngWithTxtExtension.txt")),
            array("name" => "jpgWithMdExtension.txt", "path" => sprintf("%s%s", $this->resourceDir, "jpgWithMdExtension.md"))
        );

        foreach ($testValues as $t) {
            $this->assertFalse(ChallengeManagement::ValidateMap($t["name"], $t["path"]));
        }
    }


    public function testCreateTwoNewChallenges() {
        $workingImage = $this->resourceDir . "valid.png";

        foreach ($this->testChallenges as $t) {
            copy($workingImage, sprintf("%s%s", PUBLIC_DIR, $t["mapFilePath"]));
            $this->assertEquals(ChallengeManagement::CreateChallenge($t["name"], $t["mapFilePath"], $t["maxCommandBlocks"]), $t["id"]);
        }
    }


    public function testThereAreNowTwoChallenges() {
        $challenges = ChallengeManagement::GetAllChallenges();
        $this->assertTrue(count($challenges) === 2);

        for ($i = 0; $i < 2; $i++) {
            $chal = $challenges[$i];
            $test = $this->testChallenges[$i];

            $this->assertEquals($chal->getID(), $test["id"]);
            $this->assertEquals($chal->getName(), $test["name"]);
            $this->assertEquals($chal->getMapFilePath(), $test["mapFilePath"]);
            $this->assertEquals($chal->getMaxCommandBlocks(), $test["maxCommandBlocks"]);
            $this->assertEquals($chal->getPrettyMaxCommandBlocks(), $test["prettyMax"]);
        }
    }


    public function testValidChallengeNames() {
        $testValues = array(
            "Valid", "123", "Challenge 1", "Test #3"
        );

        foreach ($testValues as $t) {
            $this->assertTrue(ChallengeManagement::ValidateName($t));
        }
    }


    public function testCannotUseNamesBelongingToExistingChallenges() {
        foreach ($this->testChallenges as $t) {
            $this->assertFalse(ChallengeManagement::ValidateName($t["name"]));
        }
    }


    public function testChallengeNameCannotBeEmpty() {
        $this->assertFalse(ChallengeManagement::ValidateName(""));
    }


    public function testLoadingNonExistentChallengeWillThrowException() {
        $this->expectException(BOTsterChallengeException::class);
        $this->expectExceptionMessage("No Challenge was found with with ID 99.");
        Challenge::Load(99);
    }


    public function testDeleteChallenges() {
        foreach ($this->testChallenges as $t) {
            $this->assertNull(ChallengeManagement::DeleteChallenge(Challenge::Load($t["id"])));
        }
    }


    public function testDeletingNonExistentChallengeWillThrowException() {
        $this->expectException(BOTsterChallengeException::class);
        $this->expectExceptionMessage("No Challenge was found with with ID 99.");
        ChallengeManagement::DeleteChallenge(Challenge::Load(99));
    }

    public function testThereShouldBeNoChallengesRemaining() {
        $res = ChallengeManagement::GetAllChallenges();
        $this->assertTrue(count($res) === 0);
    }
}
