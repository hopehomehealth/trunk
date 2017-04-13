<?php
function getNextMonthDays($date){
	$timestamp = strtotime($date);
	$arr = getdate($timestamp);
	if($arr['mon'] == 12){
		$year=$arr['year'] +1;
		$month=$arr['mon'] -11;
		$firstday = $year.'-0'.$month.'-01';
		$lastday = date('Y-m-d',strtotime("$firstday +1 month -1 day"));
	}else{
		$firstday = date('Y-m-01',strtotime(date('Y',$timestamp).'-'.(date('m',$timestamp)+1).'-01'));
		$lastday = date('Y-m-d',strtotime("$firstday +1 month -1 day"));
	}
	return array($firstday,$lastday);
}

function getNextToday($days){
	$time = strtotime($days.' month', time()); 
	return date('Ym', mktime(0, 0,0, date('m', $time), 1, date('Y', $time))).date('d');
}

class Calendar
{
    private $year;
    private $month;
    private $weeks  = array('日','一','二','三','四','五','六');
    public $adult_price_array;
	public $adult_stock_array;
	public $kid_price_array;
	public $kid_stock_array;
	public $diff_price_array; 

    function __construct($options = array()) {
        $this->year = date('Y');
        $this->month = date('m');
        
        $vars = get_class_vars(get_class($this));
        foreach ($options as $key=>$value) {
            if (array_key_exists($key, $vars)) {
                $this->$key = $value;
            }
        }
    }
    
    function display()
    {
        echo '<table class="calendar" width="100%">';
        //$this->showChangeDate();
        $this->showWeeks();
        $this->showDays($this->year,$this->month);
        echo '</table>';
    }
    
    private function showWeeks()
    {
        echo '<tr>';
        foreach($this->weeks as $title)
        {
            echo '<th>'.$title.'</th>';
        }
        echo '</tr>';
    }

	private function showInput($curr_date) 
	{
		$curr_week = date('w', strtotime($curr_date));

		$my_adult_price_array = $this->adult_price_array;
		$my_adult_stock_array = $this->adult_stock_array;
		$my_kid_price_array   = $this->kid_price_array;
		$my_kid_stock_array   = $this->kid_stock_array;
		$my_diff_price_array  = $this->diff_price_array;   

		$rs = '<br/><input type="text" class="adult_w_'.$curr_week.'" name="adult_price['.$curr_date.']" style="text-align:center;width:50px;height:12px;font-size:12px;color:#6666ff" value="'.$my_adult_price_array[$curr_date].'" placeholder="成人价" title="成人价格'.$curr_date.'">';
		$rs .= '&nbsp;<input type="text" class="adult_s_'.$curr_week.'" name="adult_stock['.$curr_date.']" style="text-align:center;width:40px;height:12px;font-size:12px;color:#6666ff" value="'.$my_adult_stock_array[$curr_date].'" placeholder="库存" title="成人库存">';

		$rs .= '<br/><input type="text" class="kid_w_'.$curr_week.'" name="kid_price['.$curr_date.']" style="text-align:center;width:50px;height:12px;font-size:12px;color:#66cc00" value="'.$my_kid_price_array[$curr_date].'" placeholder="儿童价" title="儿童价格">';
		$rs .= '&nbsp;<input type="text" class="kid_s_'.$curr_week.'" name="kid_stock['.$curr_date.']" style="text-align:center;width:40px;height:12px;font-size:12px;color:#6666ff" value="'.$my_kid_stock_array[$curr_date].'" placeholder="库存" title="儿童库存">';

		$rs .= '<br/><input type="text" class="diff_w_'.$curr_week.'" name="diff_price['.$curr_date.']" style="text-align:center;width:60px;height:12px;font-size:12px;color:#0099ff" value="'.$my_diff_price_array[$curr_date].'" placeholder="单房差"> ';

		return $rs;
	}
    
    private function showDays($year, $month)
    {
        $firstDay = mktime(0, 0, 0, $month, 1, $year);
        $starDay = date('w', $firstDay);
        $days = date('t', $firstDay);

        echo '<tr>';
        for ($i=0; $i<$starDay; $i++) {
            echo '<td>&nbsp;</td>';
        }
        
        for ($j=1; $j<=$days; $j++) {
            $i++;
			if($j<10) {
				$now_day = '0'.$j;
			}else{
				$now_day = $j;
			} 

			$curr_ymd = $year.$month.$now_day;  
			
			$inputs = "";
            if ($curr_ymd>date('Ymd') && $curr_ymd<=getNextToday(3)) { 
				$inputs = $this->showInput($curr_ymd);
			}  

			if ( $curr_ymd<=getNextToday(3)) { 

				echo '<td><b style="font-size:14px;float:left;">'.$j.'</b>'.$inputs.'</td>';
            }

            if ($i % 7 == 0) {
                echo '</tr><tr>';
            }
        }
        
        echo '</tr>';
    }
    
    private function showChangeDate()
    {
        
        $url = basename($_SERVER['PHP_SELF']);
        
        echo '<tr>';
		echo '<td><a href="?'.$this->preYearUrl($this->year,$this->month).'">'.'<<'.'</a></td>';
		echo '<td><a href="?'.$this->preMonthUrl($this->year,$this->month).'">'.'<'.'</a></td>';
        echo '<td colspan="3"><form target="frm">';
        
        echo '<select name="year" onchange="window.location=\''.$url.'?year=\'+this.options[selectedIndex].value+\'&month='.$this->month.'\'">';
        for($ye=1970; $ye<=2038; $ye++) {
            $selected = ($ye == $this->year) ? 'selected' : '';
            echo '<option '.$selected.' value="'.$ye.'">'.$ye.'</option>';
        }
        echo '</select>';
        echo '<select name="month" onchange="window.location=\''.$url.'?year='.$this->year.'&month=\'+this.options[selectedIndex].value+\'\'">';
        

        
        for($mo=1; $mo<=12; $mo++) {
            $selected = ($mo == $this->month) ? 'selected' : '';
            echo '<option '.$selected.' value="'.$mo.'">'.$mo.'</option>';
        }
        echo '</select>';        
        echo '</form></td>';        
		echo '<td><a href="?'.$this->nextMonthUrl($this->year,$this->month).'">'.'>'.'</a></td>';
		echo '<td><a href="?'.$this->nextYearUrl($this->year,$this->month).'">'.'>>'.'</a></td>';        
        echo '</tr>';
    }
    
    private function preYearUrl($year,$month)
    {
        $year = ($this->year <= 1970) ? 1970 : $year - 1 ;
        
        return 'year='.$year.'&month='.$month;
    }
    
    private function nextYearUrl($year,$month)
    {
        $year = ($year >= 2038)? 2038 : $year + 1;
        
        return 'year='.$year.'&month='.$month;
    }
    
    private function preMonthUrl($year,$month)
    {
        if ($month == 1) {
            $month = 12;
            $year = ($year <= 1970) ? 1970 : $year - 1 ;
        } else {
            $month--;
        }        
        
        return 'year='.$year.'&month='.$month;
    }
    
    private function nextMonthUrl($year,$month)
    {
        if ($month == 12) {
            $month = 1;
            $year = ($year >= 2038) ? 2038 : $year + 1;
        }else{
            $month++;
        }
        return 'year='.$year.'&month='.$month;
    }
    
}
?>