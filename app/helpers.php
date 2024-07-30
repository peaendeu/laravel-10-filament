<?php

use App\Models\Partner;
use App\Models\Section;
use App\Models\Setting;

function get_setting_value($key)
{
  $data = Setting::where('key', $key)->first();
  if (isset($data->value)) {
    return $data->value;
  } else {
    return 'empty';
  }
}

function get_section_data($key)
{
  $data = Section::where('post_as', $key)->first();
  if (isset($data)) {
    return $data;
  }
}

function get_partner()
{
  $data = Partner::all();
  return $data;
}
