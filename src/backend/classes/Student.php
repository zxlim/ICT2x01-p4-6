<?php declare(strict_types=1);
/**
* backend/classes/Facilitator.php
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
* Base PHP file to be included by all frontend resources.
* -----------------------------------------------------------------------
*/

if (defined("FRONTEND") === FALSE) {
    /**
    * Ghetto way to prevent direct access to "include" files.
    */
    http_response_code(404);
    die();
}

require_once(__ROOT__ . "backend/functions/db.php");
require_once(__ROOT__ . "backend/functions/security.php");


class Student {
    private $oneTimePassword;
    private $issueCommandStatus;
    private $tutorialStatus;

    function __construct() {
        $this->oneTimePassword = db_get_config_value("student_otp_code");
        $this->issueCommandStatus = db_get_config_value("student_issue_cmd");
        $this->tutorialStatus = db_get_config_value("student_tutorial");
    }

    function getOneTimePassword(): string {
        return $this->oneTimePassword;
    }

    function setOneTimePassword(string $oneTimePassword) {
        $this->oneTimePassword = pw_hash($oneTimePassword);
    }

    function getIssueCommandStatus(): bool {
        return $this->issueCommandStatus;
    }

    function setIssueCommandStatus(bool $issueCommandStatus) {
        $this->issueCommandStatus = $issueCommandStatus;
    }

    function getTutorialStatus(): bool {
        return $this->issueCommandStatus;
    }

    function setTutorialStatus(bool $tutorialStatus) {
        $this->tutorialStatus = $tutorialStatus;
    }

    function saveStudent() {
        $db = db_get_conn();
        $stmt_one = $db->prepare("UPDATE config SET value=:val WHERE key='student_otp_code'");
        $stmt_one->bindValue(":val", (string)($this->getOneTimePassword()), SQLITE3_TEXT);
        $stmt_two = $db->prepare("UPDATE config SET value=:val WHERE key='student_issue_cmd'");
        $stmt_two->bindValue(":val", (string)($this->getIssueCommandStatus()), SQLITE3_TEXT);
        $stmt_three = $db->prepare("UPDATE config SET value=:val WHERE key='student_tutorial'");
        $stmt_three->bindValue(":val", (string)($this->getTutorialStatus()), SQLITE3_TEXT);

        $stmts = array($stmt_one, $stmt_two, $stmt_three);

        foreach ($stmts as $stmt) {
            $res = $stmt->execute();
            if ($res === false) {
                $last_error_code = $db->lastErrorCode();
                $last_error_msg = $db->lastErrorMsg();
                $db->close();
                die("Failed to update Student data in database: (" . $last_error_code . ") " . $last_error_msg);
            }
        }

        $db->close();
    }

    function login(string $otp): bool {
        if ($this->getOneTimePassword() !== "") {
            if (pw_verify($otp, $this->oneTimePassword) === TRUE) {
                $this->oneTimePassword = "";
                $this->saveStudent();
                return TRUE;
            }
        }

        return FALSE;
    }

    function generateOTP(): string {
        $otp = generate_pin_code();
        $this->setOneTimePassword($otp);
        return $otp;
    }

    function toggleIssueCommandStatus() {
        if ($this->getIssueCommandStatus() === TRUE) {
            $this->setIssueCommandStatus(FALSE);
        } else {
            $this->setIssueCommandStatus(TRUE);
        }
    }
}
