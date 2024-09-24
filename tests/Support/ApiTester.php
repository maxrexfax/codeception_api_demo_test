<?php

declare(strict_types=1);

namespace Tests\Support;

/**
 * Inherited Methods
 * @method void wantTo($text)
 * @method void wantToTest($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause($vars = [])
 *
 * @SuppressWarnings(PHPMD)
*/
class ApiTester extends \Codeception\Actor
{
    use _generated\ApiTesterActions;

    /**
     * Define custom actions here
     */
    /**
     * @param array $format
     * @param string $text
     * @return void
     * $this->formatPrint(['blue', 'bold', 'italic','strikethrough'], "Wohoo");//print line without end of line
     */
    public function formatPrint(array $format=[],string $text = '') {
        $codes=[
            'bold'=>1,
            'italic'=>3, 'underline'=>4, 'strikethrough'=>9,
            'black'=>30, 'red'=>31, 'green'=>32, 'yellow'=>33,'blue'=>34, 'magenta'=>35, 'cyan'=>36, 'white'=>37,
            'blackbg'=>40, 'redbg'=>41, 'greenbg'=>42, 'yellowbg'=>44,'bluebg'=>44, 'magentabg'=>45, 'cyanbg'=>46, 'lightgreybg'=>47
        ];
        $formatMap = array_map(function ($v) use ($codes) { return $codes[$v]; }, $format);
        echo "\e[".implode(';',$formatMap).'m'.$text."\e[0m";
    }

    /**
     * @param array $format
     * @param string $text
     * @return void
     * $this->formatPrintLn(['yellow', 'bold'], "I'm invicible"); //print line with line terminator
     */
    public function formatPrintLn(array $format=[], string $text='') {
        $this->formatPrint($format, $text . PHP_EOL);
    }
}
