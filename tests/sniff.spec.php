<?php

use Webmozart\Assert\Assert;

const CODE_INVALID_SYNTAX = 8;

describe('the validate command', function () {
    it('should exit with the exit code 0 when there are no errors', function () {
        list($code) = sniff('valid');
        Assert::eq($code, 0);
    });
    it('should exit with an exit code greater than 0 when there are errors', function () {
        list($code, $output) = sniff('invalid');
        Assert::eq($code, CODE_INVALID_SYNTAX);
        Assert::contains($output, 'test.php');
    });
});

describe('the configuration', function () {
    it('should allow to analyze multiple paths', function () {
        list($code, $output) = sniff('multiple-paths');
        Assert::eq($code, CODE_INVALID_SYNTAX, $output);
        Assert::contains($output, 'test1.php');
        Assert::contains($output, 'test2.php');
    });
    it('should not accept paths outside the project directory', function () {
        $testCases = [
            'invalid-path-1',
            'invalid-path-2',
            'invalid-path-3',
        ];
        foreach ($testCases as $testCase) {
            list($code, $output) = sniff($testCase);
            Assert::greaterThan($code, 0);
            Assert::contains($output, 'The .sniff.json configuration file contains an invalid path.');
        }
    });
});

it('should ignore php-cs-fixer config files', function () {
    // TODO
});

function sniff($directory, $command = 'validate')
{
    chdir(__DIR__ . '/' . $directory);
    exec("../../sniff $command 2>&1", $output, $code);
    $output = implode(PHP_EOL, (array) $output);
    return [$code, $output];
}
