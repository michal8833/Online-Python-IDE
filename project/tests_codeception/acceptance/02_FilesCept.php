<?php

use \Codeception\Util\Locator;

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

$I->amOnPage('/projects/'.$projectId);

// test create files

$I->click('New File');
$I->seeCurrentUrlEquals('/projects/'.$projectId.'/files/create');

$fileName = 'main.py';

$I->see('Create file.');

// cancel
$I->fillField('name',$fileName);

$I->click('Cancel');

$I->dontSeeInDatabase('files',[
    'name' => $fileName,
    'project_id' => $projectId
]);

$I->seeCurrentUrlEquals('/projects/'.$projectId);

// create
$I->click('New File');

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

$I->seeCurrentUrlEquals('/projects/'.$projectId);

$fileId = $I->grabFromDatabase('files', 'id', [
   'name' => $fileName
]);

// delete file
$I->click('Delete');

$I->seeCurrentUrlEquals('/projects/'.$projectId.'/files/'.$fileId.'/delete');

$I->see('Are you sure you want to delete file '.$fileName.' ?');

$I->SeeInDatabase('files',[
    'name' => $fileName,
    'project_id' => $projectId
]);

$I->click('No');

$I->SeeInDatabase('files',[
    'name' => $fileName,
    'project_id' => $projectId
]);

$I->seeCurrentUrlEquals('/projects/'.$projectId);

$I->click('Delete');

$I->SeeInDatabase('files',[
    'name' => $fileName,
    'project_id' => $projectId
]);

$I->click('Yes');

$I->dontSeeInDatabase('files',[
    'name' => $fileName,
    'project_id' => $projectId
]);

$I->seeCurrentUrlEquals('/projects/'.$projectId);

// upload files from computer

$I->click('Upload files');

$I->seeCurrentUrlEquals('/projects/'.$projectId.'/files/upload');
$I->see('Add files from your computer.');

$I->click('Upload');

$I->see('You have to add at least one file');
$I->seeCurrentUrlEquals('/projects/'.$projectId.'/files/upload');

$fileName = 'HelloWorld.py';

$file = fopen('tests_codeception/_data/'.$fileName, 'r');
$fileContent = base64_encode(fread($file,filesize('tests_codeception/_data/'.$fileName)));

$I->click('Cancel');

$I->seeCurrentUrlEquals('/projects/'.$projectId);

$I->dontSeeInDatabase('files',[
    'project_id' => $projectId,
    'name' => $fileName,
    'content' => $fileContent
]);

$I->click('Upload files');

$I->attachFile('files',$fileName);

$I->dontSeeInDatabase('files',[
   'project_id' => $projectId,
   'name' => $fileName,
   'content' => $fileContent
]);

$I->click('Upload');

$I->seeInDatabase('files',[
    'project_id' => $projectId,
    'name' => $fileName,
    'content' => $fileContent
]);

$I->seeCurrentUrlEquals('/projects/'.$projectId);

// Edit file test

$fileId = $I->grabFromDatabase('files', 'id', [
    'project_id' => $projectId,
    'name' => $fileName,
    'content' => $fileContent
]);

$I->click('Edit', Locator::elementAt('//table',1));

$I->seeCurrentUrlEquals('/projects/'.$projectId.'/files/'.$fileId.'/edit');

$I->see('Editing '.$fileName);

$I->see(base64_decode($fileContent),'textarea');

// close editing
$newFileContent = "print('Hello there!')";
$I->fillField('content',$newFileContent);

$I->click('Close');

$I->seeInDatabase('files',[
    'project_id' => $projectId,
    'name' => $fileName,
    'content' => $fileContent
]);

$I->dontSeeInDatabase('files',[
    'project_id' => $projectId,
    'name' => $fileName,
    'content' => $newFileContent
]);

$I->seeCurrentUrlEquals('/projects/'.$projectId);
