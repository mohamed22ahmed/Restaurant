<?php
namespace Deployer;

require 'recipe/laravel.php';

/*
task('test', function () {
  writeln('Hello world 2');
});*/

// Project name
set('application', 'mints');

// Project repository
set('repository', 'git@github.com:MintsSolutions/Mints.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false); 

set('ssh_multiplexing', false);

// overwrite path to php and composer
set('bin/php', 'php');
set('bin/composer', 'composer');

 
// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);
set('allow_anonymous_stats', false);

// set composer setting for deploy:vendors task
env('composer_options', 'install --no-dev --verbose --prefer-dist --optimize-autoloader --no-progress --no-interaction --no-scripts');



// Hosts

host('159.203.20.230')
    ->user('abuyazeed')
      ->set('use_sudo', false)
    ->set('bin/php', 'php')
    ->set('bin/composer', 'composer')
    ->set('deploy_path', '/var/www/html/mints');
   
     

task('build', function () {
    run('cd {{release_path}} && build');

/*
    within('{{release_path}}', function () {
      run('npm run build');   
    });
     
    within('{{release_path}}', function () {
      run('composer run build');   
    });*/
});
//task('deploy:vendors',function(){});



 
// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

