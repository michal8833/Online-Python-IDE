<?php
$I = new AcceptanceTester($scenario ?? null);

$I->wantTo('have projects page');

$I->amOnPage('/projects');
$I->seeCurrentUrlEquals('/login');

$I->fillField('email', 'john.doe@gmail.com');
$I->fillField('password', 'secret');

$I->click('Login');

$I->seeCurrentUrlEquals('/projects');

$I->see('You haven\'t created any project yet.');
