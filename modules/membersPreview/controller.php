<?php

require_once 'members/model.php';

$membersAndImages = Member::getMembersPreview(3);

$members = $membersAndImages [0];
$images = $membersAndImages [1];

include 'tmpl.php';
