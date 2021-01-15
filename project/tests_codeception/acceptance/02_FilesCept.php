<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo('create and edit file');

// login
$I->amOnPage('/projects/create');

$I->seeCurrentUrlEquals('/login');

$I->fillField('email', 'john.doe@gmail.com');
$I->fillField('password', 'secret');

$I->click('login');

$I->amOnPage('/projects/create');
$I->seeCurrentUrlEquals('/projects/create');

// create new project
$projectName = "Project name";
$projectDescription = "Example project description";

$I->fillField('name', $projectName);
$I->fillField('description', $projectDescription);

$I->click('Create');

$I->seeCurrentUrlEquals('/projects');

$projectId = $I->grabFromDatabase('projects','id', [
    'name' => $projectName,
    'description' => $projectDescription
]);

// test create files

$I->click('View');
$I->seeCurrentUrlEquals('/projects/'.$projectId);

$I->click('New File');
$I->seeCurrentUrlEquals('/projects/'.$projectId.'/files/create');

$I->see('Create file.');

$fileName = 'main.py';

$I->click('Create');
$I->see('The name field is required');

$I->seeCurrentUrlEquals('/projects/'.$projectId.'/files/create');

$I->fillField('name',$fileName);

$I->dontSeeInDatabase('files',[
   'name' => $fileName,
   'project_id' => $projectId
]);

$I->click('Create');

$I->SeeInDatabase('files',[
    'name' => $fileName,
    'project_id' => $projectId
]);




