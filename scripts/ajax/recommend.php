<?php

/*

Copyright © 2010–2012 Christopher R. Maden and Jessica Perry Hekman.

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the “Software”), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED “AS IS,” WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

*/

include_once (dirname(__FILE__)."/../initialize.php");

// Only recommend if user is logged in.
if (isLoggedIn()) {
	$db = ssDbConnect();
	$authUser = new auth();
	$authUserId = $authUser->userId;
	$authUserName = $authUser->userName;
	$userPriv = getUserPrivilegeStatus($authUserId, $db);
	$id = $_REQUEST["id"];
	$step = $_REQUEST["step"];
	$type = $_REQUEST["type"];
	
	$typeId = "";
	if ($type == "post")
		$typeId = "1";
	elseif ($type == "user")
		$typeId = "2";
	
	if ($step == 'recommend') {
		addRecommendation($id, $typeId, $authUserId, $db);
	} elseif ($step == 'recommended') {	
		removeRecommendation($id, $typeId, $authUserId, $db);
	}
	
	recButton($id, $typeId, $authUserId, TRUE, $db);
}

?>