<?php namespace XoopsModules\Cardealer;

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/
/**
 * Module: cardealer
 *
 * @category        Module
 * @package         cardealer
 * @author          XOOPS Development Team <mambax7@gmail.com> - <https://xoops.org>
 * @copyright       {@link https://xoops.org/ XOOPS Project}
 * @license         GPL 2.0 or later
 * @link            https://xoops.org/
 * @since           1.0.0
 */

/**
 * Class Helper
 */
class Helper extends \Xmf\Module\Helper
{
    public $debug;

    /**
     * Constructor
     *
     * @param bool $debug
     */
    public function __construct($debug = false)
    {
        $this->debug   = $debug;
        $moduleDirName = basename(dirname(__DIR__));
        parent::__construct($moduleDirName);
    }

    /**
     * @param bool $debug
     * @return \XoopsModules\Cardealer\Helper
     */
    public static function getInstance($debug = false)
    {
        static $instance;
        if (null === $instance) {
            $instance = new static($debug);
        }
        return $instance;
    }

    /**
     * @return string
     */
    public function getDirname()
    {
        return $this->dirname;
    }

    /**
     * Get an Object Handler
     *
     * @param string $name name of handler to load
     *
     * @return bool|\XoopsObjectHandler|\XoopsPersistableObjectHandler
     */
    public function getHandler($name)
    {
        $ret   = false;
        $db    = \XoopsDatabaseFactory::getDatabaseConnection();
        $class = '\\XoopsModules\\' . ucfirst(strtolower(basename(dirname(__DIR__)))) . '\\' . $name . 'Handler';
        $ret   = new $class($db);
        return $ret;
    }

}
