<?php declare(strict_types=1);
/**
* mvc/models/StudentAccess.php
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
* StudentAccess Control Class.
* -----------------------------------------------------------------------
*/

require_once(__MVC_MODELS_DIR__ . "Student.php"); // @codeCoverageIgnore


class StudentAccess {
    public static function Login(Student $student, string $otp): bool {
        /**
        * Checks if a given plaintext One-Time Password (OTP) is valid to
        * authenticate as a Student.
        *
        * @param    Student    $student    The Student entity object.
        * @param    string     $otp        The plaintext OTP submitted.
        *
        * @return   bool       $res        Whether the OTP is correct.
        */
        if ($student->getOneTimePassword() !== "") {
            if (pw_verify($otp, $student->getOneTimePassword()) === TRUE) {
                $student->clearOneTimePassword();
                
                $db = db_get_conn();
                $stmt = $db->prepare("UPDATE config SET value = :val WHERE key = 'student_otp_code'");
                $stmt->bindValue(":val", (string)($student->getOneTimePassword()), SQLITE3_TEXT);
                $stmt->execute();
                $db->close();

                return TRUE;
            }
        }

        return FALSE;
    }
}
