<?php declare(strict_types=1);
/**
* mvc/models/StudentManagement.php
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
* StudentManagement Control Class.
* -----------------------------------------------------------------------
*/

require_once(__MVC_MODELS_DIR__ . "Student.php"); // @codeCoverageIgnore


class StudentManagement {
    public static function GenerateOTP(Student $student): string {
        /**
        * Generates a One-Time Password for a given Student entity.
        *
        * @param    Student    $student    The Student entity object.
        *
        * @return   string     $otp        The generated OTP.
        */
        $otp = generate_pin_code();
        $student->setOneTimePassword($otp);

        $db = db_get_conn();
        $stmt = $db->prepare("UPDATE config SET value = :val WHERE key = 'student_otp_code'");
        $stmt->bindValue(":val", (string)($student->getOneTimePassword()), SQLITE3_TEXT);
        $stmt->execute();
        $db->close();

        return $otp;
    }

    public static function ToggleIssueCommandStatus(Student $student): bool {
        /**
        * Toggles the Issue Command Status of a given Student entity.
        *
        * @param    Student    $student    The Student entity object.
        *
        * @return   bool       $res        The new value of Student's Issue Command status.
        */
        if ($student->getIssueCommandStatus() === TRUE) {
            $student->setIssueCommandStatus(FALSE);
        } else {
            $student->setIssueCommandStatus(TRUE);
        }
        
        $db = db_get_conn();
        $stmt = $db->prepare("UPDATE config SET value = :val WHERE key = 'student_issue_cmd'");
        $stmt->bindValue(":val", (string)($student->getIssueCommandStatus()), SQLITE3_TEXT);
        $stmt->execute();
        $db->close();

        return $student->getIssueCommandStatus();
    }

    public static function ToggleTutorialStatus(Student $student): bool {
        /**
        * Toggles the Tutorial Status of a given Student entity.
        *
        * @param    Student    $student    The Student entity object.
        *
        * @return   bool       $res        The new value of Student's Tutorial status.
        */
        if ($student->getTutorialStatus() === TRUE) {
            $student->setTutorialStatus(FALSE);
        } else {
            $student->setTutorialStatus(TRUE);
        }

        $db = db_get_conn();
        $stmt = $db->prepare("UPDATE config SET value = :val WHERE key = 'student_tutorial'");
        $stmt->bindValue(":val", (string)($student->getTutorialStatus()), SQLITE3_TEXT);
        $stmt->execute();
        $db->close();

        return $student->getTutorialStatus();
    }
}
