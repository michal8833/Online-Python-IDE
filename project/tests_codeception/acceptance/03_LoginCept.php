<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo('login with existing user');

$I->amOnPage('/home');

$I->seeCurrentUrlEquals('/login');

$I->fillField('email', 'john.doe@gmail.com');
$I->fillField('password', 'secret');

$I->click('login');

$I->seeCurrentUrlEquals('/home');

$I->see('John Doe');
$I->see("You're logged in!");
