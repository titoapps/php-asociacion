<?php

require_once 'model.php';

$membersAndImages = Member::getMembersPreview(3);

$members = $membersAndImages [0];
$images = $membersAndImages [1];

include 'tmpl.php';