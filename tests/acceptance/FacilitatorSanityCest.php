<?php declare(strict_types=1);


class FacilitatorSanityCest {
    /**
    * Most tests are based on System Tests proposed in M2.
    * They are ran to automatically verify portion of the code works and
    * are not meant to fully cover the whole application. Treat this as
    * a sort of sanity check.
    */

    private $facilitatorUser = "facilitator";
    private $facilitatorPass = "P@ssw0rd";


    public function _before(AcceptanceTester $I) {
        // Pass!
    }


    public function _after(AcceptanceTester $I) {
        $I->wait(2);
    }
    

    public function facilitatorCanLoginWithValidPassword(AcceptanceTester $I) {
        /* ST7 */
        $I->amOnPage('/login');
        $I->submitForm('.loginForm', ['user' => $this->facilitatorUser, 'password' => $this->facilitatorPass]);
        $I->wait(2);

        $I->seeCurrentUrlEquals('/');
        $I->seeInTitle('BOTster | Dashboard');
        $I->see('Facilitator Dashboard');
    }


    public function facilitatorCannotLoginWithInvalidPassword(AcceptanceTester $I) {
        /* ST8 */
        $I->amOnPage('/login');
        $I->dontSeeInSource('Invalid Password.');
        $I->submitForm('.loginForm', ['user' => $this->facilitatorUser, 'password' => 'invalid']);
        $I->wait(2);

        $I->seeCurrentUrlEquals('/login');
        $I->seeInTitle('BOTster | Login');
        $I->see('Welcome to BOTster!');
        $I->see('Login as');
        $I->seeElement('.loginForm');
        $I->seeInSource('Invalid Password.');
    }


    public function authenticatedFacilitatorCannotAccessLoginPage(AcceptanceTester $I) {
        $I->amOnPage('/login');
        $I->submitForm('.loginForm', ['user' => $this->facilitatorUser, 'password' => $this->facilitatorPass]);
        $I->wait(2);
        $I->seeCurrentUrlEquals('/');

        $I->amOnPage('/login');
        // Controller will redirect to Dashboard since Facilitator is authenticated.
        $I->seeCurrentUrlEquals('/');
        $I->seeInTitle('BOTster | Dashboard');
        $I->see('Facilitator Dashboard');
    }


    public function facilitatorCanLogout(AcceptanceTester $I) {
        $I->amOnPage('/login');
        $I->submitForm('.loginForm', ['user' => $this->facilitatorUser, 'password' => $this->facilitatorPass]);
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


    public function facilitatorCanGenerateStudentOTP(AcceptanceTester $I) {
        /* ST1 */
        $I->amOnPage('/login');
        $I->submitForm('.loginForm', ['user' => $this->facilitatorUser, 'password' => $this->facilitatorPass]);
        $I->wait(2);
        $I->seeCurrentUrlEquals('/');

        $I->click('#genOTP');
        $I->waitForElementVisible('#otpModal', 10);
        $I->seeElement('#otpModal');
        $I->seeElement('#generated_otp');
        $otp = $I->executeJS('return $("#generated_otp").text()');
        $I->comment('I see generated OTP is ' . $otp);
    }


    public function facilitatorCanSeeChallengse(AcceptanceTester $I) {
        /* ST9 */
        $I->amOnPage('/login');
        $I->submitForm('.loginForm', ['user' => $this->facilitatorUser, 'password' => $this->facilitatorPass]);
        $I->wait(2);
        $I->seeCurrentUrlEquals('/');

        $I->click('#facilitator-challenges-navlink');
        $I->seeCurrentUrlEquals('/challenges');
        $I->seeInTitle('BOTster | Challenge Management');
        $I->see('Challenge Management');
        $I->seeLink('', '/facilitator/challenges');
        $I->seeElement('#challengesTable');
    }


    public function facilitatorCanSeeAddChallengePage(AcceptanceTester $I) {
        /* ST1 */
        $I->amOnPage('/login');
        $I->submitForm('.loginForm', ['user' => $this->facilitatorUser, 'password' => $this->facilitatorPass]);
        $I->wait(2);
        $I->seeCurrentUrlEquals('/');
        $I->amOnPage('/challenges');
        $I->seeCurrentUrlEquals('/challenges');

        $I->click('#addChalBtn');
        $I->amOnPage('/facilitator/challenges');
        $I->seeCurrentUrlEquals('/facilitator/challenges');
        $I->seeInTitle('BOTster | Add Challenge');
        $I->seeElement('#addChalForm');
        $I->see('Add New Challenge');
    }
}
