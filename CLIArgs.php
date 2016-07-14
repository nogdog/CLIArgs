<?php
/**
 * @author Charles Reace
 */

/**
 * Class CLIArgs
 * Handle command line args
 */
class CLIArgs
{
    private $args = array();
    private $opts = array();

    /**
     * CLIArgs constructor.
     * @param array $opts ['name' => ['short' => 'v', 'long' => 'var', 'param' => 'foo', 'help' => 'help text']
     */
    public function __construct(Array $opts)
    {
        $this->opts = $opts;
        $this->getOpts();
    }

    /**
     * @param string $name long name of parameter (e.g. 'help'
     * @return null|mixed  null if arg not found in request
     */
    public function getArg($name)
    {
        foreach(array('short', 'long') as $type) {
            if (isset($this->args[$this->opts['name'][$type]])) {
                return $this->args[$this->opts['name'][$type]];
            }
        }
        return null;
    }

    /**
     * Get all arg data
     * @return array
     */
    public function getArgs()
    {
        return $this->args;
    }

    /**
     * get some plain text for use in usage statement
     * @return string
     * @param string $indent
     */
    public function helpText($indent = '    ')
    {
        $text = '';
        foreach($this->opts as $name => $data) {
            if(!empty($data['short'])) {
                $text .= $indent.'-'.$data['short'];
                if(!empty($data['param'])) {
                    $text.= ' '.$data['param'];
                }
                $text .= PHP_EOL;
            }
            if(!empty($data['long'])) {
                $text .= $indent.'--'.$data['long'];
                if(!empty($data['param'])) {
                    $text .= '='.$data['param'];
                }
                $text .= PHP_EOL;
            }
            $text .= $indent.$indent.$data['help'].PHP_EOL;
        }
        return $text;
    }

    private function getOpts()
    {
        $optString = '';
        $optArray  = array();
        foreach($this->opts as $key => $data) {

            if(!empty($data['short'])) {
                $optString .= $data['short'];
                if(!empty($data['param'])) {
                    $optString .= ':';
                }
            }
            if(!empty($data['long'])) {
                $str = $data['long'];
                if(!empty($data['param'])) {
                    $str .= ':';
                }
                $optArray[] = $str;
            }
        }
        $this->args = getopt($optString, $optArray);
        return !empty($this->opts);
    }
}
