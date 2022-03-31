<?php

namespace Psalm\Tests\ReturnTypeProvider;

use Psalm\Tests\TestCase;
use Psalm\Tests\Traits\ValidCodeAnalysisTestTrait;

class ArrayWalkTest extends TestCase
{
    use ValidCodeAnalysisTestTrait;

    public function providerValidCodeParse(): iterable
    {
        yield 'arrayWalkWithoutModifyingArgumentInputArgument' => [
            'code' => '<?php
                /**
                 *
                 * @param string[] $var
                 *
                 * @return string[]
                 */
                function test(array $var): array {
                    array_walk(
                        $var,
                        static function(string $param) {
                            return $param;
                        }
                    );

                    return $var;
                }
            '];
        yield 'arrayWalkModifyingInputWithoutChangingType' => [
            'code' => '<?php
                /**
                 *
                 * @param string[] $var
                 *
                 * @return string[]
                 */
                function test(array $var): array {
                    array_walk(
                        $var,
                        static function(string &$param) {
                            $param .= "x";
                        }
                    );

                    return $var;
                }
            ',
        ];
    }
}
