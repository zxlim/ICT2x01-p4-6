<?php declare(strict_types=1);
/**
* mvc/models/Student.php
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
* Student Entity Class.
* -----------------------------------------------------------------------
*/


class Student {
    private $oneTimePassword;
    private $issueCommandStatus;
    private $tutorialStatus;

    private function __construct(string $oneTimePassword, bool $issueCommandStatus, bool $tutorialStatus) {
        /**
        * Constructor for the Student entity. Called by Load() only.
        *
        * @param    string      $onetimePassword    Student One-Time Password.
        * @param    bool        $issueCommandStatus Student's ability to issue commands.
        * @param    bool        $tutorialStatus     Tutorial Completion Status.
        */
        $this->oneTimePassword = $oneTimePassword;
        $this->issueCommandStatus = $issueCommandStatus;
        $this->tutorialStatus = $tutorialStatus;
    }

    public static function Load(): Student {
        /**
        * Returns a new instance of Student.
        * This function mimics the factory design pattern.
        *
        * @return   Student     $student            The Student entity object.
        */
        $oneTimePassword = db_get_config_value("student_otp_code");
        $issueCommandStatus = db_get_config_value("student_issue_cmd");
        $tutorialStatus = db_get_config_value("student_tutorial");

        return new Student($oneTimePassword, $issueCommandStatus, $tutorialStatus);
    }

    /**
    * Accessors.
    */
    public function getOneTimePassword(): string {
        return $this->oneTimePassword;
    }

    public function setOneTimePassword(string $oneTimePassword) {
        $this->oneTimePassword = pw_hash($oneTimePassword);
    }

    public function clearOneTimePassword() {
        $this->oneTimePassword = "";
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
}
