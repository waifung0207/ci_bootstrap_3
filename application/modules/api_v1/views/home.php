<?php $this->layout('layouts::base') ?>

<?php $this->start('scripts_head'); ?>
	<script type="text/javascript">
		$(function () {
			var url = window.location.search.match(/url=([^&]+)/);
			if (url && url.length > 1) {
				url = decodeURIComponent(url[1]);
			} else {
				// Reference: http://petstore.swagger.io/v2/swagger.json
				url = "<?php echo site_url('api/swagger'); ?>";
			}
			window.swaggerUi = new SwaggerUi({
				url: url,
				dom_id: "swagger-ui-container",
				supportedSubmitMethods: ['get', 'post', 'put', 'delete', 'patch'],
				onComplete: function(swaggerApi, swaggerUi){
					if(typeof initOAuth == "function") {
						initOAuth({
							clientId: "your-client-id",
							realm: "your-realms",
							appName: "your-app-name"
						});
					}

					$('pre code').each(function(i, e) {
						hljs.highlightBlock(e)
					});

					addApiKeyAuthorization();
				},
				onFailure: function(data) {
					log("Unable to Load SwaggerUI");
				},
				docExpansion: "none",
				apisSorter: "alpha",
				showRequestHeaders: false
			});

			function addApiKeyAuthorization(){
				var key = encodeURIComponent($('#input_apiKey')[0].value);
				if(key && key.trim() != "") {
					var apiKeyAuth = new SwaggerClient.ApiKeyAuthorization("token", key, "query");
					//var apiKeyAuth = new SwaggerClient.ApiKeyAuthorization("Authorization", key, "header");
					window.swaggerUi.api.clientAuthorizations.add("api_key", apiKeyAuth);
					log("added key " + key);
				}
			}
			
			$('#input_apiKey').change(addApiKeyAuthorization);

			<?php
				// if you have an apiKey you would like to pre-populate on the page for demonstration purposes...
				/*
					var apiKey = "myApiKeyXXXX123456789";
					$('#input_apiKey').val(apiKey);
				*/
				if ( !empty($token) )
				{
					echo 'var apiKey = "'.$token.'"; $("#input_apiKey").val(apiKey);';
				}
			?>

			window.swaggerUi.load();

			function log() {
				if ('console' in window) {
					console.log.apply(console, arguments);
				}
			}
	});
	</script>
<?php $this->stop(); ?>

<div id='header'>
	<div class="swagger-ui-wrap">
		<a id="logo" href="">API Doc</a>
		<form id='api_selector'>
			<div class='input'><input placeholder="http://example.com/api" id="input_baseUrl" name="baseUrl" type="text"/></div>
			<div class='input'><input placeholder="api_key" id="input_apiKey" name="apiKey" type="text"/></div>
			<div class='input'><a id="explore" href="#">Explore</a></div>
		</form>
	</div>
</div>

<div id="message-bar" class="swagger-ui-wrap">&nbsp;</div>
<div id="swagger-ui-container" class="swagger-ui-wrap"></div>