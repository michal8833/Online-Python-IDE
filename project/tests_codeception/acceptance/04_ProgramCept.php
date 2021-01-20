<?php

$I = new AcceptanceTester($scenario ?? null);

$I->wantTo('have projects page');

$I->amOnPage('/projects');
$I->seeCurrentUrlEquals('/login');

$I->fillField('email', 'john.doe@gmail.com');
$I->fillField('password', 'secret');

$I->click('login');

// create new project

$I->click('New project');

$projectName = "Example project";
$projectDescription = "Example description.";

$I->fillField('name', $projectName);
$I->fillField('description', $projectDescription);

$I->click('Create');

// create new file

$I->click('New File');

$I->fillField('name', "Example file");

$I->click('Create');

$I->click('editFile');

$I->fillField('content', "print(\"Hello world!\")");

$I->click('Save');

$I->click('Close');

$I->click('Run Project');

$I->see("Hello world!");


