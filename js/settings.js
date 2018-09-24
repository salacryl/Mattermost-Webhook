	$(document).ready(function () {
		$.ajax({
				method: "GET",
				url: OC.generateUrl("apps/mattermostwebhook/settings/load"),
				success: function onSuccess(response) {

					if (response && response.webhookurl != null) {
						$("#mattermostwebhookurl").val(response.webhookurl);


						
					}
				}
			});
		$("#webhooksaveurl").click(function () {

			var webhookurl = $("#mattermostwebhookurl").val().trim();
			$.ajax({
				method: "PUT",
				url: OC.generateUrl("apps/mattermostwebhook/settings/save"),
				data: {
					webhookurl: webhookurl,

				},
				success: function onSuccess(response) {

					if (response && response.webhookurl != null) {
						$("#mattermostwebhookurl").val(response.webhookurl);


						var message =
							response.error ?
							(t("MattermostWebhook", "Error when trying to connect") + " (" + response.error + ")") :
							t("MattermostWebhook", "Settings have been successfully updated");
						var row = OC.Notification.show(message);
						setTimeout(function () {
							OC.Notification.hide(row);
						}, 3000);
					}
				},
				error: function onError(jqXHR, textStatus, errorThrown) {
					console.log(textStatus);
					var message = (t("MattermostWebhook", "Error when trying to connect") + " (" + errorThrown + ")") ;
						var row = OC.Notification.show(message);
						setTimeout(function () {
							OC.Notification.hide(row);
						}, 3000);
				}
			});
		});
	});
