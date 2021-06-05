<script src="{{ mix('assets/js/script.js') }}"></script>

<script>
	var BATinymce = function (imgUrl, mediaUrl, fileUrl, csrf, maxImg, maxMedia, maxFile) {
		maxImg = (typeof maxImg !== 'undefined') ? maxImg : 3000;
		maxMedia = (typeof maxMedia !== 'undefined') ? maxMedia : 10000;
		maxFile = (typeof maxFile !== 'undefined') ? maxFile : 5000;
		var base_url = window.location.origin;
		var ele = $('.tiny');
		var topLevelWindow;
		if (ele.length > 0) {
			tinymce.init({
				selector: '.tiny',
				language: 'fa_IR',
				plugins: [
					'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
					'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking',
					'save table directionality template paste media'
				],
				toolbar1: 'undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
				toolbar2: 'styleselect | link unlink anchor | image media| forecolor backcolor | print preview code ',
				image_advtab: false,
				image_dimensions: false,
				media_dimensions: false,
				media_alt_source: false,
				automatic_uploads: true,
				directionality: 'rtl',
				relative_urls: false,
				remove_script_host: false,
				document_base_url: base_url,
				image_class_list: [
					{title: "Responsive", value: "img-fluid"}
				],
				file_picker_types: 'file image media',
				video_template_callback: function (data) {
					return '<video width="100%" height="auto" ' + (data.poster ? ' poster="' + data.poster + '"' : '') + ' controls="controls">\n' + '<source src="' + data.source + '"' + (data.sourcemime ? ' type="' + data.sourcemime + '"' : '') + ' />\n' + (data.altsource ? '<source src="' + data.altsource + '"' + (data.altsourcemime ? ' type="' + data.altsourcemime + '"' : '') + ' />\n' : '') + '</video>';
				},
				content_style: "body { font-family: 'IRANSans'; }",
				setup: function (editor) {
					editor.on('change', function () {
						editor.save();
					});
					editor.on('OpenWindow', function (eventDetails) {
						topLevelWindow = eventDetails.dialog;
					});
				},
				file_picker_callback: function (callback, value, meta) {
					function showUploadError(text) {
						console.log(text);
					}

					function showSizeError() {
						console.log(text);
					}

					function checkFileSize(file, size) {
						var fsize = Math.round((file.size / 1024));
						if (fsize >= size) {
							showSizeError();
							return false;
						}
						return true;
					}

					var input = document.createElement('input');
					input.setAttribute('type', 'file');

					// Provide file and text for the link dialog
					if (meta.filetype == 'file') {
						input.setAttribute('accept', '.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx');

						input.onchange = function () {
							var file = this.files[0];
							if (checkFileSize(file, maxFile)) {
								var xhr, formData;
								xhr = new XMLHttpRequest();
								xhr.withCredentials = false;
								xhr.open('POST', fileUrl);
								xhr.setRequestHeader("X-CSRF-Token", csrf);
								xhr.upload.onloadstart = function () {
									topLevelWindow.block("Uploading ...");
								};
								xhr.onload = function () {
									topLevelWindow.unblock();
									var json;
									if (xhr.status != 200) {
										if (xhr.status == 422) {
											json = JSON.parse(xhr.responseText);
											showUploadError(json.file);
										}
										callback('');
										return;
									}
									json = JSON.parse(xhr.responseText);

									if (!json || typeof json.location != 'string') {
										showUploadError('');
										callback('');
										return;
									}
									// call the callback and populate the Title field with the file name
									callback(json.location, {text: file.name});
								};
								formData = new FormData();
								formData.append('file', file);
								xhr.send(formData);
							}
						};
					}

					// Provide image and alt text for the image dialog
					if (meta.filetype == 'image') {
						input.setAttribute('accept', '.png,.jpg,.jpeg,.gif');

						input.onchange = function () {
							var file = this.files[0];
							if (checkFileSize(file, maxImg)) {
								var xhr, formData;
								xhr = new XMLHttpRequest();
								xhr.withCredentials = false;
								xhr.open('POST', imgUrl);
								xhr.setRequestHeader("X-CSRF-Token", csrf);
								xhr.upload.onloadstart = function () {
									topLevelWindow.block("Uploading ...");
								};
								xhr.onload = function () {
									topLevelWindow.unblock();
									var json;
									if (xhr.status != 200) {
										if (xhr.status == 422) {
											json = JSON.parse(xhr.responseText);
											showUploadError(json.file);
										}
										callback('');
										return;
									}
									json = JSON.parse(xhr.responseText);

									if (!json || typeof json.location != 'string') {
										showUploadError('');
										callback('');
										return;
									}
									// call the callback and populate the Title field with the file name
									callback(json.location, {alt: file.name});
								};
								formData = new FormData();
								formData.append('file', file);
								xhr.send(formData);
							}
						};
					}

					// Provide alternative source and posted for the media dialog
					if (meta.filetype == 'media') {
						input.setAttribute('accept', '.mp4,.mp3');

						input.onchange = function () {
							var file = this.files[0];
							if (checkFileSize(file, maxMedia)) {
								var xhr, formData;
								xhr = new XMLHttpRequest();
								xhr.withCredentials = false;
								xhr.open('POST', mediaUrl);
								xhr.setRequestHeader("X-CSRF-Token", csrf);
								xhr.upload.onloadstart = function () {
									topLevelWindow.block("Uploading ...");
								};
								xhr.onload = function () {
									topLevelWindow.unblock();
									var json;
									if (xhr.status != 200) {
										if (xhr.status == 422) {
											json = JSON.parse(xhr.responseText);
											showUploadError(json.file);
										}
										callback('');
										return;
									}
									json = JSON.parse(xhr.responseText);

									if (!json || typeof json.location != 'string') {
										showUploadError('');
										callback('');
										return;
									}
									// call the callback and populate the Title field with the file name
									callback(json.location, {title: file.name});
								};
								formData = new FormData();
								formData.append('file', file);
								xhr.send(formData);
							}
						};
					}

					input.click();
				}
			});
		}
	}

	BATinymce('{{route('media.tiny.photo.upload')}}',
		'{{route('media.tiny.media.upload')}}',
		'{{route('media.tiny.file.upload')}}',
		'{{csrf_token()}}',
		3000,
		10000,
		5000
	);
</script>