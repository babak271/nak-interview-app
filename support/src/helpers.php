<?php

use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;

if (!function_exists('get_json_tags')) {
    function get_json_tags(\Illuminate\Support\Collection $tags, $key = "title")
    {
        $result = $tags->pluck($key);

        return json_encode($result->toArray());
    }
}

if (!function_exists('get_glued_json')) {
    function get_glued_json(?string $json_input, $farsi_numbers = true)
    {
        $arr = json_decode($json_input, true) ?? [];
        if (empty($arr)) return '';

        $result = implode(', ', Arr::flatten($arr));

        if ($farsi_numbers) return to_farsi_numbers($result);

        return $result;
    }
}

if (!function_exists('get_tel_link_from_json')) {
    function get_tel_link_from_json(?string $json_input, $farsi_numbers = true, $css_class = '')
    {
        $arr = json_decode($json_input, true) ?? [];
        if (empty($arr)) return '';
        $arr = Arr::flatten($arr);

        $result = [];
        foreach ($arr as $item) {
            $result[] = '<a href="tel:' . $item . '" class="' . $css_class . '">' . to_farsi_numbers($item, !$farsi_numbers) . '</a>';
        }

        return implode(' ,', $result);
    }
}

if (!function_exists('get_email_link_from_json')) {
    function get_email_link_from_json(?string $email, $css_class = '')
    {
        if (empty($email)) return '';
        return '<a href="emailto:' . $email . '" class="' . $css_class . '">' . $email . '</a>';
    }
}

if (!function_exists('to_farsi_numbers')) {
    function to_farsi_numbers($numbers, $reverse = false)
    {
        $en_num = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $fa_num = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        if ($reverse) {
            return str_replace($fa_num, $en_num, $numbers);
        } else {
            return str_replace($en_num, $fa_num, $numbers);
        }
    }
}

if (!function_exists('get_rev_manifest')) {
    function get_rev_manifest($rev_address = 'assets/rev-manifest.json')
    {
        return json_decode(file_get_contents(asset($rev_address)), true);
    }
}

if (!function_exists('get_price_format')) {
    function get_price_format($input, $rial = false, $farsi = false, $raw = false)
    {
        if ($rial) $input *= 10;
        if ($raw) return $input;
        if ($farsi) return to_farsi_numbers(number_format($input));
        return number_format($input);
    }
}

if (!function_exists('array_keys_exists')) {
    function array_keys_exists(array $keys, array $arr)
    {
        return !array_diff_key(array_flip($keys), $arr);
    }
}

if (!function_exists('human_readable_farsi_date')) {
    function human_readable_farsi_date(?string $date, $convert_to_farsi = true)
    {
        $farsi_date = now()->diffInHours($date) < 24
            ? jdate($date)->ago()
            : jdate($date)->format('%A %d %B %Y در %H:%M');

        return $convert_to_farsi
            ? to_farsi_numbers($farsi_date)
            : $farsi_date;
    }
}

if (!function_exists('farsi_date')) {
    function farsi_date(?string $date, $convert_to_farsi = true)
    {
        $farsi_date = jdate($date)->format('%H:%M:%S %Y-%m-%d');

        return $convert_to_farsi
            ? to_farsi_numbers($farsi_date)
            : $farsi_date;
    }
}

if (!function_exists('unique_multidim_array')) {
    function unique_multidim_array($array, $key)
    {
        $temp_array = [];
        $i          = 0;
        $key_array  = [];

        foreach ($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i]  = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }
}

if (!function_exists('delete_array_item_by_value')) {
    function delete_array_item_by_value($array, $value)
    {
        if (($key = array_search($value, $array)) !== false) {
            unset($array[$key]);
        }
        return $array;
    }
}

if (!function_exists('make_valid_time_from_timepicker')) {
    function make_valid_time_from_timepicker($time)
    {
        $delimiter     = ":";
        $separate_time = explode($delimiter, $time);

        if (count($separate_time) == 0) {
            throw new \Exception();
        }

        if (strlen($separate_time[0]) == 1) {
            $separate_time[0] = '0' . $separate_time[0];
        }

        if (count($separate_time) == 1) {
            return $separate_time[0] . $delimiter . '59' . $delimiter . '59';

        } elseif (count($separate_time) == 2) {
            return $separate_time[0] . $delimiter . $separate_time[1] . $delimiter . '59';

        } else {
            return implode($delimiter, $separate_time);
        }
    }
}

if (!function_exists('make_datetime_string_from_timepicker_datepicker')) {
    function make_datetime_string_from_timepicker_datepicker($time, $date, $date_format = "Y-m-d")
    {
        $english_date = CalendarUtils::convertNumbers($date, true);
        $english_time = CalendarUtils::convertNumbers($time, true);
        return Jalalian::fromFormat(
            "$date_format H:i:s", $english_date . " " . make_valid_time_from_timepicker($english_time)
        )->toCarbon();
    }
}

if (!function_exists('array_map_recursive')) {
    function array_map_recursive($callback, $array)
    {
        $func = function ($item) use (&$func, &$callback) {
            return is_array($item) ? array_map($func, $item) : call_user_func($callback, $item);
        };

        return array_map($func, $array);
    }
}

if (!function_exists('calculate_percentage')) {
    function calculate_percentage($number, $full, $get_int = false)
    {
        $result = ($number / $full) * 100;
        return $get_int ? (int)$result : (float)$result;
    }
}

if (!function_exists('create_active_a')) {
    function create_active_a($url, $text, $custom_class = null, $active_class = 'active')
    {
        $class = trim(URL::current(), '/') == $url ? $active_class : '';
        if ($custom_class) $class .= ' ' . $custom_class;
        return '<a href="' . $url . '" class="' . $class . '">' . $text . '</a>';
    }
}

if (!function_exists('create_a')) {
    function create_a($url, $text, $custom_class = null, $target_blank = false)
    {
        $class        = $custom_class ? : '';
        $target_blank = $target_blank ? 'target=_blank' : '';

        return '<a href="' . $url . '" class="' . $class . '" ' . $target_blank . '>' . $text . '</a>';
    }
}

if (!function_exists('catch_mix_error')) {
    function catch_mix_error($path)
    {
        try {
            return mix($path);
        } catch (\Exception $e) {
            return '#';
        }
    }
}
