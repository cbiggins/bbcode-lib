<?php

    /**
     * Copyright 2009 Michael Little, Christian Biggins
     *
     * This program is free software: you can redistribute it and/or modify
     * it under the terms of the GNU General Public License as published by
     * the Free Software Foundation, either version 3 of the License, or
     * (at your option) any later version.
     *
     * This program is distributed in the hope that it will be useful,
     * but WITHOUT ANY WARRANTY; without even the implied warranty of
     * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
     * GNU General Public License for more details.
     *
     * You should have received a copy of the GNU General Public License
     * along with this program. If not, see <http://www.gnu.org/licenses/>.
     */

    /**
     * BBCode library. A library for converting bbcode to HTML and vice versa
     *
     * Version: 1.0.0 BETA
     * Last Modified: 13/01/2009
     */

class FLQ_bbcode {

    public $bbcode_str = array(
                    'bold_open' => '[b]',
                    'bold_close' => '[/b]',
                    'italic_open' => '[i]',
                    'italic_close' => '[/i]',
                    'underline_open' => '[u]',
                    'underline_clode' => '[/u]',
                    'strikethrough_open' => '[s]',
                    'strikethrough_close' => '[/s]',
                    'center_open' => '[center]',
                    'center_close' => '[/center]',
                    'quote_open' => '[quote]',
                    'quote_close' => '[/quote]'
    );

    public $bbcode_regex = array(
                    'url1' => array('/(\[url=)([^\]]+)(\])([^\]]+)(\[\/url])/', '<a href="$2">$4</a>'),
                    'url2' => array('/(\[url\])([^\]]+)(\[\/url\])/', '<a href="$2">$2</a>'),
                    'color' => array('/(\[color=)([^\]]+)(\])([^\]]+)(\[\/color])/', '<span style="color:$2;">$4</span>'),
                    'size' => array('/(\[size=)([^\]]+)(\])([^\]]+)(\[\/size])/', '<span style="font-size:$2;">$4</span>'),
                    'quote' => array('/(\[quote=)([^\]]+)(\])([^\]]+)(\[\/quote])/', '<blockquote>$4</blockquote>')
    );

    public $html_str = array(
                    'bold_open' => '<strong>',
                    'bold_close' => '</strong>',
                    'italic_open' => '<em>',
                    'italic_close' => '</em>',
                    'underline_open' => '<span style="text-decoration: underline;">',
                    'underline_clode' => '</span>',
                    'strikethrough_open' => '<span style="text-decoration: line-through;">',
                    'strikethrough_close' => '</span>',
                    'center_open' => '<div align="center">',
                    'center_close' => '</div>',
                    'quote_open' => '<blockquote>',
                    'quote_close' => '</blockquote>'
    );

    public $html_regex = array(
                    'url' => array('/<a.*href=(\'|")([^\'"]+)(\'|")[^>]*>(.+)<\/a>/', '[url=$2]$4[/url]'),
                    'img' => array('/<img[^>]*src=(\'|")([^\'"]+)(\'|")[^>]*>/', '[img]$2[/img]'),
    );

    public $str;

    function __construct($str) {
        $this->str = $str;
    }

    /**
        *  newString() is for replacing the current string with a new string so there is no need to create a new object to perform another conversion
        *
        * @return null
        * @param String $str the string to be converted
        */
    public function newString($str) { $this->str = $str; }

    /**
        *  toHTML() will output the current bbcode formatted string into valid standards compliant HTML
        *
        * @return String
        * @param Boolean $encoded if true, output will be encoded to visualise the HTML
        */
    public function toHTML($encoded = false) {
        foreach ($this->bbcode_regex as $type => $regex) {
            $this->str = preg_replace($regex[0], $regex[1], $this->str);
        }
        if (!$encoded) {
            return str_replace($this->bbcode_str, $this->html_str, $this->str);
        } else {
            return htmlentities(str_replace($this->bbcode_str, $this->html_str, $this->str));
        }
    }

    /**
        *  toBBcode() will output the current html formatted string into BBCode, with some exceptions. This will not convert html that uses css for its formatting, so no colours, underlines etc.
        *
        * @return String
        */
    public function toBBCode() {
        foreach ($this->html_regex as $type => $regex) {
            $this->str = preg_replace($regex[0], $regex[1], $this->str);
        }

        return str_replace($this->html_str, $this->bbcode_str, $this->str);
    }
}