# TR Wordpress Theme

## Prerequisites

+ Node: https://nodejs.org/
+ Yarn: https://yarnpkg.com/
+ Gulp: https://gulpjs.com/

## VS Code plugins
+ EditorConfig for VS Code
+ ESLint
+ Stylelint

## First run
1. `yarn install` - installs required node modules
2. `gulp` - run tasks defined in gulpfile.js

## Development
`gulp watch` - watches files specified in gulpfile.js for changes and runs the specified tasks on change.

## Wordpress Configs
Configs are stored in `public/configs` folder.
1. Manually copy the `wp-config.local.example.php` file to a new file called `wp-config.local.php` and fill-in your own values. This file is for sensitive information and will not be stored in version control.
2. **Environments:** Set the correct environments you wish to support via the file `wp-config.env.php`. Any `wp-config.{environment}.php` file not used can be removed. Remember to remove the reference in `wp-config.env.php` aswell.
3. If a setting is the same across all environments (e.g. authentication unique keys and salts), add to `wp-config.default.php`

See https://github.com/studio24/wordpress-multi-env-config for more information.
