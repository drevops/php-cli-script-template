<?php

/**
 * Class ExampleScriptUnitTest.
 *
 * Unit tests for script.php.
 *
 * @group scripts
 *
 * phpcs:disable Drupal.Commenting.DocComment.MissingShort
 * phpcs:disable Drupal.Commenting.FunctionComment.Missing
 */
class ExampleScriptUnitTest extends ScriptUnitTestBase {

  /**
   * {@inheritdoc}
   */
  protected $script = 'script.php';

  /**
   * @dataProvider dataProviderMain
   * @runInSeparateProcess
   */
  public function testMain($args, $expected_code, $expected_output) {
    $args = is_array($args) ? $args : [$args];
    $result = $this->runScript($args, TRUE);
    $this->assertEquals($expected_code, $result['code']);
    $this->assertStringContainsString($expected_output, $result['output']);
  }

  public function dataProviderMain() {
    return [
      [
        '--help',
        0,
        'PHP CLI script template.',
      ],
      [
        '-help',
        0,
        'PHP CLI script template.',
      ],
      [
        '-h',
        0,
        'PHP CLI script template.',
      ],
      [
        '-?',
        0,
        'PHP CLI script template.',
      ],
      [
        [],
        1,
        'PHP CLI script template.',
      ],
      [
        [1, 2],
        1,
        'PHP CLI script template.',
      ],

      // Validation of business logic.
      [
        'arg1value',
        0,
        'Would execute script business logic with argument arg1value.',
      ],
    ];
  }

}
