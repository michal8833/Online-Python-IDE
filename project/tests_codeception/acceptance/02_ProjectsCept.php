<?php

use Illuminate\Support\Facades\Auth;

$I = new AcceptanceTester($scenario ?? null);

$I->wantTo('have projects page');

$I->amOnPage('/projects');
$I->seeCurrentUrlEquals('/login');

$I->fillField('email', 'john.doe@gmail.com');
$I->fillField('password', 'secret');

$I->click('login');

$I->seeCurrentUrlEquals('/projects');

$I->see('You haven\'t created any project yet.');

// create new project

$I->click('New project');

$I->seeCurrentUrlEquals('/projects/create');

$I->click('Create');

$I->seeCurrentUrlEquals('/projects/create');

$I->see('The name field is required.', 'li');
$I->see('The description field is required.', 'li');

$projectName = "Example project";
$projectDescription = "Example description.";

$I->fillField('name', $projectName);

$I->click('Create');
$I->seeCurrentUrlEquals('/projects/create');

$I->see('The description field is required.', 'li');

$I->seeInField('name', $projectName);
$I->fillField('description', $projectDescription);

$I->dontSeeInDatabase('projects', [
    'name' => $projectName,
    'description' => $projectDescription,
    'user_id' => Auth::id()
]);

$I->click('Create');

$I->seeInDatabase('projects', [
    'name' => $projectName,
    'description' => $projectDescription,
    'user_id' => Auth::id()
]);
