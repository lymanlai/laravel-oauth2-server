<?php
Route::post("(:bundle)/authorize", function() {
	$oA = new SebRenauld\OAuth2();
	$i = Input::all();
	$r = $oA->finishClientAuthorization($i);
	return $r;
});
Route::get("(:bundle)/authorize", function() {
	$oA = new SebRenauld\OAuth2();
	$i = Input::all();
	$r = $oA->getAuthorizeParams($i);
	if (!is_array($r)) return $r;
	return View::make("oauth2-sp::form",array("data" => $r));
});
Route::get("(:bundle)/token", function() {
	$oA = new SebRenauld\OAuth2();
	$r = $oA->grantAccessToken(Input::all());
	if ($r instanceof Laravel\Response) {
		return $r;
	}
	if ($r instanceof SebRenauld\OAuth2\Models\Token) {
		return $r->printToken();
	}
});

Route::post("(:bundle)/token", function() {
	$oA = new SebRenauld\OAuth2();
	$r = $oA->grantAccessToken(Input::all());
	if ($r instanceof Laravel\Response) {
		return $r;
	}
	if ($r instanceof SebRenauld\OAuth2\Models\Token) {
		return $r->printToken();
	}
});
