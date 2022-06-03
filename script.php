<?php

/**
 * @file
 * PHP CLI script template.
 *
 * -----------------------------------------------------------------------------
 * PHP script template for single-file CLI scripts without dependency on
 * external packages.
 *
 * To adopt script template:
 * - Replace "PHP CLI script template" with your script human name.
 * - Replace "script.php" with your script file name.
 * - Update arguments count check to suit your needs.
 * - Update print_help() function with your content.
 * - Copy '/tests' directory into your project and update
 *   ExampleScriptUnitTest.php (with a test class inside) to a script file name.
 * - Remove this block of comments.
 * -----------------------------------------------------------------------------
 *
 * Environment variables:
 * - SCRIPT_QUIET: Set to '1' to suppress verbose messages.
 * - SCRIPT_RUN_SKIP: Set to '1' to skip running of the script. Useful when
 *   unit-testing or requiring this file from other files.
 *
 * Usage:
 * @code
 * php script.php
 * @endcode
 *
 * phpcs:disable Drupal.Commenting.InlineComment.SpacingBefore
 * phpcs:disable Drupal.Commenting.InlineComment.SpacingAfter
 * phpcs:disable DrupalPractice.Commenting.CommentEmptyLine.SpacingAfter
 */

/**
 * Defines exit codes.
 */
define('EXIT_SUCCESS', 0);
define('EXIT_ERROR', 1);

/**
 * Main functionality.
 */
function main(array $argv, $argc) {
  if (in_array($argv[1] ?? NULL, ['--help', '-help', '-h', '-?'])) {
    print_help();

    return EXIT_SUCCESS;
  }

  // Show help if not enough or more than required arguments.
  if ($argc < 2 || $argc > 2) {
    print_help();

    return EXIT_ERROR;
  }

  // Add your logic here.
  verbose(sprintf('Would execute script business logic with argument %s.', $argv[1]));

  return EXIT_SUCCESS;
}

/**
 * Print help.
 */
function print_help() {
  $script_name = basename(__FILE__);
  print <<<EOF
PHP CLI script template.
------------------------

Arguments:
  value/of/argument     Value of the first argument.

Options:
  --help                This help.

Examples:
  php ${script_name} path/to/file

EOF;
  print PHP_EOL;
}

// ////////////////////////////////////////////////////////////////////////// //
//                                UTILITIES                                   //
// ////////////////////////////////////////////////////////////////////////// //

/**
 * Show a verbose message.
 */
function verbose() {
  if (getenv('SCRIPT_QUIET') != '1') {
    print call_user_func_array('sprintf', func_get_args()) . PHP_EOL;
  }
}

// ////////////////////////////////////////////////////////////////////////// //
//                                ENTRYPOINT                                  //
// ////////////////////////////////////////////////////////////////////////// //

ini_set('display_errors', 1);

if (PHP_SAPI != 'cli' || !empty($_SERVER['REMOTE_ADDR'])) {
  die('This script can be only ran from the command line.');
}

// Allow to skip the script run.
if (getenv('SCRIPT_RUN_SKIP') != 1) {
  try {
    $code = main($argv, $argc);
    if (is_null($code)) {
      throw new \Exception('Script exited without providing an exit code.');
    }
    exit($code);
  }
  catch (\Exception $exception) {
    print PHP_EOL . 'ERROR: ' . $exception->getMessage() . PHP_EOL;
    exit($exception->getCode() == 0 ? EXIT_ERROR : $exception->getCode());
  }
}
