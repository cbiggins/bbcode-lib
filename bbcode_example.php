<?php

require_once('bbcode.lib');
$bbcodestring = "[b]This is bold[/b] and [i] this is in italics [/i] and this is [u]underlined[/u] and [s]this is struckthrough'd[/s] and this is both [u][s]underlined and struckthrough'd[/s][/u] and this is [center]centered[/center]";
$bbcode = new FLQ_bbcode($bbcodestring);
print $bbcode->toHTML(true);

print "<br />";

$bbcode->newString('<strong>This is bold</strong> and <em> this is in italics </em> and this is <span style="text-decoration: underline;">underlined</span> and <span style="text-decoration: line-through;">this is struckthrough\'d</span> and this is both <span style="text-decoration: underline;"><span style="text-decoration: line-through;">underlined and struckthrough\'d</span></span> and this is <div align="center">centered</div>');
print $bbcode->toBBcode();