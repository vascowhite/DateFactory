class DateFactory
{
    /**
     * @param String || null $date A valid date string in the format d/m/Y
     * @param String || null $timezone A valid TimeZone string
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
