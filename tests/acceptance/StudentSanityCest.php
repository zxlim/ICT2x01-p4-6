<?php declare(strict_types=1);


class StudentSanityCest {
    /**
    * Most tests are based on System Tests proposed in M2.
    * They are ran to automatically verify portion of the code works and
    * are not meant to fully cover the whole application. Treat this as
    * a sort of sanity check.
    */

    private $otp;


    public function _before(AcceptanceTester $I) {
        $I->amOnPage('/login');
        $I->submitForm('.loginForm', ['user' => 'facilitator', 'password' => 'P@ssw0rd']);
        $I->seeCurrentUrlEquals('/');
        $I->click('#genOTP');
        $I->waitForElementVisible('#otpModal', 10);
        $this->otp = $I->executeJS('return $("#generated_otp").text()');
        $I->comment('Facilitator generated OTP is ' . $this->otp);
        $I->amOnPage('/logout');
        $I->wait(2);
    }


    public function _after(AcceptanceTester $I) {
        $I->wait(2);
    }


    public function studentCanLoginWithValidOTP(AcceptanceTester $I) {
        /* ST15 */
        // Precondition 2 and 3.
        $I->amOnPage('/login');
        $I->seeCurrentUrlEquals('/login');
        $I->seeInTitle('BOTster | Login');
        $I->see('Welcome to BOTster!');
        $I->see('Login as');
        $I->seeElement('.loginForm');

        $I->submitForm('.loginForm', ['user' => 'student', 'password' => $this->otp]);
        $I->wait(2);
        $I->seeCurrentUrlEquals('/');
        $I->seeInTitle('BOTster | Dashboard');
        $I->see('Dashboard');
        $I->seeLink('', '/challenges');
        $I->seeLink('', '/student/tutorial');
    }

    public function studentCannotLoginWithInvalidOTP(AcceptanceTester $I) {
        /* ST16 */
        // Precondition 2 and 3.
        $I->amOnPage('/login');
        $I->seeCurrentUrlEquals('/login');
        $I->seeInTitle('BOTster | Login');
        $I->see('Welcome to BOTster!');
        $I->see('Login as');
        $I->seeElement('.loginForm');

        $I->submitForm('.loginForm', ['user' => 'student', 'password' => 'invalid']);
        $I->wait(2);
        $I->seeCurrentUrlEquals('/login');
        $I->seeInTitle('BOTster | Login');
        $I->see('Welcome to BOTster!');
        $I->see('Login as');
        $I->seeElement('.loginForm');
        $I->seeInSource('Invalid One-Time Password.');
    }


    public function authenticatedStudentCannotAccessLoginPage(AcceptanceTester $I) {
        // Generate OTP as Facilitator first and login as Student.
        $I->submitForm('.loginForm', ['user' => 'student', 'password' => $this->otp]);
        $I->wait(2);
        $I->seeCurrentUrlEquals('/');

        $I->amOnPage('/login');
        // Controller will redirect to Dashboard since Student is authenticated.
        $I->seeCurrentUrlEquals('/');
        $I->seeInTitle('BOTster | Dashboard');
        $I->see('Dashboard');
    }


    public function studentCanLogout(AcceptanceTester $I) {
        // Generate OTP as Facilitator first and login as Student.
        $I->submitForm('.loginForm', ['user' => 'student', 'password' => $this->otp]);
        $I->wait(2);
        $I->seeCurrentUrlEquals('/');

        // Simulate actual logout action via Logout Modal.
        $I->click('#userDropdown');
        $I->click('#logoutTrigger');
        $I->waitForElementVisible('#logoutModal', 10);
        $I->seeElement('#logoutModal');
        $I->click('#logoutBtn');

        $I->seeCurrentUrlEquals('/login');
        $I->seeInTitle('BOTster | Login');
        $I->see('Welcome to BOTster!');
        $I->see('Login as');
        $I->seeElement('.loginForm');
    }


    public function studentCanSeeTutorial(AcceptanceTester $I) {
        /* ST17 */
        // Generate OTP as Facilitator first and login as Student (Simulate Precondition 1 and 2).
        $I->submitForm('.loginForm', ['user' => 'student', 'password' => $this->otp]);
        $I->wait(2);
        $I->seeCurrentUrlEquals('/');

        $I->click('#student-tutorial-navlink');
        $I->seeCurrentUrlEquals('/student/tutorial');
        $I->seeInTitle('BOTster | Tutorial');
        $I->see('Tutorial');
        $I->see('To Take Note Before Playing!');
    }


    public function studentCanSeeChallengeListing(AcceptanceTester $I) {
        /* ST19 */
        // Generate OTP as Facilitator first and login as Student (Simulate Precondition 1 and 2).
        $I->submitForm('.loginForm', ['user' => 'student', 'password' => $this->otp]);
        $I->wait(2);
        $I->seeCurrentUrlEquals('/');

        $I->click('#student-challenges-navlink');
        $I->seeCurrentUrlEquals('/challenges');
        $I->seeInTitle('BOTster | All Challenges');
        $I->see('All Challenges');
        $I->seeElement('#challengesTable');
    }
}
