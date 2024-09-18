<link rel="stylesheet" type="text/css" href="//yui.yahooapis.com/3.18.1/build/cssreset-context/cssreset-context-min.css">
<style type="text/css">
	.recaptchatable #recaptcha_response_field {
		line-height:15px !important;
		height:15px !important;
	}
</style>
{{if $smarty.request.ajax}}
<div id="ajax_captcha" class="yui3-cssreset"></div>
<script type="text/javascript">
    renderCaptcha('ajax_captcha');
</script>
{{else}}
    {{$captcha}}
{{/if}}