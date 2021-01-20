<?php

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
]);

$I->click('Create');

$I->seeInDatabase('projects', [
    'name' => $projectName,
    'description' => $projectDescription,
]);

// see show view

$id = $I->grabFromDatabase('projects', 'id', [
    'name' => $projectName,
    'description' => $projectDescription,
]);

$I->seeCurrentUrlEquals('/projects/' . $id);

$I->see($projectName);
$I->see($projectDescription);

// edit the project

$I->click('Edit');

$I->seeCurrentUrlEquals('/projects/' . $id . '/edit');

$I->seeInField('name', $projectName);
$I->seeInField('description', $projectDescription);

$I->fillField('description', "");

$I->click('Update');

$I->seeCurrentUrlEquals('/projects/' . $id . '/edit');
$I->see('The description field is required.', 'li');

$newDescription = 'New Description';

$I->fillField('description', $newDescription);
$I->click('Update');

$I->seeCurrentUrlEquals('/projects/' . $id);

$I->see($newDescription);

$I->dontSeeInDatabase('projects', [
    'name' => $projectName,
    'description' => $projectDescription,
]);

$I->seeInDatabase('projects', [
    'name' => $projectName,
    'description' => $newDescription,
]);

// see project in index view

$I->amOnPage('/projects');

$I->see("$projectName", 'tr > th');
$I->see("$newDescription", 'tr > td');

$I->click('View');

$I->seeCurrentUrlEquals('/projects/' . $id);

// delete the project

$I->amOnPage('/projects');

$I->click('Delete');

$I->seeCurrentUrlEquals('/projects/' . $id . '/delete');

$I->see("Are you sure you want to delete project $projectName? All included files will be deleted too.", 'p');

$I->click('Yes');

$I->seeCurrentUrlEquals('/projects');

$I->dontSeeInDatabase('projects', [
    'name' => $projectName,
    'description' => $newDescription,
]);

