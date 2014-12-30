<?php

require_once 'members/model.php';
require_once 'modules/tools/Tools.php';

$membersAndImages = Member::getMembersPreview(3);

$members = $membersAndImages [0];
$images = $membersAndImages [1];

include 'tmpl.php';
