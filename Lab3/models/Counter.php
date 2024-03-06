<?php

class Counter
{
    public static function getCount()
    {

        $visits = file_get_contents("visits.txt");
        return intval($visits);
    }

    public static function addVisit()
    {
        $new_count = self::getCount() + 1;
        $fp = fopen("visits.txt", "w");
        fwrite($fp, $new_count);
        fclose($fp);
    }
}

<?php
class Counter {
    private $filePath;
    public function __construct($filePath) {
        $this->filePath = $filePath;
    }
    public function incrementCounter() {
        $count = $this->getCount();
        $count++;
        file_put_contents($this->filePath, $count);
        return $count;
    }
    public function getCount() {
        if (file_exists($this->filePath)) {
            return intval(file_get_contents($this->filePath));
        } else {
            return 0;
        }
    }
}
?>