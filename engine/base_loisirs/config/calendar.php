<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['day_type'] = 'long';
$config['start_day'] = 'monday';
$config['show_next_prev']  = TRUE;
$config['next_prev_url']  = 'http://tasks.dev/welcome/index';

$config['template'] = '
	{table_open}<table class="calendar">{/table_open}
	{heading_row_start}<tr class="head_row">{/heading_row_start}
	{heading_previous_cell}<th><a href="{previous_url}" class="prochain_mois">Mois precedent</a></th>{/heading_previous_cell}
	{heading_next_cell}<th><a href="{next_url}">Mois suivant</a></th>{/heading_next_cell}
	{week_day_cell}<th class="day_header head_row">{week_day}</th>{/week_day_cell}
	{cal_cell_content}<div style="position: relative; width: 100%; height: 100%;"><span class="day_listing">{day}</span>&nbsp; {content}&nbsp;</div>{/cal_cell_content}
	{cal_cell_content_today}<div class="today"><span class="day_listing">{day}</span> {content}</div>{/cal_cell_content_today}
	{cal_cell_no_content}<span class="day_listing">{day}</span>&nbsp;{/cal_cell_no_content}
	{cal_cell_no_content_today}<div class="today"><span class="day_listing">{day}</span></div>{/cal_cell_no_content_today}
';

/* End of file calendar.php */
/* Location: ./application/config/calendar.php */