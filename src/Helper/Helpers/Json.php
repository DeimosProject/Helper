<?php

namespace Deimos\Helper\Helpers;

use Deimos\Helper\AbstractHelper;

class Json extends AbstractHelper
{

    const OPTIONS_ENCODE = 0;
    const OPTIONS_DECODE = 1;
    /**
     * @var array
     */
    protected $options = [];

    /**
     * fixme
     *
     * @param int $value
     * @param int $target
     */
    public function addOption($value, $target = self::OPTIONS_ENCODE)
    {
        if (empty($this->options[$target]))
        {

            $this->options[$target] = [];
        }

        $this->options[$target][] = $value;
    }

    /**
     * @param array|int $options
     * @param int       $target
     */
    public function setOption($options, $target = self::OPTIONS_ENCODE)
    {
        if (!is_array($options))
        {

            $options = [$options];
        }

        $this->options[$target] = $options;
    }

    /**
     * @param $data
     *
     * @return string
     */
    public function encode($data)
    {
        return json_encode($data, $this->options(self::OPTIONS_ENCODE));
    }

    /**
     * @param int $target
     *
     * @return int
     */
    protected function options($target)
    {
        $options = JSON_ERROR_NONE;

        if(isset($this->options[$target]))
        {
            foreach ($this->options[$target] as $option)
            {
                $options |= $option;
            }
        }

        return $options;
    }

    /**
     * @param string $data
     * @param bool   $assoc
     *
     * @return mixed
     */
    public function decode($data, $assoc = true)
    {
        return json_decode($data, $assoc, 512, $this->options(self::OPTIONS_DECODE));
    }

}