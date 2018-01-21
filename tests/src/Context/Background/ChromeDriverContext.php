<?php

namespace Deplink\Repository\Tests\Context\Background;

use Behat\Behat\Context\Context;
use Symfony\Component\Process\Process;

class ChromeDriverContext implements Context
{
    /**
     * @var Process
     */
    protected static $driver;

    /**
     * @BeforeSuite
     * @throws \Symfony\Component\Process\Exception\LogicException
     * @throws \Symfony\Component\Process\Exception\RuntimeException
     */
    public static function start()
    {
        $prefix = self::onWindows() ? '' : 'exec';

        $chromeDriver = 'tests/drivers/chromedriver';
        if (self::onWindows()) {
            $chromeDriver = 'tests/drivers/chromedriver.exe';
        }

        self::$driver = new Process("$prefix \"$chromeDriver\" --port=4444 --url-base=wd/hub");
        self::$driver->start();

        // Wait some time to ensure that driver
        // fully started and is ready to work.
        sleep(4);
    }

    /**
     * Determine if test is running on Windows.
     *
     * @return bool
     */
    protected static function onWindows()
    {
        return PHP_OS === 'WINNT';
    }

    /**
     * @AfterSuite
     * @throws \Symfony\Component\Process\Exception\LogicException
     */
    public static function stop()
    {
        echo "Chrome Driver:";
        echo self::$driver->getOutput();
        echo self::$driver->getErrorOutput();

        self::$driver->stop();
    }
}
