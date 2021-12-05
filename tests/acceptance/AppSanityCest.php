<?php declare(strict_types=1);


class AppSanityCest {
    /**
    * Most tests are based on System Tests proposed in M2.
    * They are ran to automatically verify portion of the code works and
    * are not meant to fully cover the whole application. Treat this as
    * a sort of sanity check.
    */


    public function _before(AcceptanceTester $I) {
        // Pass!
    }


    public function showLoginPageOnAppStart(AcceptanceTester $I) {
        /* ST6 */
        $I->amOnPage('/');
        $I->seeCurrentUrlEquals('/login');
        $I->seeInTitle('BOTster | Login');
        $I->see('Welcome to BOTster!');
        $I->see('Login as');
        $I->seeElement('.loginForm');
    }
}
