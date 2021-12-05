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
        // There should not be any Challenges in the Database.
        $this->assertEquals(count(ChallengeManagement::GetAllChallenges()), 0);
    }


    public function testValidChallengeMaxCommandBlockValues() {
        $this->assertTrue(ChallengeManagement::ValidateMaxCommandBlocks("0"));
        $this->assertTrue(ChallengeManagement::ValidateMaxCommandBlocks(0));
        $this->assertTrue(ChallengeManagement::ValidateMaxCommandBlocks("6"));
        $this->assertTrue(ChallengeManagement::ValidateMaxCommandBlocks(6));
        $this->assertTrue(ChallengeManagement::ValidateMaxCommandBlocks("16"));
        $this->assertTrue(ChallengeManagement::ValidateMaxCommandBlocks(16));
        $this->assertTrue(ChallengeManagement::ValidateMaxCommandBlocks((string)(CHALLENGE_COMMANDBLOCK_MAX - 1)));
        $this->assertTrue(ChallengeManagement::ValidateMaxCommandBlocks((CHALLENGE_COMMANDBLOCK_MAX - 1)));
    }


    public function testMaxCommandBlockMustBeAnInteger() {
        $this->assertFalse(ChallengeManagement::ValidateMaxCommandBlocks("Nope"));
        $this->assertFalse(ChallengeManagement::ValidateMaxCommandBlocks("Six"));
        $this->assertFalse(ChallengeManagement::ValidateMaxCommandBlocks("six"));
        $this->assertFalse(ChallengeManagement::ValidateMaxCommandBlocks("zero"));
        $this->assertFalse(ChallengeManagement::ValidateMaxCommandBlocks(""));
        $this->assertFalse(ChallengeManagement::ValidateMaxCommandBlocks("3.141"));
        $this->assertFalse(ChallengeManagement::ValidateMaxCommandBlocks(12.34));
        $this->assertFalse(ChallengeManagement::ValidateMaxCommandBlocks(TRUE));
        $this->assertFalse(ChallengeManagement::ValidateMaxCommandBlocks(FALSE));
        $this->assertFalse(ChallengeManagement::ValidateMaxCommandBlocks(NULL));
    }


    public function testMaxCommandBlockCannotBeLessThanZero() {
        $this->assertFalse(ChallengeManagement::ValidateMaxCommandBlocks("-1"));
        $this->assertFalse(ChallengeManagement::ValidateMaxCommandBlocks(-1));
        $this->assertFalse(ChallengeManagement::ValidateMaxCommandBlocks("-10"));
        $this->assertFalse(ChallengeManagement::ValidateMaxCommandBlocks(-10));
        $this->assertFalse(ChallengeManagement::ValidateMaxCommandBlocks("-32768"));
        $this->assertFalse(ChallengeManagement::ValidateMaxCommandBlocks(-32768));
    }


    public function testMaxCommandBlockLimitConstantCheck() {
        // Value not less than CHALLENGE_COMMANDBLOCK_MAX constant.
        $this->assertFalse(ChallengeManagement::ValidateMaxCommandBlocks((string)(CHALLENGE_COMMANDBLOCK_MAX)));
        $this->assertFalse(ChallengeManagement::ValidateMaxCommandBlocks((CHALLENGE_COMMANDBLOCK_MAX)));
        $this->assertFalse(ChallengeManagement::ValidateMaxCommandBlocks((string)(CHALLENGE_COMMANDBLOCK_MAX + 1)));
        $this->assertFalse(ChallengeManagement::ValidateMaxCommandBlocks((CHALLENGE_COMMANDBLOCK_MAX + 1)));
        $this->assertFalse(ChallengeManagement::ValidateMaxCommandBlocks((string)(CHALLENGE_COMMANDBLOCK_MAX + 100)));
        $this->assertFalse(ChallengeManagement::ValidateMaxCommandBlocks((CHALLENGE_COMMANDBLOCK_MAX + 100)));
    }


    public function testValidMapFile() {
        $this->assertTrue(ChallengeManagement::ValidateMap("valid.png", sprintf("%s%s", $this->resourceDir, "valid.png")));
        $this->assertTrue(ChallengeManagement::ValidateMap("valid.jpg", sprintf("%s%s", $this->resourceDir, "valid.jpg")));
        $this->assertTrue(ChallengeManagement::ValidateMap("valid.jpeg", sprintf("%s%s", $this->resourceDir, "valid.jpeg")));
    }


    public function testSpecifiedFileIsNotAnImageFileThusNotAValidMapFile() {
        $this->assertFalse(ChallengeManagement::ValidateMap("invalid.txt", sprintf("%s%s", $this->resourceDir, "invalid.txt")));
        $this->assertFalse(ChallengeManagement::ValidateMap("txtWithPngExtension.png", sprintf("%s%s", $this->resourceDir, "txtWithPngExtension.png")));
        $this->assertFalse(ChallengeManagement::ValidateMap("txtWithJpgExtension.jpg", sprintf("%s%s", $this->resourceDir, "txtWithJpgExtension.jpg")));
        $this->assertFalse(ChallengeManagement::ValidateMap("txtWithJpegExtension.jpeg", sprintf("%s%s", $this->resourceDir, "txtWithJpegExtension.jpeg")));
    }


    public function testSpecifiedFileHasWrongExtensionThusNotAValidMapFile() {
        $this->assertFalse(ChallengeManagement::ValidateMap("pngWithTxtExtension.txt", sprintf("%s%s", $this->resourceDir, "pngWithTxtExtension.txt")));
        $this->assertFalse(ChallengeManagement::ValidateMap("jpgWithMdExtension.md", sprintf("%s%s", $this->resourceDir, "jpgWithMdExtension.md")));
        $this->assertFalse(ChallengeManagement::ValidateMap("jpegWithTxtExtension.txt", sprintf("%s%s", $this->resourceDir, "jpegWithTxtExtension.txt")));
    }


    public function testCreateTwoNewChallenges() {
        $workingImage = sprintf("%s%s", $this->resourceDir, "valid.png");

        $testChalOne = $this->testChallenges[0];
        copy($workingImage, sprintf("%s%s", PUBLIC_DIR, $testChalOne["mapFilePath"]));
        $this->assertEquals(ChallengeManagement::CreateChallenge($testChalOne["name"], $testChalOne["mapFilePath"], $testChalOne["maxCommandBlocks"]), $testChalOne["id"]);

        $testChalTwo = $this->testChallenges[1];
        copy($workingImage, sprintf("%s%s", PUBLIC_DIR, $testChalTwo["mapFilePath"]));
        $this->assertEquals(ChallengeManagement::CreateChallenge($testChalTwo["name"], $testChalTwo["mapFilePath"], $testChalTwo["maxCommandBlocks"]), $testChalTwo["id"]);
    }


    public function testThereAreNowTwoChallenges() {
        $challenges = ChallengeManagement::GetAllChallenges();
        $this->assertTrue(count($challenges) === 2);

        $chalOne = $challenges[0];
        $testChalOne = $this->testChallenges[0];
        $this->assertEquals($chalOne->getID(), $testChalOne["id"]);
        $this->assertEquals($chalOne->getName(), $testChalOne["name"]);
        $this->assertEquals($chalOne->getMapFilePath(), $testChalOne["mapFilePath"]);
        $this->assertEquals($chalOne->getMaxCommandBlocks(), $testChalOne["maxCommandBlocks"]);
        $this->assertEquals($chalOne->getPrettyMaxCommandBlocks(), $testChalOne["prettyMax"]);

        $chalTwo = $challenges[1];
        $testChalTwo = $this->testChallenges[1];
        $this->assertEquals($chalTwo->getID(), $testChalTwo["id"]);
        $this->assertEquals($chalTwo->getName(), $testChalTwo["name"]);
        $this->assertEquals($chalTwo->getMapFilePath(), $testChalTwo["mapFilePath"]);
        $this->assertEquals($chalTwo->getMaxCommandBlocks(), $testChalTwo["maxCommandBlocks"]);
        $this->assertEquals($chalTwo->getPrettyMaxCommandBlocks(), $testChalTwo["prettyMax"]);
    }


    public function testValidChallengeNames() {
        $this->assertTrue(ChallengeManagement::ValidateName("Valid"));
        $this->assertTrue(ChallengeManagement::ValidateName("123"));
        $this->assertTrue(ChallengeManagement::ValidateName("Challenge 1"));
        $this->assertTrue(ChallengeManagement::ValidateName("Test #3"));
    }


    public function testCannotUseNamesBelongingToExistingChallenges() {
        $this->assertFalse(ChallengeManagement::ValidateName($this->testChallenges[0]["name"]));
        $this->assertFalse(ChallengeManagement::ValidateName($this->testChallenges[1]["name"]));
    }


    public function testChallengeNameCannotBeEmpty() {
        $this->assertFalse(ChallengeManagement::ValidateName(""));
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
