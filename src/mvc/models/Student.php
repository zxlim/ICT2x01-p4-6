<?php declare(strict_types=1);
/**
* mvc/models/Facilitator.php
*
* @copyright    Copyright (c) P4-6 2021. For the
*               partial fulfillment of the module
*               ICT2101/2201 Introduction to
*               Software Engineering.
*
* @author       LIM ZHAO XIANG         (1802976@sit.singaporetech.edu.sg)
* @author       IRFAN BIN FAIRUZ NIAN  (2000937@sit.singaporetech.edu.sg)
* @author       JEROME LIEW HAN RONG   (2001546@sit.singaporetech.edu.sg)
* @author       LIM ZHENG JIE          (2000627@sit.singaporetech.edu.sg)
* @author       WHITNEY TAN WEN HUI    (2002738@sit.singaporetech.edu.sg)
*
* -----------------------------------------------------------------------
* Student Model.
* -----------------------------------------------------------------------
*/

require_once(__FUNCTIONS_DIR__ . "db.php");
require_once(__FUNCTIONS_DIR__ . "security.php");


/**
* Student Entity Class.
*/
class Student {
    private $oneTimePassword;
    private $issueCommandStatus;
    private $tutorialStatus;

    function __construct() {
        $this->oneTimePassword = db_get_config_value("student_otp_code");
        $this->issueCommandStatus = db_get_config_value("student_issue_cmd");
        $this->tutorialStatus = db_get_config_value("student_tutorial");
    }

    /**
    * Getters and Setters.
    */
    public function getOneTimePassword(): string {
        return $this->oneTimePassword;
    }

    public function setOneTimePassword(string $oneTimePassword) {
        $this->oneTimePassword = $oneTimePassword;
    }

    public function getIssueCommandStatus(): bool {
        return $this->issueCommandStatus;
    }

    public function setIssueCommandStatus(bool $issueCommandStatus) {
        $this->issueCommandStatus = $issueCommandStatus;
    }

    public function getTutorialStatus(): bool {
        return $this->tutorialStatus;
    }

    public function setTutorialStatus(bool $tutorialStatus) {
        $this->tutorialStatus = $tutorialStatus;
    }

    /**
    * Database CRUD operations.
    */
    public function dbUpdate() {
        $db = db_get_conn();

        $stmt_one = $db->prepare("UPDATE config SET value = :val WHERE key = 'student_otp_code'");
        $stmt_one->bindValue(":val", (string)($this->getOneTimePassword()), SQLITE3_TEXT);

        $stmt_two = $db->prepare("UPDATE config SET value = :val WHERE key = 'student_issue_cmd'");
        $stmt_two->bindValue(":val", (string)($this->getIssueCommandStatus()), SQLITE3_TEXT);

        $stmt_three = $db->prepare("UPDATE config SET value = :val WHERE key = 'student_tutorial'");
        $stmt_three->bindValue(":val", (string)($this->getTutorialStatus()), SQLITE3_TEXT);

        $stmts = array($stmt_one, $stmt_two, $stmt_three);

        foreach ($stmts as $stmt) {
            $res = $stmt->execute();
            if ($res === false) {
                $errorMessage = sprintf("Failed to update Student [%d] %s", $db->lastErrorCode(), $db->lastErrorMsg());
                $db->close();
                throw new DBException($errorMessage);
            }
        }

        $db->close();
    }
}

/**
* Control Classes.
*/
class StudentAccess {
    private $student;

    function __construct(Student $student) {
        $this->student = $student;
    }

    public function login(string $otp): bool {
        if ($this->student->getOneTimePassword() !== "") {
            if (pw_verify($otp, $this->student->getOneTimePassword()) === TRUE) {
                $this->student->setOneTimePassword("");
                $this->student->dbUpdate();
                return TRUE;
            }
        }

        return FALSE;
    }
}

class StudentManagement {
    private $student;

    function __construct(Student $student) {
        $this->student = $student;
    }

    public function generateOTP(): string {
        $otp = generate_pin_code();
        $this->student->setOneTimePassword(pw_hash($otp));
        $this->student->dbUpdate();
        return $otp;
    }

    public function toggleIssueCommandStatus() {
        if ($this->student->getIssueCommandStatus() === TRUE) {
            $this->student->setIssueCommandStatus(FALSE);
        } else {
            $this->student->setIssueCommandStatus(TRUE);
        }
        $this->student->dbUpdate();
    }
}
