class DateFactory
{
    /**
     * @param null $date
     * @param null $timezone
     * @return DateTime
     * @throws InvalidArgumentException
     */
    public function getDate($date = null, $timezone = null)
    {
        if(!$date){
            $date = new \DateTime('UTC');
            if($timezone){
                $date->setTimezone(new \DateTimeZone($timezone));
            }
        } else {
            list($day, $month, $year) = explode('/', $date);
            if(checkdate((int)$month, (int)$day, (int)$year)){
                $date = \DateTime::createFromFormat('d/m/Y', $date, new \DateTimeZone('UTC'));
                if($timezone){
                    $date->setTimezone(new \DateTimeZone($timezone));
                }
            } else {
                throw new InvalidArgumentException('Invalid date string');
            }
        }
        return $date;
    }
}

$DateFactory = new DateFactory();
var_dump($DateFactory->getDate());
var_dump($DateFactory->getDate(null, 'Europe/London'));
var_dump($DateFactory->getDate('4/10/2013'));
var_dump($DateFactory->getDate('4/10/2013', 'Europe/London'));
var_dump($DateFactory->getDate('30/2/2013'));
